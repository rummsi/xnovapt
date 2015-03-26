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
 * @ShowAnnoncePage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 12:08:39
 */

/**
 * Description of ShowAnnoncePage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowAnnoncePage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'annonce';
    }

    function show() {
        global $user, $lang, $dpath;

        includeLang('annonce');

        $users = doquery("SELECT * FROM {{table}} WHERE id='" . $user['id'] . "';", 'users');
        $annonce = doquery("SELECT * FROM {{table}} ", 'annonce');
        $action = HTTP::_GP('action', '');

        if ($action == 6) {
            $id_anuncio = HTTP::_GP('add', '');
            $annonce = doquery("SELECT * FROM {{table}} WHERE `id`='" . $id_anuncio . "';", 'annonce', true);

            if (($user['id']) == ($annonce['user_id'])) {
                doquery("DELETE FROM {{table}} WHERE `id`=$id_anuncio", 'annonce');
                ShowErrorPage::message('<meta http-equiv="refresh" content="1; url=game.php?page=annonce"><font color=lime>' . $lang['annonce_del_ok'] . '</font>', $lang['annonce_info']);
            } elseif ($user['authlevel'] == "3") {
                doquery("DELETE FROM {{table}} WHERE `id`=$id_anuncio", 'annonce');
                ShowErrorPage::message('<meta http-equiv="refresh" content="1; url=game.php?page=annonce"><font color=lime>' . $lang['annonce_del_ok'] . '</font>', $lang['annonce_info']);
            } else {
                ShowErrorPage::message('<meta http-equiv="refresh" content="1; url=game.php?page=annonce"><font color=red>Erro ao eliminar o an&uacute;ncio!', $lang['annonce_error']);
            }
        }

        if ($action == 5) {
            $metalvendre = $_POST['metalvendre'];
            $cristalvendre = $_POST['cristalvendre'];
            $deutvendre = $_POST['deutvendre'];
            $metalsouhait = $_POST['metalsouhait'];
            $cristalsouhait = $_POST['cristalsouhait'];
            $deutsouhait = $_POST['deutsouhait'];

            while ($v_annonce = mysqli_fetch_array($users)) {
                $user = $v_annonce['username'];
                $user_id = $v_annonce['id'];
                $galaxie = $v_annonce['galaxy'];
                $systeme = $v_annonce['system'];
            }

            doquery("INSERT INTO {{table}} SET user='{$user}', user_id='{$user_id}', date='" . time() . "',galaxie='{$galaxie}', systeme='{$systeme}', metala='{$metalvendre}', cristala='{$cristalvendre}', deuta='{$deutvendre}', metals='{$metalsouhait}', cristals='{$cristalsouhait}', deuts='{$deutsouhait}'", "annonce");

            ShowErrorPage::message('<meta http-equiv="refresh" content="1; url=game.php?page=annonce"><font color=lime>' . $lang['annonce_add_ok'] . '</font>', $lang['annonce_info']);
        }

        if ($action == 2) {

            $this->tplObj->assign(array(
                'title' => $lang['annonce_title'],
                'annonce' => doquery("SELECT * FROM {{table}} ORDER BY `id` DESC LIMIT 100", "annonce"),
            ));

            $this->render('annonce.add.tpl');
        }

        if ($action != 5) {
            $annonce = doquery("SELECT * FROM {{table}} ORDER BY `id` DESC LIMIT 100", "annonce");

            $this->tplObj->assign(array(
                'title' => $lang['annonce_title'],
                'annonce' => doquery("SELECT * FROM {{table}} ORDER BY `id` DESC LIMIT 100", "annonce"),
            ));

            $this->render('annonce.default.tpl');
        }
    }

}
