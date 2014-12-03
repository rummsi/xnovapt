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
 * @ShowResearchPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 15:31:17
 */

/**
 * Description of ShowResearchPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowResearchPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'research';
    }

    function show() {
        global $planetrow, $user, $InResearch, $ThePlanet, $lang, $resource, $reslist, $game_config;
        includeLang('buildings');

        $NoResearchMessage = "";
        $bContinue = true;
        // Deja est qu'il y a un laboratoire sur la planete ???
        if ($planetrow[$resource[31]] == 0) {
            ShowErrorPage::message($lang['no_laboratory'], $lang['Research']);
        }
        // Ensuite ... Est ce que la labo est en cours d'upgrade ?
        if (!CheckLabSettingsInQueue($planetrow)) {
            $NoResearchMessage = $lang['labo_on_update'];
            $bContinue = false;
        }

        // Boucle d'interpretation des eventuelles commandes
        if (isset($_GET['cmd'])) {
            $TheCommand = $_GET['cmd'];
            $Techno = $_GET['tech'];
            if (is_numeric($Techno)) {
                if (in_array($Techno, $reslist['tech'])) {
                    // Bon quand on arrive ici ... On sait deja qu'on a une technologie valide
                    if (is_array($ThePlanet)) {
                        $WorkingPlanet = $ThePlanet;
                    } else {
                        $WorkingPlanet = $planetrow;
                    }
                    switch ($TheCommand) {
                        case 'cancel':
                            if ($ThePlanet['b_tech_id'] == $Techno) {
                                $costs = GetBuildingPrice($user, $WorkingPlanet, $Techno);
                                $WorkingPlanet['metal'] += $costs['metal'];
                                $WorkingPlanet['crystal'] += $costs['crystal'];
                                $WorkingPlanet['deuterium'] += $costs['deuterium'];
                                $WorkingPlanet['b_tech_id'] = 0;
                                $WorkingPlanet["b_tech"] = 0;
                                $user['b_tech_planet'] = 0;
                                $UpdateData = true;
                                $InResearch = false;
                            }
                            break;
                        case 'search':
                            if (IsTechnologieAccessible($user, $WorkingPlanet, $Techno) &&
                                    IsElementBuyable($user, $WorkingPlanet, $Techno)) {
                                $costs = GetBuildingPrice($user, $WorkingPlanet, $Techno);
                                $WorkingPlanet['metal'] -= $costs['metal'];
                                $WorkingPlanet['crystal'] -= $costs['crystal'];
                                $WorkingPlanet['deuterium'] -= $costs['deuterium'];
                                $WorkingPlanet["b_tech_id"] = $Techno;
                                $WorkingPlanet["b_tech"] = time() + GetBuildingTime($user, $WorkingPlanet, $Techno);
                                $user["b_tech_planet"] = $WorkingPlanet["id"];
                                $UpdateData = true;
                                $InResearch = true;
                            }
                            break;
                    }
                    if (@$UpdateData == true) {
                        $QryUpdatePlanet = "UPDATE {{table}} SET ";
                        $QryUpdatePlanet .= "`b_tech_id` = '" . $WorkingPlanet['b_tech_id'] . "', ";
                        $QryUpdatePlanet .= "`b_tech` = '" . $WorkingPlanet['b_tech'] . "', ";
                        $QryUpdatePlanet .= "`metal` = '" . $WorkingPlanet['metal'] . "', ";
                        $QryUpdatePlanet .= "`crystal` = '" . $WorkingPlanet['crystal'] . "', ";
                        $QryUpdatePlanet .= "`deuterium` = '" . $WorkingPlanet['deuterium'] . "' ";
                        $QryUpdatePlanet .= "WHERE ";
                        $QryUpdatePlanet .= "`id` = '" . $WorkingPlanet['id'] . "';";
                        doquery($QryUpdatePlanet, 'planets');

                        $QryUpdateUser = "UPDATE {{table}} SET ";
                        $QryUpdateUser .= "`b_tech_planet` = '" . $user['b_tech_planet'] . "' ";
                        $QryUpdateUser .= "WHERE ";
                        $QryUpdateUser .= "`id` = '" . $user['id'] . "';";
                        doquery($QryUpdateUser, 'users');
                    }
                    if (is_array($ThePlanet)) {
                        $ThePlanet = $WorkingPlanet;
                    } else {
                        $planetrow = $WorkingPlanet;
                        if ($TheCommand == 'search') {
                            $ThePlanet = $planetrow;
                        }
                    }
                }
            } else {
                $bContinue = false;
            }
        }

        foreach ($lang['tech'] as $Tech => $TechName) {
            if ($Tech > 105 && $Tech <= 199) {
                if (IsTechnologieAccessible($user, $planetrow, $Tech)) {
                    $building_level = $user[$resource[$Tech]];
                    $tech_level = ($building_level == 0) ? "" : "( " . $lang['level'] . " " . $building_level . " )";
                }
            }
        }

        $this->tplObj->assign(array(
            'title' => $lang['Research'],
            'tech_level' => $tech_level,
            'InResearch' => $InResearch,
            'CanBeDone' => IsElementBuyable($user, $planetrow, $Tech),
            'LevelToDo' => $user[$resource[$Tech]] + 1,
            'ThePlanet' => $ThePlanet,
            'resource' => $resource,
        ));

        $this->render('research.default.tpl');
    }

}
