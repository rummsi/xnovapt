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
 * @ShowMarchandPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 17:25:19
 */

/**
 * Description of ShowMarchandPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowMarchandPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'marchand';
    }

    function show() {
        global $lang, $user, $planetrow;
        includeLang('marchand');

        if (filter_input(INPUT_POST, 'ress') != '') {
            $Error = false;
            $CheatTry = false;
            @$Metal = $_POST['metal'];
            @$Crystal = $_POST['cristal'];
            @$Deuterium = $_POST['deut'];
            if ($Metal < 0) {
                $Metal *= -1;
                $CheatTry = true;
            }
            if ($Crystal < 0) {
                $Crystal *= -1;
                $CheatTry = true;
            }
            if ($Deuterium < 0) {
                $Deuterium *= -1;
                $CheatTry = true;
            }
            if ($CheatTry == false) {
                switch ($_POST['ress']) {
                    case 'metal':
                        $Necessaire = (( $Crystal * 2) + ( $Deuterium * 4));
                        if ($planetrow['metal'] > $Necessaire) {
                            $planetrow['metal'] -= $Necessaire;
                        } else {
                            $Message = $lang['mod_ma_noten'] . " " . $lang['Metal'] . "! ";
                            $Error = true;
                        }
                        break;
                    case 'cristal':
                        $Necessaire = (( $Metal * 0.5) + ( $Deuterium * 2));
                        if ($planetrow['crystal'] > $Necessaire) {
                            $planetrow['crystal'] -= $Necessaire;
                        } else {
                            $Message = $lang['mod_ma_noten'] . " " . $lang['Crystal'] . "! ";
                            $Error = true;
                        }
                        break;
                    case 'deuterium':
                        $Necessaire = (( $Metal * 0.25) + ( $Crystal * 0.5));
                        if ($planetrow['deuterium'] > $Necessaire) {
                            $planetrow['deuterium'] -= $Necessaire;
                        } else {
                            $Message = $lang['mod_ma_noten'] . " " . $lang['Deuterium'] . "! ";
                            $Error = true;
                        }
                        break;
                }
            }
            if ($Error == false) {
                if ($CheatTry == true) {
                    $planetrow['metal'] = 0;
                    $planetrow['crystal'] = 0;
                    $planetrow['deuterium'] = 0;
                } else {
                    $planetrow['metal'] += $Metal;
                    $planetrow['crystal'] += $Crystal;
                    $planetrow['deuterium'] += $Deuterium;
                }
                $QryUpdatePlanet = "UPDATE {{table}} SET ";
                $QryUpdatePlanet .= "`metal` = '" . $planetrow['metal'] . "', ";
                $QryUpdatePlanet .= "`crystal` = '" . $planetrow['crystal'] . "', ";
                $QryUpdatePlanet .= "`deuterium` = '" . $planetrow['deuterium'] . "' ";
                $QryUpdatePlanet .= "WHERE ";
                $QryUpdatePlanet .= "`id` = '" . $planetrow['id'] . "';";
                doquery($QryUpdatePlanet, 'planets');
                $Message = $lang['mod_ma_done'];
            }
            if ($Error == true) {
                $parse['title'] = $lang['mod_ma_error'];
            } else {
                $parse['title'] = $lang['mod_ma_donet'];
            }
            $parse['mes'] = $Message;
            $page = ShowErrorPage::message($parse['mes'], $parse['title']);
        } else {
            if (filter_input(INPUT_POST, 'action') != 2) {
                $PageTPL = 'marchand.default.tpl';
            } else {
                $mod_ma_res = "1";
                switch ($_POST['choix']) {
                    case 'metal':
                        $PageTPL = 'marchand.metal.tpl';
                        $this->tplObj->assign(array(
                            'mod_ma_res' => "1",
                            'mod_ma_res_a' => "2",
                            'mod_ma_res_b' => "4",
                        ));
                        break;
                    case 'cristal':
                        $PageTPL = 'marchand.cristal.tpl';
                        $this->tplObj->assign(array(
                            'mod_ma_res' => "1",
                            'mod_ma_res_a' => "0.5",
                            'mod_ma_res_b' => "2",
                        ));
                        break;
                    case 'deut':
                        $PageTPL = 'marchand.deuterium.tpl';
                        $this->tplObj->assign(array(
                            'mod_ma_res' => "1",
                            'mod_ma_res_a' => "0.25",
                            'mod_ma_res_b' => "0.5",
                        ));
                        break;
                }
            }

            $this->tplObj->assign(array(
                'title' => $lang['mod_marchand'],
            ));

            $this->render($PageTPL);
        }
        return $page;
    }

}
