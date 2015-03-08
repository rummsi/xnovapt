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
 * @ShowFleet2Page.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 17:59:25
 */

/**
 * Description of ShowFleet2Page
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowFleet2Page extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'fleet2';
        includeLang('fleet');
    }

    function show() {
        global $user, $planetrow, $lang, $resource, $pricelist, $reslist, $target_mission, $speedallsmin;

        $speed = array(
            10 => 100,
            9 => 90,
            8 => 80,
            7 => 70,
            6 => 60,
            5 => 50,
            4 => 40,
            3 => 30,
            2 => 20,
            1 => 10,
        );
        $g = filter_input(INPUT_POST, 'galaxy');
        $s = filter_input(INPUT_POST, 'system');
        $p = filter_input(INPUT_POST, 'planet');
        $t = filter_input(INPUT_POST, 'planet_type');
        if (!$g) {
            $g = $planetrow['galaxy'];
        }
        if (!$s) {
            $s = $planetrow['system'];
        }
        if (!$p) {
            $p = $planetrow['planet'];
        }
        if (!$t) {
            $t = $planetrow['planet_type'];
        }
        // Verifions si nous avons bien tout ce que nous voullons envoyer
        $FleetHiddenBlock = "";
        foreach ($reslist['fleet'] as $n => $i) {
            if ($i > 200 && $i < 300 && filter_input(INPUT_POST, "ship$i") > "0") {
                if (filter_input(INPUT_POST, "ship$i") > $planetrow[$resource[$i]]) {
                    $page .= $lang['fl_noenought'];
                    $speedalls[$i] = GetFleetMaxSpeed("", $i, $user);
                } else {
                    $fleet['fleetarray'][$i] = filter_input(INPUT_POST, "ship$i");
                    $this->tplObj->assign('fleetarray', str_rot13(base64_encode(serialize($fleet['fleetarray']))));
                    // Tableau des vaisseaux avec leur nombre
                    @$fleet['fleetlist'] .= $i . "," . filter_input(INPUT_POST, "ship$i") . ";";
                    // Nombre total de vaisseaux
                    @$fleet['amount'] += filter_input(INPUT_POST, "ship$i");
                    // Tableau des vitesses
                    $FleetHiddenBlock .= "<input type=\"hidden\" name=\"consumption" . $i . "\" value=\"" . GetShipConsumption($i, $user) . "\" />";
                    $FleetHiddenBlock .= "<input type=\"hidden\" name=\"speed" . $i . "\"       value=\"" . GetFleetMaxSpeed("", $i, $user) . "\" />";
                    $FleetHiddenBlock .= "<input type=\"hidden\" name=\"capacity" . $i . "\"    value=\"" . $pricelist[$i]['capacity'] . "\" />";
                    $FleetHiddenBlock .= "<input type=\"hidden\" name=\"ship" . $i . "\"        value=\"" . filter_input(INPUT_POST, "ship$i") . "\" />";
                    $speedalls[$i] = GetFleetMaxSpeed("", $i, $user);
                }
            }
        }
        if (!$fleet['fleetlist']) {
            ShowErrorPage::message($lang['fl_unselectall'], $lang['fl_error'], "fleet." . PHPEXT, 1);
        } else {
            $this->tplObj->assign('speedalls', min($speedalls));
        }

        /* A faire assez rapidement (faut juste savoir comment)
          $page .= "<th>". $lang['fl_time_go'] ."</th>";
          $page .= "<th><font color=\"lime\"><div id=\"llegada1\"><font>". gmdate("H:i:s") ."</font></div></font></th>";
          $page .= "</tr><tr height=\"20\">";
          $page .= "<th>". $lang['fl_time_back'] ."</th>";
          $page .= "<th><font color=\"lime\"><div id=\"llegada2\"><font>". gmdate("H:i:s") ."</font></div></font></th>";
          $page .= "</tr><tr height=\"20\">";
         */
        $page = "";
        if ($user['fleet_shortcut']) {
            $scarray = explode("\r\n", $user['fleet_shortcut']);
            $i = 0;
            foreach ($scarray as $a => $b) {
                if ($b != "") {
                    $c = explode(',', $b);
                    if ($i == 0) {
                        $page .= "<tr height=\"20\">";
                    }
                    $page .= "<th><a href=\"javascript:setTarget(" . $c[1] . "," . $c[2] . "," . $c[3] . "," . $c[4] . "); shortInfo();\"";
                    $page .= ">" . $c[0] . " " . $c[1] . ":" . $c[2] . ":" . $c[3] . " ";
                    // Signalisation du type de raccourci ...
                    // (P)lanete
                    // (D)ebris
                    // (L)une
                    if ($c[4] == 1) {
                        $page .= $lang['fl_shrtcup1'];
                    } elseif ($c[4] == 2) {
                        $page .= $lang['fl_shrtcup2'];
                    } elseif ($c[4] == 3) {
                        $page .= $lang['fl_shrtcup3'];
                    }
                    $page .= "</a></th>";
                    if ($i == 1) {
                        $page .= "</tr>";
                    }
                    if ($i == 1) {
                        $i = 0;
                    } else {
                        $i = 1;
                    }
                }
            }
            if ($i == 1) {
                $page .= "<th></th></tr>";
            }
        } else {
            $page .= "<tr height=\"20\">";
            $page .= "<th colspan=\"2\">" . $lang['fl_noshortc'] . "</th>";
            $page .= "</tr>";
        }
        // Gestion des raccourcis vers ses propres colonies ou planetes
        $kolonien = SortUserPlanets($user);
        $currentplanet = doquery("SELECT * FROM {{table}} WHERE id = '" . $user['current_planet'] . "'", 'planets', true);
        $page1 = "";
        if (mysql_num_rows($kolonien) > 1) {
            $i = 0;
            $w = 0;
            $tr = true;
            while ($row = mysql_fetch_array($kolonien)) {
                if ($w == 0 && $tr) {
                    $page1 .= "<tr height=\"20\">";
                    $tr = false;
                }
                if ($w == 2) {
                    $page1 .= "</tr>";
                    $w = 0;
                    $tr = true;
                }
                if ($row['planet_type'] == 3) {
                    $row['name'] .= " " . $lang['fl_shrtcup3'];
                }
                if ($currentplanet['galaxy'] == $row['galaxy'] &&
                        $currentplanet['system'] == $row['system'] &&
                        $currentplanet['planet'] == $row['planet'] &&
                        $currentplanet['planet_type'] == $row['planet_type']) {
//                    $page1 .= '<th><a href="javascript:setTarget('.$row['galaxy'].','.$row['system'].','.$row['planet'].','.$row['planet_type'].'); shortInfo();">'.$row['name'].' '.$row['galaxy'].':'.$row['system'].':'.$row['planet'].'</a></th>';
                } else {
                    $page1 .= "<th><a href=\"javascript:setTarget(" . $row['galaxy'] . "," . $row['system'] . "," . $row['planet'] . "," . $row['planet_type'] . "); shortInfo();\">" . $row['name'] . " " . $row['galaxy'] . ":" . $row['system'] . ":" . $row['planet'] . "</a></th>";
                    $w++;
                    $i++;
                }
            }
            if ($i % 2 != 0) {
                $page1 .= "<th>&nbsp;</th></tr>";
            } elseif ($w == 2) {
                $page1 .= "</tr>";
            }
        } else {
            $page1 .= "<th colspan=\"2\">" . $lang['fl_nocolonies'] . "</th>";
        }

        $this->tplObj->assign(array(
            'title' => $lang['fl_title'],
            'FleetHiddenBlock' => $FleetHiddenBlock,
            'page' => $page,
            'galaxy' => $planetrow['galaxy'],
            'system' => $planetrow['system'],
            'planet' => $planetrow['planet'],
            'planet_type' => $planetrow['planet_type'],
            'Pgalaxy' => intval(filter_input(INPUT_POST, 'galaxy')),
            'Psystem' => intval(filter_input(INPUT_POST, 'system')),
            'Pplanet' => intval(filter_input(INPUT_POST, 'planet')),
            'GetGameSpeedFactor' => GetGameSpeedFactor(),
            'fmetal' => floor($planetrow['metal']),
            'fcrystal' => floor($planetrow['crystal']),
            'fdeuterium' => floor($planetrow['deuterium']),
            'g' => $g,
            's' => $s,
            'p' => $p,
            't' => $t,
            't1' => (($t == 1) ? " SELECTED" : "" ),
            't2' => (($t == 2) ? " SELECTED" : "" ),
            't3' => (($t == 3) ? " SELECTED" : "" ),
            'speed' => $speed,
            'page1' => $page1,
            'Pmaxepedition' => filter_input(INPUT_POST, 'maxepedition'),
            'Pcurepedition' => filter_input(INPUT_POST, 'curepedition'),
            'target_mission' => $target_mission,
            'speedallsmin' => $speedallsmin,
        ));

        $this->render('fleet2.default.tpl');
    }

}
