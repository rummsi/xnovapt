<?php

/*
 * XNovaPT
 * Copyright (C) 2012
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should read the GNU General Public License, see <http://www.gnu.org/licenses/>.
 * 
 * XNovaPT
 * @author XNovaPT Team <xnovaptteam@gmail.com>
 * @ShowIndexPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  2/Dez/2014 20:56:21
 */

/**
 * Description of ShowIndexPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowIndexPage extends AbstractIndexPage {

    public function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'login';
    }

    function show() {
        global $lang;

        if (filter_input_array(INPUT_POST)) {
            $userData = array(
                'username' => mysql_real_escape_string(filter_input(INPUT_POST, 'username')),
                'password' => mysql_real_escape_string(filter_input(INPUT_POST, 'password'))
            );
            $sql = <<<EOF
                SELECT
                    users.id,
                    users.username,
                    users.banaday,
                    (CASE WHEN MD5("{$userData['password']}")=users.password THEN 1 ELSE 0 END) AS login_success,
                    CONCAT((@salt:=MID(MD5(RAND()), 0, 4)), SHA1(CONCAT(users.username, users.password, @salt))) AS login_rememberme
                    FROM {{table}}users AS users
                    WHERE users.username="{$userData['username']}"
                    LIMIT 1
EOF;
            $login = doquery($sql, '', true);
            if ($login['banaday'] <= time() & $login['banaday'] != '0') {
                doquery("UPDATE {{table}} SET `banaday` = '0', `bana` = '0', `urlaubs_modus` ='0'  WHERE `username` = '" . $login['username'] . "' LIMIT 1;", 'users');
                doquery("DELETE FROM {{table}} WHERE `who` = '" . $login['username'] . "'", 'banned');
            }
            if ($login) {
                if (intval($login['login_success'])) {
                    if (filter_input(INPUT_POST, 'rememberme')) {
                        setcookie('nova-cookie', serialize(array('id' => $login['id'], 'key' => $login['login_rememberme'])), time() + 2592000);
                    }
                    $sql = <<<EOF
                        UPDATE {{table}} AS users
                        SET users.onlinetime=UNIX_TIMESTAMP()
                        WHERE users.id={$login['id']}
EOF;
                    doquery($sql, 'users');
                    $_SESSION['user_id'] = $login['id'];
                    header("Location: game.php?page=overview");
                    exit(0);
                } else {
                    ShowErrorPage::message($lang['Login_FailPassword']);
                }
            } else {
                ShowErrorPage::message($lang['Login_FailUser']);
            }
        } else {

            $this->tplObj->assign(array(
                'title' => $lang['Login'],
                'lang' => $lang,
                'Count' => doquery('SELECT COUNT(DISTINCT users.id) AS `players` FROM {{table}} AS users WHERE users.authlevel < 3', 'users', true),
                'PlayersOnline' => doquery("SELECT COUNT(DISTINCT id) AS `onlinenow` FROM {{table}} AS users WHERE `onlinetime` > (UNIX_TIMESTAMP()-900) AND users.authlevel < 3", 'users', true),
                'LastPlayer' => doquery('SELECT users.`username` FROM {{table}} AS users ORDER BY `register_time` DESC LIMIT 1', 'users', true),
            ));

            // Test pour prendre le nombre total de joueur et le nombre de joueurs connectés
            if (filter_input(INPUT_GET, 'ucount') !== FALSE && filter_input(INPUT_GET, 'ucount') == 1) {
                $PlayersOnline = doquery("SELECT COUNT(DISTINCT id) AS `onlinenow` FROM {{table}} AS users WHERE `onlinetime` > (UNIX_TIMESTAMP()-900) AND users.authlevel < 3", 'users', true);
                $Count = doquery('SELECT COUNT(DISTINCT users.id) AS `players` FROM {{table}} AS users WHERE users.authlevel < 3', 'users', true);
                $page = $PlayersOnline['onlinenow'] . "/" . $Count['players'];
                die($page);
            } else {
                define('LOGIN', true);

                $this->render('default.index.tpl');
            }
        }
    }

}
