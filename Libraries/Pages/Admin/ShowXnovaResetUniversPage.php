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
 * @ShowXnovaResetUniversPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  12/Dez/2014 15:57:44
 */

/**
 * Description of ShowXnovaResetUniversPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowXnovaResetUniversPage extends AbstractAdminPage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'admin_xnovaresetunivers';
    }

    function show() {
        global $lang, $user;

        includeLang('admin');

        $mode = filter_input(INPUT_POST, 'mode');
        if ($mode == 'reset') {

            if (in_array($user['authlevel'], array(LEVEL_ADMIN))) {
                // Copier la table users et planets vers des tables de replis !
                doquery("RENAME TABLE {{table}} TO {{table}}_s", 'planets');
                doquery("RENAME TABLE {{table}} TO {{table}}_s", 'users');
                doquery("RENAME TABLE {{table}} TO {{table}}_s", 'galaxy');
                doquery("RENAME TABLE {{table}} TO {{table}}_s", 'banned');

                // Recreer la structure des tables renommées
                doquery("CREATE  TABLE IF NOT EXISTS {{table}} ( LIKE {{table}}_s );", 'planets');
                doquery("CREATE  TABLE IF NOT EXISTS {{table}} ( LIKE {{table}}_s );", 'users');
                doquery("CREATE  TABLE IF NOT EXISTS {{table}} ( LIKE {{table}}_s );", 'galaxy');
                doquery("CREATE  TABLE IF NOT EXISTS {{table}} ( LIKE {{table}}_s );", 'banned');

                // Vider toutes les tables !
                doquery("TRUNCATE TABLE {{table}}", 'aks');
                doquery("TRUNCATE TABLE {{table}}", 'alliance');
                doquery("TRUNCATE TABLE {{table}}", 'annonce');
                doquery("TRUNCATE TABLE {{table}}", 'banned');
                doquery("TRUNCATE TABLE {{table}}", 'buddy');
                doquery("TRUNCATE TABLE {{table}}", 'chat');
                doquery("TRUNCATE TABLE {{table}}", 'galaxy');
                doquery("TRUNCATE TABLE {{table}}", 'errors');
                doquery("TRUNCATE TABLE {{table}}", 'fleets');
                doquery("TRUNCATE TABLE {{table}}", 'iraks');
                doquery("TRUNCATE TABLE {{table}}", 'lunas');
                doquery("TRUNCATE TABLE {{table}}", 'messages');
                doquery("TRUNCATE TABLE {{table}}", 'notes');
                doquery("TRUNCATE TABLE {{table}}", 'rw');
                doquery("TRUNCATE TABLE {{table}}", 'statpoints');

                $AllUsers = doquery("SELECT `username`,`password`,`email`, `email_2`,`authlevel`,`galaxy`,`system`,`planet`, `sex`, `dpath`, `onlinetime`, `register_time`, `id_planet` FROM {{table}} WHERE 1;", 'users_s');
                $LimitTime = time() - (15 * (24 * (60 * 60)));
                $TransUser = 0;
                while ($TheUser = mysql_fetch_assoc($AllUsers)) {
                    if ($TheUser['onlinetime'] > $LimitTime) {
                        $UserPlanet = doquery("SELECT `name` FROM {{table}} WHERE `id` = '" . $TheUser['id_planet'] . "';", 'planets_s', true);
                        if ($UserPlanet['name'] != "") {
                            // Creation de l'utilisateur
                            $QryInsertUser = "INSERT INTO {{table}} SET ";
                            $QryInsertUser .= "`username` = '" . $TheUser['username'] . "', ";
                            $QryInsertUser .= "`email` = '" . $TheUser['email'] . "', ";
                            $QryInsertUser .= "`email_2` = '" . $TheUser['email_2'] . "', ";
                            $QryInsertUser .= "`sex` = '" . $TheUser['sex'] . "', ";
                            $QryInsertUser .= "`id_planet` = '0', ";
                            $QryInsertUser .= "`authlevel` = '" . $TheUser['authlevel'] . "', ";
                            $QryInsertUser .= "`dpath` = '" . $TheUser['dpath'] . "', ";
                            $QryInsertUser .= "`galaxy` = '" . $TheUser['galaxy'] . "', ";
                            $QryInsertUser .= "`system` = '" . $TheUser['system'] . "', ";
                            $QryInsertUser .= "`planet` = '" . $TheUser['planet'] . "', ";
                            $QryInsertUser .= "`register_time` = '" . $TheUser['register_time'] . "', ";
                            $QryInsertUser .= "`password` = '" . $TheUser['password'] . "';";
                            doquery($QryInsertUser, 'users');

                            // On cherche le numero d'enregistrement de l'utilisateur fraichement cr��
                            $NewUser = doquery("SELECT `id` FROM {{table}} WHERE `username` = '" . $TheUser['username'] . "' LIMIT 1;", 'users', true);

                            CreateOnePlanetRecord($TheUser['galaxy'], $TheUser['system'], $TheUser['planet'], $NewUser['id'], $UserPlanet['name'], true);
                            // Recherche de la reference de la nouvelle planete (qui est unique normalement !
                            $PlanetID = doquery("SELECT `id` FROM {{table}} WHERE `id_owner` = '" . $NewUser['id'] . "' LIMIT 1;", 'planets', true);

                            // Mise a jour de l'enregistrement utilisateur avec les infos de sa planete mere
                            $QryUpdateUser = "UPDATE {{table}} SET ";
                            $QryUpdateUser .= "`id_planet` = '" . $PlanetID['id'] . "', ";
                            $QryUpdateUser .= "`current_planet` = '" . $PlanetID['id'] . "' ";
                            $QryUpdateUser .= "WHERE ";
                            $QryUpdateUser .= "`id` = '" . $NewUser['id'] . "';";
                            doquery($QryUpdateUser, 'users');
                            $TransUser++;
                        }
                    }
                } // while
                // Mise a jour du nombre de joueurs inscripts
                doquery("UPDATE {{table}} SET `config_value` = '" . $TransUser . "' WHERE `config_name` = 'users_amount' LIMIT 1;", 'config');

                // Menage on vire les tables transitoires
                doquery("DROP TABLE {{table}}", 'planets_s');
                doquery("DROP TABLE {{table}}", 'users_s');

                AdminMessage($TransUser . $lang['adm_rz_done'], $lang['adm_rz_ttle']);
            } else {
                AdminMessage($lang['sys_noalloaw'], $lang['sys_noaccess']);
            }
        } else {

            $this->tplObj->assign(array(
                'title' => $lang['Reset'],
            ));

            $this->render('xnovaresetunivers.default.tpl');
        }
    }

}
