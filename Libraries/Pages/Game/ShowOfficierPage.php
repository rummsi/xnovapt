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
 * @ShowOfficierPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 17:22:48
 */

/**
 * Description of ShowOfficierPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowOfficierPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'officier';
    }

    function show() {
        global $user, $lang, $resource;

        includeLang('officier');

        // Vérification que le joueur n'a pas un nombre de points négatif
        if ($user['rpg_points'] < 0) {
            doquery("UPDATE {{table}} SET `rpg_points` = '0' WHERE `id` = '" . $user['id'] . "';", 'users');
        }

        // Si recrutement d'un officier
        if (filter_input(INPUT_GET, 'mode') !== FALSE) {
            if (filter_input(INPUT_GET, 'mode') == 'hire') {
                $this->hire();
            }
        }

        $this->tplObj->assign(array(
            'title' => $lang['Officier'],
            'resource' => $resource,
        ));

        $this->render('officiers.default.tpl');
    }

    function hire() {
        global $user, $lang, $reslist, $resource;

        includeLang('officier');

        if ($user['rpg_points'] > 0) {
            $Selected = HTTP::_GP('offi', '');
            if (in_array($Selected, $reslist['officier'])) {
                $Result = IsOfficierAccessible($user, $Selected);
                if ($Result == 1) {
                    $user[$resource[$Selected]] += 1;
                    $user['rpg_points'] -= 1;
                    if ($Selected == 610) {
                        $user['spy_tech'] += 5;
                    } elseif ($Selected == 611) {
                        $user['computer_tech'] += 3;
                    }
                    $QryUpdateUser = "UPDATE {{table}} SET ";
                    $QryUpdateUser .= "`rpg_points` = '" . $user['rpg_points'] . "', ";
                    $QryUpdateUser .= "`spy_tech` = '" . $user['spy_tech'] . "', ";
                    $QryUpdateUser .= "`computer_tech` = '" . $user['computer_tech'] . "', ";
                    $QryUpdateUser .= "`" . $resource[$Selected] . "` = '" . $user[$resource[$Selected]] . "' ";
                    $QryUpdateUser .= "WHERE ";
                    $QryUpdateUser .= "`id` = '" . $user['id'] . "';";
                    doquery($QryUpdateUser, 'users');
                    $Message = $lang['OffiRecrute'];
                } elseif ($Result == -1) {
                    $Message = $lang['Maxlvl'];
                } elseif ($Result == 0) {
                    $Message = $lang['Noob'];
                }
            }
        } else {
            $Message = $lang['NoPoints'];
        }
        $this->tplObj->assign(array(
            'title' => $lang['Officier'],
            'mes' => $Message,
        ));

        ShowErrorPage::message($Message, $lang['Officier'], header("Refresh: 3;url=game.php?page=officier"));
    }

}
