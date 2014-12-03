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
 * @ShowFleet1Page.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 17:37:11
 */

/**
 * Description of ShowFleet1Page
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowFleet1Page extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'fleet1';
    }

    function show() {
        includeLang('fleet');

        global $user, $planetrow, $lang, $resource, $pricelist, $reslist, $CurrentShipSpeed, $speedalls;

        $maxfleet = doquery("SELECT COUNT(fleet_owner) AS `actcnt` FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "';", 'fleets', true);
        $MaxFlyingFleets = $maxfleet['actcnt'];

        //Compteur de flotte en expéditions et nombre d'expédition maximum
        $MaxExpedition = $user[$resource[124]];
        $maxexpde = doquery("SELECT COUNT(fleet_owner) AS `expedi` FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "' AND `fleet_mission` = '15';", 'fleets', true);
        $ExpeditionEnCours = $maxexpde['expedi'];
        $EnvoiMaxExpedition = 1 + floor($MaxExpedition / 3);
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
        $galaxy = filter_input(INPUT_GET, 'galaxy');
        $system = filter_input(INPUT_GET, 'system');
        $planet = filter_input(INPUT_GET, 'planet');
        $planettype = filter_input(INPUT_GET, 'planettype');
        $target_mission = filter_input(INPUT_GET, 'target_mission');

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

        // Prise des coordonnées sur la ligne de commande
        $galaxy = intval(filter_input(INPUT_GET, 'galaxy'));
        $system = intval(filter_input(INPUT_GET, 'system'));
        $planet = intval(filter_input(INPUT_GET, 'planet'));
        $planettype = intval(filter_input(INPUT_GET, 'planettype'));
        $target_mission = intval(filter_input(INPUT_GET, 'target_mission'));
        $ShipData = "";
        $page = "";
        foreach ($reslist['fleet'] as $n => $i) {
            $ShipData .= "<input type=\"hidden\" name=\"maxship" . $i . "\" value=\"" . $planetrow[$resource[$i]] . "\" />";
            $ShipData .= "<input type=\"hidden\" name=\"consumption" . $i . "\" value=\"" . GetShipConsumption($i, $user) . "\" />";
            $ShipData .= "<input type=\"hidden\" name=\"speed" . $i . "\" value=\"" . GetFleetMaxSpeed("", $i, $user) . "\" />";
            $ShipData .= "<input type=\"hidden\" name=\"capacity" . $i . "\" value=\"" . $pricelist[$i]['capacity'] . "\" />";
            $have_ships = true;
            $this->tplObj->assign(array(
                'have_ships' => $have_ships,
                'ShipData' => $ShipData,
            ));
        }

        $this->tplObj->assign(array(
            'title' => $lang['fl_title'],
            'MaxFlyingFleets' => $MaxFlyingFleets,
            'MaxFlottes' => $MaxFlottes,
            'ExpeditionEnCours' => $ExpeditionEnCours,
            'EnvoiMaxExpedition' => $EnvoiMaxExpedition,
            'planettype' => $planettype,
            'target_mission' => $target_mission,
            'reslist' => $reslist,
            'resource' => $resource,
            'CurrentShipSpeed' => $CurrentShipSpeed,
            'pricelist' => $pricelist,
            'speedalls' => $speedalls,
        ));
        $this->render('fleet1.default.tpl');
    }

}
