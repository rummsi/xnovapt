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
 * @ShowMovementPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 17:41:08
 */

/**
 * Description of ShowMovementPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowMovementPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'movement';
        includeLang('fleet');
    }

    function show() {
        global $user, $planetrow, $lang, $resource, $pricelist, $reslist, $game_config;

        includeLang('fleet');

        $maxfleet = doquery("SELECT COUNT(fleet_owner) AS `actcnt` FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "';", 'fleets', true);
        $MaxFlyingFleets = $maxfleet['actcnt'];
        //Compteur de flotte en expéditions et nombre d'expédition maximum
        $MaxExpedition = $user[$resource[124]];
        if ($MaxExpedition >= 1) {
            $maxexpde = doquery("SELECT COUNT(fleet_owner) AS `expedi` FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "' AND `fleet_mission` = '15';", 'fleets', true);
            $ExpeditionEnCours = $maxexpde['expedi'];
            $EnvoiMaxExpedition = 1 + floor($MaxExpedition / 3);
        }
        $MaxFlottes = 1 + $user[$resource[108]];
        CheckPlanetUsedFields($planetrow);
        $missiontype = array(
            1 => $lang['type_mission'][1],
            2 => $lang['type_mission'][2],
            3 => $lang['type_mission'][3],
            4 => $lang['type_mission'][4],
            5 => $lang['type_mission'][5],
            6 => $lang['type_mission'][6],
            7 => $lang['type_mission'][7],
            8 => $lang['type_mission'][8],
            9 => $lang['type_mission'][9],
            15 => $lang['type_mission'][15]
        );
        // Histoire de recuperer les infos passées par galaxy
        @$galaxy = $_GET['galaxy'];
        @$system = $_GET['system'];
        @$planet = $_GET['planet'];
        @$planettype = $_GET['planettype'];
        @$target_mission = $_GET['target_mission'];
        if (!$galaxy) {
            $this->tplObj->assign('galaxy', $planetrow['galaxy']);
        }
        if (!$system) {
            $this->tplObj->assign('system', $planetrow['system']);
        }
        if (!$planet) {
            $this->tplObj->assign('planet', $planetrow['planet']);
        }
        if (!$planettype) {
            $this->tplObj->assign('planet_type', $planetrow['planet_type']);
        }
        // Gestion des flottes du joueur actif
        @$fq = doquery("SELECT * FROM {{table}} WHERE fleet_owner={$user[id]}", "fleets");
        $i = 0;
        $page = '';
        while ($f = mysql_fetch_array($fq)) {
            $i++;
            $page .= "<tr height=20>";
            // (01) Fleet ID
            $page .= "<th>" . $i . "</th>";
            // (02) Fleet Mission
            $page .= "<th>";
            $page .= "<a>" . $missiontype[$f[fleet_mission]] . "</a>";
            if (($f['fleet_start_time'] + 1) == $f['fleet_end_time']) {
                $page .= "<br><a title=\"" . $lang['fl_back_to_ttl'] . "\">" . $lang['fl_back_to'] . "</a>";
            } else {
                $page .= "<br><a title=\"" . $lang['fl_get_to_ttl'] . "\">" . $lang['fl_get_to'] . "</a>";
            }
            $page .= "</th>";
            // (03) Fleet Mission
            $page .= "<th><a title=\"";
            // Fleet details (commentaire)
            $fleet = explode(";", $f['fleet_array']);
            $e = 0;
            foreach ($fleet as $a => $b) {
                if ($b != '') {
                    $e++;
                    $a = explode(",", $b);
                    $page .= $lang['tech'][$a[0]] . ":" . $a[1] . "\n";
                    if ($e > 1) {
                        $page .= "\t";
                    }
                }
            }
            $page .= "\">" . pretty_number($f[fleet_amount]) . "</a></th>";
            // (04) Fleet From (Planete d'origine)
            $page .= "<th>[" . $f[fleet_start_galaxy] . ":" . $f[fleet_start_system] . ":" . $f[fleet_start_planet] . "]</th>";
            // (05) Fleet Start Time
            $page .= "<th>" . gmdate("d. M Y H:i:s", $f['fleet_start_time']) . "</th>";
            // (06) Fleet Target (Planete de destination)
            $page .= "<th>[" . $f[fleet_end_galaxy] . ":" . $f[fleet_end_system] . ":" . $f[fleet_end_planet] . "]</th>";
            // (07) Fleet Target Time
            $page .= "<th>" . gmdate("d. M Y H:i:s", $f['fleet_end_time']) . "</th>";
            // (08) Fleet Back Time
//          $page .= "<th><font color=\"lime\"><div id=\"time_0\"><font>". pretty_time(floor($f['fleet_end_time'] + 1 - time())) ."</font></th>";
            // (09) Fleet Back In
            $page .= "<th><font color=\"lime\"><div id=\"time_0\"><font>" . pretty_time(floor($f['fleet_end_time'] + 1 - time())) . "</font></th>";
            // (10) Orders
            $page .= "<th>";
            if ($f['fleet_mess'] == 0) {
                $page .= "<form action=\"game.php?page=fleetback\" method=\"post\">";
                $page .= "<input name=\"fleetid\" value=\"" . $f['fleet_id'] . "\" type=\"hidden\">";
                $page .= "<input value=\" " . $lang['fl_back_to_ttl'] . " \" type=\"submit\" name=\"send\">";
                $page .= "</form>";
                if ($f[fleet_mission] == 1) {
                    $page .= "<form action=\"verband.php\" method=\"post\">";
                    $page .= "<input name=\"fleetid\" value=\"" . $f['fleet_id'] . "\" type=\"hidden\">";
                    $page .= "<input value=\" " . $lang['fl_associate'] . " \" type=\"submit\">";
                    $page .= "</form>";
                }
            } else {
                $page .= "&nbsp;-&nbsp;";
            }
            $page .= "</th>";
            // Fin de ligne
            $page .= "</tr>";
        }

        $this->tplObj->assign(array(
            'title' => 'Movimento',
            'fl_title' => $lang['fl_title'],
            'MaxFlyingFleets' => $MaxFlyingFleets,
            'fl_sur' => $lang['fl_sur'],
            'MaxFlottes' => $MaxFlottes,
            'ExpeditionEnCours' => $ExpeditionEnCours,
            'EnvoiMaxExpedition' => $EnvoiMaxExpedition,
            'fl_expttl' => $lang['fl_expttl'],
            'fl_id' => $lang['fl_id'],
            'fl_mission' => $lang['fl_mission'],
            'fl_count' => $lang['fl_count'],
            'fl_from' => $lang['fl_from'],
            'fl_start_t' => $lang['fl_start_t'],
            'fl_dest' => $lang['fl_dest'],
            'fl_dest_t' => $lang['fl_dest_t'],
            'fl_back_t' => $lang['fl_back_t'],
            'fl_back_in' => $lang['fl_back_in'],
            'fl_order' => $lang['fl_order'],
            'i' => $i,
            'page' => $page,
        ));
        $this->render('movement.default.tpl');
    }

}
