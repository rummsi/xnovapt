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
 * @ShowOptionsPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 13:48:37
 */

/**
 * Description of ShowOptionsPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowOptionsPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'options';
    }

    function show() {
        global $user;

        includeLang('options');

        $this->tplObj->assign(array(
            'title' => 'Options',
            'IsProtOn' => doquery("SELECT `id_level` FROM {{table}} WHERE `id_owner` = '" . $user['id'] . "' LIMIT 1;", 'planets', true),
            'user' => $user,
        ));

        if ($user['urlaubs_modus']) {
            $this->render('options.vmode.tpl');
        } else {
            $this->render('options.default.tpl');
        }
        die();
    }

    function change() {
        global $user, $lang, $game_config;

        includeLang('options');

        $parse['kolorminus'] = $user['kolorminus'];
        $parse['kolorplus'] = $user['kolorplus'];
        $parse['kolorpoziom'] = $user['kolorpoziom'];

        $iduser = $user["id"];
        $avatar = filter_input(INPUT_POST, 'avatar');

        $this->tplObj->assign($lang, 'lang');

        if (filter_input(INPUT_POST, 'dpath') != "") {
            $dpath = filter_input(INPUT_POST, 'dpath');
        } else {
            $dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
        }
        // Gestion des options speciales pour les admins
        if ($user['authlevel'] != LEVEL_PLAYER) {
            if (filter_input(INPUT_POST, 'adm_pl_prot') == 'on') {
                doquery("UPDATE {{table}} SET `id_level` = '" . $user['authlevel'] . "' WHERE `id_owner` = '" . $user['id'] . "';", 'planets');
            } else {
                doquery("UPDATE {{table}} SET `id_level` = '0' WHERE `id_owner` = '" . $user['id'] . "';", 'planets');
            }
        }
        // Mostrar skin
        if (filter_input(INPUT_POST, 'design') !== FALSE && filter_input(INPUT_POST, 'design') == 'on') {
            $design = "1";
        } else {
            $design = "0";
        }
        // Desactivar comprobaci? de IP
        if (filter_input(INPUT_POST, 'noipcheck') !== FALSE && filter_input(INPUT_POST, 'noipcheck') == 'on') {
            $noipcheck = "1";
        } else {
            $noipcheck = "0";
        }
        // Nombre de usuario
        if (filter_input(INPUT_POST, 'db_character') !== FALSE && filter_input(INPUT_POST, 'db_character') != '') {
            $username = CheckInputStrings(filter_input(INPUT_POST, 'db_character'));
        } else {
            $username = $user['username'];
        }
        // Adresse e-Mail
        if (filter_input(INPUT_POST, 'db_email') !== FALSE && filter_input(INPUT_POST, 'db_email') != '') {
            $db_email = CheckInputStrings(filter_input(INPUT_POST, 'db_email'));
        } else {
            $db_email = $user['email'];
        }
        // Cantidad de sondas de espionaje
        if (filter_input(INPUT_POST, 'spio_anz') !== FALSE && is_numeric($_POST["spio_anz"])) {
            $spio_anz = $_POST["spio_anz"];
        } else {
            $spio_anz = "1";
        }
        // Mostrar tooltip durante
        if (filter_input(INPUT_POST, 'settings_tooltiptime') !== FALSE && is_numeric($_POST["settings_tooltiptime"])) {
            $settings_tooltiptime = $_POST["settings_tooltiptime"];
        } else {
            $settings_tooltiptime = "1";
        }
        // Maximo mensajes de flotas
        if (filter_input(INPUT_POST, 'settings_fleetactions') !== FALSE && is_numeric($_POST["settings_fleetactions"])) {
            $settings_fleetactions = $_POST["settings_fleetactions"];
        } else {
            $settings_fleetactions = "1";
        } //
        // Mostrar logos de los aliados
        if (filter_input(INPUT_POST, 'settings_allylogo') !== FALSE && filter_input(INPUT_POST, 'settings_allylogo') == 'on') {
            $settings_allylogo = "1";
        } else {
            $settings_allylogo = "0";
        }
        // Espionaje
        if (filter_input(INPUT_POST, 'settings_esp') !== FALSE && filter_input(INPUT_POST, 'settings_esp') == 'on') {
            $settings_esp = "1";
        } else {
            $settings_esp = "0";
        }
        // Escribir mensaje
        if (filter_input(INPUT_POST, 'settings_wri') !== FALSE && filter_input(INPUT_POST, 'settings_wri') == 'on') {
            $settings_wri = "1";
        } else {
            $settings_wri = "0";
        }
        // A?dir a lista de amigos
        if (filter_input(INPUT_POST, 'settings_bud') !== FALSE && filter_input(INPUT_POST, 'settings_bud') == 'on') {
            $settings_bud = "1";
        } else {
            $settings_bud = "0";
        }
        // Ataque con misiles
        if (filter_input(INPUT_POST, 'settings_mis') !== FALSE && filter_input(INPUT_POST, 'settings_mis') == 'on') {
            $settings_mis = "1";
        } else {
            $settings_mis = "0";
        }
        // Ver reporte
        if (filter_input(INPUT_POST, 'settings_rep') !== FALSE && filter_input(INPUT_POST, 'settings_rep') == 'on') {
            $settings_rep = "1";
        } else {
            $settings_rep = "0";
        }
        // Modo vacaciones
        if (filter_input(INPUT_POST, 'urlaubs_modus') !== FALSE && filter_input(INPUT_POST, 'urlaubs_modus') == 'on') {
            //Selectionne si le joueur a des flottes en vol
            $fleet = doquery("SELECT COUNT(fleet_owner) AS `actcnt` FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "';", 'fleets', true);
            //Selectionne si le joueur a des batiments en construction
            $build = doquery("SELECT COUNT(id_owner) AS `building` FROM {{table}} WHERE `id_owner` = '" . $user['id'] . "' and `b_building`!=0;", 'planets', true);
            //Selectionne si le joueur a des techno en cours
            $tech = doquery("SELECT COUNT(id) AS `tech` FROM {{table}} WHERE `id` = '" . $user['id'] . "' and `b_tech_planet`!=0;", 'users', true);
            //Selectionne si le joueur est en train de se faire attaquer
            $attack = doquery("SELECT COUNT(fleet_taget_owner) AS `attack` FROM {{table}} WHERE `fleet_taget_owner` = '" . $user['id'] . "';", 'fleets', true);
            if ($fleet['actcnt'] == '0' && $build['building'] == '0' && $tech['tech'] == '0' && $attack['attack'] == '0') {
                $urlaubs_modus = "1";
                $time = time() + 172800;
                doquery("UPDATE {{table}} SET
             `urlaubs_modus` = '$urlaubs_modus',
             `urlaubs_until` = '$time'
             WHERE `id` = '$iduser' LIMIT 1", "users");
            } else {
                ShowErrorPage::message('Verifiez vos flottes, technologies et batiments', '<center><font color=\"red\">Vous avez des actions en cours</font></center>');
            }

            $query = doquery("SELECT * FROM {{table}} WHERE id_owner = '{$user['id']}'", 'planets');
            while ($id = mysqli_fetch_array($query)) {
                doquery("UPDATE {{table}} SET
                   metal_perhour = '" . $game_config['metal_basic_income'] . "',
                   crystal_perhour = '" . $game_config['metal_basic_income'] . "',
                   deuterium_perhour = '" . $game_config['metal_basic_income'] . "',
                   energy_used = '0',
                   energy_max = '0',
                   metal_mine_porcent = '0',
                   crystal_mine_porcent = '0',
                   deuterium_sintetizer_porcent = '0',
                   solar_plant_porcent = '0',
                   fusion_plant_porcent = '0',
                   solar_satelit_porcent = '0'
                 WHERE id = '{$id['id']}' AND `planet_type` = 1 ", 'planets');
            }
        } else {
            $urlaubs_modus = "0";
        }

        // Borrar cuenta
        if (filter_input(INPUT_POST, 'db_deaktjava') !== FALSE && filter_input(INPUT_POST, 'db_deaktjava') == 'on') {
            $db_deaktjava = "1";
        } else {
            $db_deaktjava = "0";
        }

        // teste
        if (filter_input(INPUT_POST, 'kolorminus')) {
            $kolorminus = "red";
        }
        if (filter_input(INPUT_POST, 'kolorplus')) {
            $kolorplus = "#00FF00";
        }
        if (filter_input(INPUT_POST, 'kolorpoziom')) {
            $kolorpoziom = "yellow";
        }
        //fim de teste
        $SetSort = filter_input(INPUT_POST, 'settings_sort');
        $SetOrder = filter_input(INPUT_POST, 'settings_order');

        doquery("UPDATE {{table}} SET
       `email` = '$db_email',
       `avatar` = '$avatar',
       `dpath` = '$dpath',
       `design` = '$design',
       `noipcheck` = '$noipcheck',
       `planet_sort` = '$SetSort',
       `planet_sort_order` = '$SetOrder',
       `spio_anz` = '$spio_anz',
       `settings_tooltiptime` = '$settings_tooltiptime',
       `settings_fleetactions` = '$settings_fleetactions',
       `settings_allylogo` = '$settings_allylogo',
       `settings_esp` = '$settings_esp',
       `settings_wri` = '$settings_wri',
       `settings_bud` = '$settings_bud',
       `settings_mis` = '$settings_mis',
       `settings_rep` = '$settings_rep',
       `urlaubs_modus` = '$urlaubs_modus',
       `db_deaktjava` = '$db_deaktjava',
       `kolorminus` = '$kolorminus',
       `kolorplus` = '$kolorplus',
       `kolorpoziom` = '$kolorpoziom'
       WHERE `id` = '$iduser' LIMIT 1", "users");

        if (isset($_POST["db_password"]) && md5($_POST["db_password"]) == $user["password"]) {
            if (!empty($_POST['newpass1']) && !empty($_POST['newpass2']) && $_POST["newpass1"] == $_POST["newpass2"]) {
                $newpass = md5($_POST["newpass1"]);
                doquery("UPDATE {{table}} SET `password` = '{$newpass}' WHERE `id` = '{$user['id']}' LIMIT 1", "users");
                setcookie(COOKIE_NAME, "", time() - 100000, "/", "", 0); //le da el expire
                ShowErrorPage::message($lang['succeful_changepass'], $lang['changue_pass'], "index.php", 1);
            }
        }
        if ($user['username'] != $_POST["db_character"]) {
            $query = doquery("SELECT id FROM {{table}} WHERE username='{$_POST["db_character"]}'", 'users', true);
            if (!$query) {
                doquery("UPDATE {{table}} SET username='{$username}' WHERE id='{$user['id']}' LIMIT 1", "users");
                setcookie(COOKIE_NAME, "", time() - 100000, "/", "", 0); //le da el expire
                ShowErrorPage::message($lang['succeful_changename'], $lang['changue_name'], "index.php", 1);
            }
        }

        ShowErrorPage::message($lang['succeful_save'], $lang['Options']);
    }

    function exitmodus() {
        global $lang, $user;

        includeLang('options');

        if ((filter_input(INPUT_POST, 'exit_modus') !== FALSE) && filter_input(INPUT_POST, 'exit_modus') == 'on' and $user['urlaubs_until'] <= time()) {
            $urlaubs_modus = "0";
            doquery("UPDATE {{table}} SET
             `urlaubs_modus` = '0',
             `urlaubs_until` = '0'
             WHERE `id` = '" . $user['id'] . "' LIMIT 1", "users");

//Remise des mines au retour du mod vacance

            $query = doquery("SELECT * FROM {{table}} WHERE id_owner = '{$user['id']}'", 'planets');
            while ($id = mysqli_fetch_array($query)) {
                doquery("UPDATE {{table}} SET
                   energy_used = '10',
                   energy_max = '10',
                   metal_mine_porcent = '10',
                   crystal_mine_porcent = '10',
                   deuterium_sintetizer_porcent = '10',
                   solar_plant_porcent = '10',
                   fusion_plant_porcent = '10',
                   solar_satelit_porcent = '10'
                 WHERE id = '{$id['id']}' AND `planet_type` = 1 ", 'planets');
            }

            $dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
            ShowErrorPage::message($lang['succeful_save'], $lang['Options'], "game.php?page=options", 1);
        } else {
            $urlaubs_modus = "1";
            $dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
            ShowErrorPage::message($lang['You_cant_exit_vmode'], $lang['Error'], "game.php?page=options", 1);
        }
    }

}
