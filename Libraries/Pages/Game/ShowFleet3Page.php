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
 * @ShowFleet3Page.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 18:21:51
 */

/**
 * Description of ShowFleet3Page
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowFleet3Page extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'fleet3';
    }

    function show() {
        global $user, $planetrow, $lang, $pricelist;

        includeLang('fleet');

        $galaxy = intval(filter_input(INPUT_POST, 'galaxy'));
        $system = intval(filter_input(INPUT_POST, 'system'));
        $planet = intval(filter_input(INPUT_POST, 'planet'));
        $planettype = intval(filter_input(INPUT_POST, 'planettype'));

        // Test d'existance et de proprieté de la planete
        $YourPlanet = false;
        $UsedPlanet = false;
        $select = doquery("SELECT * FROM {{table}}", "planets");

        while ($row = mysql_fetch_array($select)) {
            if ($galaxy == $row['galaxy'] &&
                    $system == $row['system'] &&
                    $planet == $row['planet'] &&
                    $planettype == $row['planet_type']) {
                if ($row['id_owner'] == $user['id']) {
                    $YourPlanet = true;
                    $UsedPlanet = true;
                } else {
                    $UsedPlanet = true;
                }
                break;
            }
        }

        // Determinons les type de missions possibles par rapport a la planete cible
        if (filter_input(INPUT_POST, 'planettype') == "2") {
            if (filter_input(INPUT_POST, 'ship209') >= 1) {
                $missiontype = array(8 => $lang['type_mission'][8]);
                $this->tplObj->assign('missiontype', $missiontype);
            } else {
                $missiontype = array();
                $this->tplObj->assign('missiontype', $missiontype);
            }
        } elseif (filter_input(INPUT_POST, 'planettype') == "1" || filter_input(INPUT_POST, 'planettype') == "3") {
            if (filter_input(INPUT_POST, 'ship208') >= 1 && !$UsedPlanet) {
                $missiontype = array(7 => $lang['type_mission'][7]);
                $this->tplObj->assign('missiontype', $missiontype);
            } elseif (filter_input(INPUT_POST, 'ship210') >= 1 && !$YourPlanet) {
                $missiontype = array(6 => $lang['type_mission'][6]);
                $this->tplObj->assign('missiontype', $missiontype);
            }
            if (filter_input(INPUT_POST, 'ship202') >= 1 ||
                    filter_input(INPUT_POST, 'ship203') >= 1 ||
                    filter_input(INPUT_POST, 'ship204') >= 1 ||
                    filter_input(INPUT_POST, 'ship205') >= 1 ||
                    filter_input(INPUT_POST, 'ship206') >= 1 ||
                    filter_input(INPUT_POST, 'ship207') >= 1 ||
                    filter_input(INPUT_POST, 'ship210') >= 1 ||
                    filter_input(INPUT_POST, 'ship211') >= 1 ||
                    filter_input(INPUT_POST, 'ship213') >= 1 ||
                    filter_input(INPUT_POST, 'ship214') >= 1 ||
                    filter_input(INPUT_POST, 'ship215') >= 1 ||
                    filter_input(INPUT_POST, 'ship216') >= 1) {
                if (!$YourPlanet) {
                    $missiontype[1] = $lang['type_mission'][1];
                    $missiontype[5] = $lang['type_mission'][5];
                    $this->tplObj->assign('missiontype', $missiontype);
                }
                $missiontype[3] = $lang['type_mission'][3];
                $this->tplObj->assign('missiontype', $missiontype);
            }
        } elseif (filter_input(INPUT_POST, 'ship209') >= 1 || filter_input(INPUT_POST, 'ship208') >= 1) {
            $missiontype[3] = $lang['type_mission'][3];
            $this->tplObj->assign('missiontype', $missiontype);
        }
        if ($YourPlanet) {
            $missiontype[4] = $lang['type_mission'][4];
            $this->tplObj->assign('missiontype', $missiontype);
        }
        if (filter_input(INPUT_POST, 'planettype') == 3 &&
                (filter_input(INPUT_POST, 'ship214') ||
                filter_input(INPUT_POST, 'ship213')) &&
                !$YourPlanet &&
                $UsedPlanet) {
            $missiontype[2] = $lang['type_mission'][2];
            $this->tplObj->assign('missiontype', $missiontype);
        }
        if (filter_input(INPUT_POST, 'planettype') == 3 &&
                (filter_input(INPUT_POST, 'ship214') >= 1 || filter_input(INPUT_POST, 'ship216') >= 1) &&
                !$YourPlanet &&
                $UsedPlanet) {
            $missiontype[9] = $lang['type_mission'][9];
            $this->tplObj->assign('missiontype', $missiontype);
        }
        $fleetarray = unserialize(base64_decode(str_rot13(filter_input(INPUT_POST, 'usedfleet'))));
        $mission = filter_input(INPUT_POST, 'target_mission');
        $SpeedFactor = filter_input(INPUT_POST, 'speedfactor');
        $AllFleetSpeed = GetFleetMaxSpeed($fleetarray, 0, $user);
        $GenFleetSpeed = filter_input(INPUT_POST, 'speed');
        $MaxFleetSpeed = min($AllFleetSpeed);
        $distance = GetTargetDistance(filter_input(INPUT_POST, 'thisgalaxy'), filter_input(INPUT_POST, 'galaxy'), filter_input(INPUT_POST, 'thissytem'), filter_input(INPUT_POST, 'system'), filter_input(INPUT_POST, 'thisplanet'), filter_input(INPUT_POST, 'planet'));
        $duration = GetMissionDuration($GenFleetSpeed, $MaxFleetSpeed, $distance, $SpeedFactor);
        $consumption = GetFleetConsumption($fleetarray, $SpeedFactor, $duration, $distance, $MaxFleetSpeed, $user);
        $MissionSelector = "";
//        $missiontype = "";
        if (count($missiontype) > 0) {
            if ($planet == 16) {
                $MissionSelector .= "<tr height=\"20\">";
                $MissionSelector .= "<th>";
                $MissionSelector .= "<input type=\"radio\" name=\"mission\" value=\"15\" checked=\"checked\">" . $lang['type_mission'][15] . "<br /><br />";
                $MissionSelector .= "<font color=\"red\">" . $lang['fl_expe_warning'] . "</font>";
                $MissionSelector .= "</th>";
                $MissionSelector .= "</tr>";
            } else {
                $i = 0;
                foreach ($missiontype as $a => $b) {
                    $MissionSelector .= "<tr height=\"20\">";
                    $MissionSelector .= "<th>";
                    $MissionSelector .= "<input id=\"inpuT_" . $i . "\" type=\"radio\" name=\"mission\" value=\"" . $a . "\"" . ($mission == $a ? " checked=\"checked\"" : "") . ">";
                    $MissionSelector .= "<label for=\"inpuT_" . $i . "\">" . $b . "</label><br>";
                    $MissionSelector .= "</th>";
                    $MissionSelector .= "</tr>";
                    $i++;
                }
            }
        } else {
            $MissionSelector .= "<tr height=\"20\">";
            $MissionSelector .= "<th>";
            $MissionSelector .= "<font color=\"red\">" . $lang['fl_bad_mission'] . "</font>";
            $MissionSelector .= "</th>";
            $MissionSelector .= "</tr>";
        }
        if (filter_input(INPUT_POST, 'thisplanettype') == 1) {
            $TableTitle = "" . filter_input(INPUT_POST, 'thisgalaxy') . ":" . filter_input(INPUT_POST, 'thissystem') . ":" . filter_input(INPUT_POST, 'thisplanet') . " - " . $lang['fl_planet'] . "";
        } elseif ($_POST['thisplanettype'] == 3) {
            $TableTitle = "" . filter_input(INPUT_POST, 'thisgalaxy') . ":" . filter_input(INPUT_POST, 'thissystem') . ":" . filter_input(INPUT_POST, 'thisplanet') . " - " . $lang['fl_moon'] . "";
        }

        $this->tplObj->assign(array(
            'title' => $lang['fl_title'],
            'pmetal' => floor($planetrow["metal"]),
            'pcrystal' => floor($planetrow["crystal"]),
            'pdeuterium' => floor($planetrow["deuterium"]),
            'consumption' => $consumption,
            'distance' => $distance,
            'Pspeedfactor' => filter_input(INPUT_POST, 'speedfactor'),
            'Pthisgalaxy' => filter_input(INPUT_POST, 'thisgalaxy'),
            'Pthissystem' => filter_input(INPUT_POST, 'thissystem'),
            'Pthisplanet' => filter_input(INPUT_POST, 'thisplanet'),
            'Pgalaxy' => filter_input(INPUT_POST, 'galaxy'),
            'Psystem' => filter_input(INPUT_POST, 'system'),
            'Pplanet' => filter_input(INPUT_POST, 'planet'),
            'Pthisplanettype' => filter_input(INPUT_POST, 'thisplanettype'),
            'Pplanettype' => filter_input(INPUT_POST, 'planettype'),
            'Pspeedallsmin' => filter_input(INPUT_POST, 'speedallsmin'),
            'Pspeed' => filter_input(INPUT_POST, 'speed'),
            'Pusedfleet' => filter_input(INPUT_POST, 'usedfleet'),
            'Pmaxepedition' => filter_input(INPUT_POST, 'maxepedition'),
            'Pcurepedition' => filter_input(INPUT_POST, 'curepedition'),
            'TableTitle' => $TableTitle,
            'MissionSelector' => $MissionSelector,
            'fmetal' => floor($planetrow['metal']),
            'fcrystal' => floor($planetrow['crystal']),
            'fdeuterium' => floor($planetrow['deuterium']),
            'i' => $i,
            'a' => $a,
            'mission_cheked' => (filter_input(INPUT_POST, 'target_mission') == $a ? " checked=\"checked\"" : ""),
            'b' => $b,
            'planet' => $planet,
            'fleetarray' => $fleetarray,
            'pricelist' => $pricelist,
        ));

        $this->render('fleet3.default.tpl');
    }

}
