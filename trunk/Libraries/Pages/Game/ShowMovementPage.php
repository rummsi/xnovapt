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
        $galaxy = @$_GET['galaxy'];
        $system = @$_GET['system'];
        $planet = @$_GET['planet'];
        $planettype = @$_GET['planettype'];
        $target_mission = @$_GET['target_mission'];
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
            'fq' => doquery("SELECT * FROM {{table}} WHERE fleet_owner={$user['id']}", "fleets"),
            'missiontype' => $missiontype,
        ));
        $this->render('movement.default.tpl');
    }

}
