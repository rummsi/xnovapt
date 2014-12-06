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
 * @ShowJumpgatePage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 13:53:08
 */

/**
 * Description of ShowJumpgatePage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowJumpgatePage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'changelog';
    }

    function show() {
        global $user, $planetrow, $lang;

        $Message = self::DoFleetJump($user, $planetrow);
        ShowErrorPage::message($Message, $lang['tech'][43], '<meta http-equiv="refresh" content="1; url=game.php?page=infos&gid=43">');
    }

    function DoFleetJump($CurrentUser, $CurrentPlanet) {
        global $lang, $resource;

        includeLang('infos');

        if (filter_input_array(INPUT_POST)) {
            $RestString = GetNextJumpWaitTime($CurrentPlanet);
            $NextJumpTime = $RestString['value'];
            $JumpTime = time();
            // Dit monsieur, j'ai le droit de sauter ???
            if ($NextJumpTime == 0) {
                // Dit monsieur, ou je veux aller ca existe ???
                $TargetPlanet = filter_input(INPUT_POST, 'jmpto');
                $TargetGate = doquery("SELECT `id`, `sprungtor`, `last_jump_time` FROM {{table}} WHERE `id` = '" . $TargetPlanet . "';", 'planets', true);
                // Dit monsieur, ou je veux aller y a une porte de saut ???
                if ($TargetGate['sprungtor'] > 0) {
                    $RestString = GetNextJumpWaitTime($TargetGate);
                    $NextDestTime = $RestString['value'];
                    // Dit monsieur, chez toi aussi peut y avoir un saut ???
                    if ($NextDestTime == 0) {
                        // Bon j'ai eu toutes les autorisations, donc je compte les radis !!!
                        $ShipArray = array();
                        $SubQueryOri = "";
                        $SubQueryDes = "";
                        for ($Ship = 200; $Ship < 300; $Ship++) {
                            $ShipLabel = "c" . $Ship;
                            if ($_POST[$ShipLabel] > $CurrentPlanet[$resource[$Ship]]) {
                                $ShipArray[$Ship] = $CurrentPlanet[$resource[$Ship]];
                            } else {
                                $ShipArray[$Ship] = $_POST[$ShipLabel];
                            }
                            if ($ShipArray[$Ship] <> 0) {
                                $SubQueryOri .= "`" . $resource[$Ship] . "` = `" . $resource[$Ship] . "` - '" . $ShipArray[$Ship] . "', ";
                                $SubQueryDes .= "`" . $resource[$Ship] . "` = `" . $resource[$Ship] . "` + '" . $ShipArray[$Ship] . "', ";
                            }
                        }
                        // Dit monsieur, y avait quelque chose a envoyer ???
                        if ($SubQueryOri != "") {
                            // Soustraction de la lune de depart !
                            $QryUpdateOri = "UPDATE {{table}} SET ";
                            $QryUpdateOri .= $SubQueryOri;
                            $QryUpdateOri .= "`last_jump_time` = '" . $JumpTime . "' ";
                            $QryUpdateOri .= "WHERE ";
                            $QryUpdateOri .= "`id` = '" . $CurrentPlanet['id'] . "';";
                            doquery($QryUpdateOri, 'planets');

                            // Addition à la lune d'arrivée !
                            $QryUpdateDes = "UPDATE {{table}} SET ";
                            $QryUpdateDes .= $SubQueryDes;
                            $QryUpdateDes .= "`last_jump_time` = '" . $JumpTime . "' ";
                            $QryUpdateDes .= "WHERE ";
                            $QryUpdateDes .= "`id` = '" . $TargetGate['id'] . "';";
                            doquery($QryUpdateDes, 'planets');

                            // Deplacement vers la lune d'arrivée
                            $QryUpdateUsr = "UPDATE {{table}} SET ";
                            $QryUpdateUsr .= "`current_planet` = '" . $TargetGate['id'] . "' ";
                            $QryUpdateUsr .= "WHERE ";
                            $QryUpdateUsr .= "`id` = '" . $CurrentUser['id'] . "';";
                            doquery($QryUpdateUsr, 'users');

                            $CurrentPlanet['last_jump_time'] = $JumpTime;
                            $RestString = GetNextJumpWaitTime($CurrentPlanet);
                            $RetMessage = $lang['gate_jump_done'] . " - " . $RestString['string'];
                        } else {
                            $RetMessage = $lang['gate_wait_data'];
                        }
                    } else {
                        $RetMessage = $lang['gate_wait_dest'] . " - " . $RestString['string'];
                    }
                } else {
                    $RetMessage = $lang['gate_no_dest_g'];
                }
            } else {
                $RetMessage = $lang['gate_wait_star'] . " - " . $RestString['string'];
            }
        } else {
            $RetMessage = $lang['gate_wait_data'];
        }

        return $RetMessage;
    }

}
