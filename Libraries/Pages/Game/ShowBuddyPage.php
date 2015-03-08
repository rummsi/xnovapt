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
 * @ShowBuddyPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 12:39:18
 */

/**
 * Description of ShowBuddyPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowBuddyPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'buddy';
    }

    function show() {
        global $lang, $user;

        $this->initTemplate();
        $this->setWindow('popup');

        includeLang('buddy');

        $a = filter_input(INPUT_GET, 'a');
        $e = filter_input(INPUT_GET, 'e');
        $s = filter_input(INPUT_GET, 's');
        $u = intval(filter_input(INPUT_GET, 'u'));

        if ($s == 1 && filter_input(INPUT_GET, 'bid') !== FALSE) {
            // Effacer une entree de la liste d'amis
            $bid = intval(filter_input(INPUT_GET, 'bid'));

            $buddy = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $bid . "';", 'buddy', true);
            if ($buddy['owner'] == $user['id']) {
                if ($buddy['active'] == 0 && $a == 1) {
                    doquery("DELETE FROM {{table}} WHERE `id` = '" . $bid . "';", 'buddy');
                } elseif ($buddy['active'] == 1) {
                    doquery("DELETE FROM {{table}} WHERE `id` = '" . $bid . "';", 'buddy');
                } elseif ($buddy['active'] == 0) {
                    doquery("UPDATE {{table}} SET `active` = '1' WHERE `id` = '" . $bid . "';", 'buddy');
                }
            } elseif ($buddy['sender'] == $user['id']) {
                doquery("DELETE FROM {{table}} WHERE `id` = '" . $bid . "';", 'buddy');
            }
        } elseif (filter_input(INPUT_POST, 's') == 3 && filter_input(INPUT_POST, 'a') == 1 && filter_input(INPUT_POST, 'e') == 1 && filter_input(INPUT_POST, 'u') !== FALSE) {
            // Traitement de l'enregistrement de la demande d'entree dans la liste d'amis
            $uid = $user["id"];
            $u = intval(filter_input(INPUT_POST, 'u'));

            $buddy = doquery("SELECT * FROM {{table}} WHERE sender={$uid} AND owner={$u} OR sender={$u} AND owner={$uid}", 'buddy', true);

            if (!$buddy) {
                if (strlen(filter_input(INPUT_POST, 'text')) > 5000) {
                    ShowErrorPage::message("Le texte ne doit pas faire plus de 5000 caract&egrave;res !", "Erreur");
                }
                $text = mysql_escape_string(strip_tags(filter_input(INPUT_POST, 'text')));
                doquery("INSERT INTO {{table}} SET sender={$uid}, owner={$u}, active=0, text='{$text}'", 'buddy');
                ShowErrorPage::message($lang['Request_sent'], $lang['Buddy_request'], header("Refresh: 3;url=game.php?page=buddy"));
            } else {
                ShowErrorPage::message($lang['A_request_exists_already_for_this_user'], $lang['Buddy_request'], header("Refresh: 3;url=game.php?page=buddy"));
            }
        }

        if ($a == 2 && isset($u)) {

            $this->tplObj->assign(array(
                'title' => $lang['Buddy_list'],
                'u' => doquery("SELECT * FROM {{table}} WHERE id='$u'", "users", true),
                'a' => $a,
            ));

            $this->render('buddy.request.tpl');
        }

        if ($a == 1) {
            $query = ( $e == 1 ) ? "WHERE active=0 AND sender=" . $user["id"] : "WHERE active=0 AND owner=" . $user["id"];
        } else {
            $query = "WHERE active=1 AND sender=" . $user["id"] . " OR active=1 AND owner=" . $user["id"];
        }

        $buddyrow = doquery("SELECT * FROM {{table}} " . $query, 'buddy');
        while ($b = mysql_fetch_array($buddyrow)) {
            $uid = ( $b["owner"] == $user["id"] ) ? $b["sender"] : $b["owner"];
            // query del user
            $u = doquery("SELECT id,username,galaxy,system,planet,onlinetime,ally_id,ally_name FROM {{table}} WHERE id=" . $uid, "users", true);
        }

        $this->tplObj->assign(array(
            'title' => $lang['Buddy_list'],
            'a' => $a,
            'buddyrow' => doquery("SELECT * FROM {{table}} " . $query, 'buddy'),
            'uid' => ( $b["owner"] == $user["id"] ) ? $b["sender"] : $b["owner"],
            'u' => $u,
            'e' => $e,
        ));

        $this->render('buddy.default.tpl');
    }

}
