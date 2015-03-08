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
 * @ShowOverviewPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  2/Dez/2014 22:58:36
 */

/**
 * Description of ShowOverviewPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowOverviewPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'overview';
    }

    function show() {
        global $user, $lang, $game_config, $planetrow, $dpath, $galaxyrow, $flotten;
        includeLang('resources');
        includeLang('overview');
        includeLang('buildings');

        $deleteid = filter_input(INPUT_POST, 'deleteid');
        //CheckPlanetUsedFields ($lunarow);
        if ($deleteid !== FALSE) {
            $deleteid = intval($deleteid);
        }

        if ($user['id'] != '') {
            // -----------------------------------------------------------------------------------------------
            // --- Gestion Officiers -------------------------------------------------------------------------
            // Passage au niveau suivant, ajout du point de compétence et affichage du passage au nouveau level
            $XpMinierUp = $user['lvl_minier'] * 5000;
            $XpRaidUp = $user['lvl_raid'] * 10;
            $XpMinier = $user['xpminier'];
            $XPRaid = $user['xpraid'];
            $LvlUpMinier = $user['lvl_minier'] + 1;
            $LvlUpRaid = $user['lvl_raid'] + 1;

            if (($LvlUpMinier + $LvlUpRaid) <= 100) {
                if ($XpMinier >= $XpMinierUp) {
                    $QryUpdateUser = "UPDATE {{table}} SET ";
                    $QryUpdateUser .= "`lvl_minier` = '" . $LvlUpMinier . "', ";
                    $QryUpdateUser .= "`rpg_points` = `rpg_points` + 1 ";
                    $QryUpdateUser .= "WHERE ";
                    $QryUpdateUser .= "`id` = '" . $user['id'] . "';";
                    doquery($QryUpdateUser, 'users');
                }
                if ($XPRaid >= $XpRaidUp) {
                    $QryUpdateUser = "UPDATE {{table}} SET ";
                    $QryUpdateUser .= "`lvl_raid` = '" . $LvlUpRaid . "', ";
                    $QryUpdateUser .= "`rpg_points` = `rpg_points` + 1 ";
                    $QryUpdateUser .= "WHERE ";
                    $QryUpdateUser .= "`id` = '" . $user['id'] . "';";
                    doquery($QryUpdateUser, 'users');
                }
            }
            // -----------------------------------------------------------------------------------------------
            // --- Gestion des flottes personnelles ---------------------------------------------------------
            // Toutes de vert vetues
            $OwnFleets = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "';", 'fleets');
            $Record = 0;
            while ($FleetRow = mysqli_fetch_array($OwnFleets)) {
                $Record++;
                $StartTime = $FleetRow['fleet_start_time'];
                $StayTime = $FleetRow['fleet_end_stay'];
                $EndTime = $FleetRow['fleet_end_time'];
                // Flotte a l'aller
                $Label = "fs";
                if ($StartTime > time()) {
                    $fpage[$StartTime] = BuildFleetEventTable($FleetRow, 0, true, $Label, $Record);
                }
                if ($FleetRow['fleet_mission'] <> 4) {
                    // Flotte en stationnement
                    $Label = "ft";
                    if ($StayTime > time()) {
                        $fpage[$StayTime] = BuildFleetEventTable($FleetRow, 1, true, $Label, $Record);
                    }
                    // Flotte au retour
                    $Label = "fe";
                    if ($EndTime > time()) {
                        $fpage[$EndTime] = BuildFleetEventTable($FleetRow, 2, true, $Label, $Record);
                    }
                }
            } // End While
            // -----------------------------------------------------------------------------------------------
            // --- Gestion des flottes autres que personnelles ----------------------------------------------
            // Flotte ennemies (ou amie) mais non personnelles
            $OtherFleets = doquery("SELECT * FROM {{table}} WHERE `fleet_target_owner` = '" . $user['id'] . "';", 'fleets');
            $Record = 2000;
            while ($FleetRow = mysqli_fetch_array($OtherFleets)) {
                if ($FleetRow['fleet_owner'] != $user['id']) {
                    if ($FleetRow['fleet_mission'] != 8) {
                        $Record++;
                        $StartTime = $FleetRow['fleet_start_time'];
                        $StayTime = $FleetRow['fleet_end_stay'];
                        if ($StartTime > time()) {
                            $Label = "ofs";
                            $fpage[$StartTime] = BuildFleetEventTable($FleetRow, 0, false, $Label, $Record);
                        }
                        if ($FleetRow['fleet_mission'] == 5) {
                            // Flotte en stationnement
                            $Label = "oft";
                            if ($StayTime > time()) {
                                $fpage[$StayTime] = BuildFleetEventTable($FleetRow, 1, false, $Label, $Record);
                            }
                        }
                    }
                }
            }
            // -----------------------------------------------------------------------------------------------
            // --- Gestion de la liste des planetes ----------------------------------------------------------
            // Planetes ...
            $Order = ($user['planet_sort_order'] == 1) ? "DESC" : "ASC";
            $Sort = $user['planet_sort'];
            $QryPlanets = "SELECT * FROM {{table}} WHERE `id_owner` = '" . $user['id'] . "' ORDER BY ";
            if ($Sort == 0) {
                $QryPlanets .= "`id` " . $Order;
            } elseif ($Sort == 1) {
                $QryPlanets .= "`galaxy`, `system`, `planet`, `planet_type` " . $Order;
            } elseif ($Sort == 2) {
                $QryPlanets .= "`name` " . $Order;
            }
            $planets_query = doquery($QryPlanets, 'planets');
            $Colone = 1;
            $AllPlanets = "<tr>";
            while ($UserPlanet = mysqli_fetch_array($planets_query)) {
                PlanetResourceUpdate($user, $UserPlanet, time());
                if ($UserPlanet["id"] != $user["current_planet"] && $UserPlanet['planet_type'] != 3) {
                    $AllPlanets .= "<th>" . $UserPlanet['name'] . "<br>";
                    $AllPlanets .= "<a href=\"?page=overview&cp=" . $UserPlanet['id'] . "&re=0\" title=\"" . $UserPlanet['name'] . "\"><img src=\"" . $dpath . "planeten/small/s_" . $UserPlanet['image'] . ".jpg\" height=\"50\" width=\"50\"></a><br>";
                    $AllPlanets .= "<center>";
                    if ($UserPlanet['b_building'] != 0) {
                        UpdatePlanetBatimentQueueList($UserPlanet, $user);
                        if ($UserPlanet['b_building'] != 0) {
                            $BuildQueue = $UserPlanet['b_building_id'];
                            $QueueArray = explode(";", $BuildQueue);
                            $CurrentBuild = explode(",", $QueueArray[0]);
                            $BuildElement = $CurrentBuild[0];
                            $BuildLevel = $CurrentBuild[1];
                            $BuildRestTime = pretty_time($CurrentBuild[3] - time());
                            $AllPlanets .= '' . $lang['tech'][$BuildElement] . ' (' . $BuildLevel . ')';
                            $AllPlanets .= "<br><font color=\"#7f7f7f\">(" . $BuildRestTime . ")</font>";
                        } else {
                            CheckPlanetUsedFields($UserPlanet);
                            $AllPlanets .= $lang['Free'];
                        }
                    } else {
                        $AllPlanets .= $lang['Free'];
                    }
                    $AllPlanets .= "</center></th>";
                    if ($Colone <= 1) {
                        $Colone++;
                    } else {
                        $AllPlanets .= "</tr><tr>";
                        $Colone = 1;
                    }
                }
            }
            // -----------------------------------------------------------------------------------------------
            // --- Gestion des attaques missiles -------------------------------------------------------------
            $iraks_query = doquery("SELECT * FROM {{table}} WHERE owner = '" . $user['id'] . "'", 'iraks');
            $Record = 4000;
            while ($irak = mysqli_fetch_array($iraks_query)) {
                $Record++;
                $fpage[$irak['zeit']] = '';
                if ($irak['zeit'] > time()) {
                    $time = $irak['zeit'] - time();
                    $fpage[$irak['zeit']] .= InsertJavaScriptChronoApplet("fm", $Record, $time, true);
                    $planet_start = doquery("SELECT * FROM {{table}} WHERE
						galaxy = '" . $irak['galaxy'] . "' AND
						system = '" . $irak['system'] . "' AND
						planet = '" . $irak['planet'] . "' AND
						planet_type = '1'", 'planets');
                    $user_planet = doquery("SELECT * FROM {{table}} WHERE
						galaxy = '" . $irak['galaxy_angreifer'] . "' AND
						system = '" . $irak['system_angreifer'] . "' AND
						planet = '" . $irak['planet_angreifer'] . "' AND
						planet_type = '1'", 'planets', true);
                    if (mysqli_num_rows($planet_start) == 1) {
                        $planet = mysqli_fetch_array($planet_start);
                    }
                    $fpage[$irak['zeit']] .= "<tr><th><div id=\"bxxfs$i\" class=\"z\"></div><font color=\"lime\">" . gmdate("H:i:s", $irak['zeit'] + 1 * 60 * 60) . "</font> </th><th colspan=\"3\"><font color=\"#0099FF\">Une attaque de missiles (" . $irak['anzahl'] . ") de " . $user_planet['name'] . " ";
                    $fpage[$irak['zeit']] .= '<a href="game.php?page=galaxy&action=3&galaxy=' . $irak["galaxy_angreifer"] . '&system=' . $irak["system_angreifer"] . '&planet=' . $irak["planet_angreifer"] . '">[' . $irak["galaxy_angreifer"] . ':' . $irak["system_angreifer"] . ':' . $irak["planet_angreifer"] . ']</a>';
                    $fpage[$irak['zeit']] .= ' arrive sur la plan&egrave;te' . $planet["name"] . ' ';
                    $fpage[$irak['zeit']] .= '<a href="game.php?page=galaxy&action=3&galaxy=' . $irak["galaxy"] . '&system=' . $irak["system"] . '&planet=' . $irak["planet"] . '">[' . $irak["galaxy"] . ':' . $irak["system"] . ':' . $irak["planet"] . ']</a>';
                    $fpage[$irak['zeit']] .= '</font>';
                    $fpage[$irak['zeit']] .= InsertJavaScriptChronoApplet("fm", $Record, $time, false);
                    $fpage[$irak['zeit']] .= "</th>";
                }
            }

            $StatRecord = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $user['id'] . "';", 'statpoints', true);
            $ile = $StatRecord['total_old_rank'] - $StatRecord['total_rank'];
            if ($ile >= 1) {
                $parse['ile'] = "<font color=lime>+" . $ile . "</font>";
            } elseif ($ile < 0) {
                $parse['ile'] = "<font color=red>-" . $ile . "</font>";
            } elseif ($ile == 0) {
                $parse['ile'] = "<font color=lightblue>" . $ile . "</font>";
            }
            if (isset($fpage)) {
                if (count($fpage) > 0) {
                    ksort($fpage);
                    foreach ($fpage as $time => $content) {
                        $flotten .= $content . "\n";
                    }
                }
            }
            $parse['energy_used'] = $planetrow["energy_max"] - $planetrow["energy_used"];

            $query = doquery('SELECT username FROM {{table}} ORDER BY register_time DESC', 'users', true);
            $parse['last_user'] = $query['username'];
            $query = doquery("SELECT COUNT(DISTINCT(id)) FROM {{table}} WHERE onlinetime>" . (time() - 900), 'users', true);
            $parse['online_users'] = $query[0];
            // $count = doquery(","users",true);
            $parse['users_amount'] = $game_config['users_amount'];
            // Mode Améliorations
            $LvlMinier = $user['lvl_minier'];
            $LvlRaid = $user['lvl_raid'];

            $BuildQueue = explode(";", $planetrow['b_building_id']);

            $this->tplObj->assign(array(
                'title' => $lang['Overview'],
                'OnlineUsers' => doquery("SELECT COUNT(*) FROM {{table}} WHERE onlinetime>='" . (time() - 15 * 60) . "'", 'users', 'true'),
                'fleet_list' => $flotten,
                'anothers_planets' => $AllPlanets,
                'lvl_up_minier' => $LvlMinier * 5000,
                'lvl_up_raid' => $LvlRaid * 10,
                'galaxyrow' => $galaxyrow,
                'LvlUpMinier' => $user['lvl_minier'] + 1,
                'LvlUpRaid' => $user['lvl_raid'] + 1,
                'XpMinierUp' => $user['lvl_minier'] * 5000,
                'XpRaidUp' => $user['lvl_raid'] * 10,
                'XpMinier' => $user['xpminier'],
                'XPRaid' => $user['xpraid'],
                'lune' => doquery("SELECT * FROM {{table}} WHERE `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `planet` = '" . $planetrow['planet'] . "' AND `planet_type` = '3'", 'planets', true),
                'lunarow' => doquery("SELECT * FROM {{table}} WHERE `id_owner` = '" . $planetrow['id_owner'] . "' AND `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `lunapos` = '" . $planetrow['planet'] . "';", 'lunas', true),
                'CurrBuild' => explode(",", $BuildQueue[0]),
                'RestTime' => $planetrow['b_building'] - time(),
                'PlanetID' => $planetrow['id'],
                'StatRecord' => $StatRecord,
            ));

            $this->render('overview.default.tpl');
        }
    }

}
