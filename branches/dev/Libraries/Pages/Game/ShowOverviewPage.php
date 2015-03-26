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

            $StatRecord = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $user['id'] . "';", 'statpoints', true);
            $ile = $StatRecord['total_old_rank'] - $StatRecord['total_rank'];
            if ($ile >= 1) {
                $parse['ile'] = "<font color=lime>+" . $ile . "</font>";
            } elseif ($ile < 0) {
                $parse['ile'] = "<font color=red>-" . $ile . "</font>";
            } elseif ($ile == 0) {
                $parse['ile'] = "<font color=lightblue>" . $ile . "</font>";
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
                'page_scripts' => "initOverview();
                    initBuffBar();
                    initType();
                    tabletInitOverviewAdvice();",
                    'currentPage'=> 'overview',
            ));

            $this->render('overview.default.tpl');
        }
    }

}
