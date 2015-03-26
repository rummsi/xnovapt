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
 * @ShowResourcesPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  4/Dez/2014 15:46:08
 */

/**
 * Description of ShowResourcesPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowResourcesPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'resources';
    }

    function show() {
        global $lang, $ProdGrid, $resource, $reslist, $game_config, $_POST, $planetrow, $user;

        includeLang('resources');
        includeLang('leftmenu');

        // Si c'est une lune ... pas de ressources produites
        if ($planetrow['planet_type'] == 3) {
            $game_config['metal_basic_income'] = 0;
            $game_config['crystal_basic_income'] = 0;
            $game_config['deuterium_basic_income'] = 0;
        }
        $ValidList['percent'] = array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100);
        $SubQry = "";
        if ($_POST) {
            foreach ($_POST as $Field => $Value) {
                $FieldName = $Field . "_porcent";
                if (isset($planetrow[$FieldName])) {
                    if (!in_array($Value, $ValidList['percent'])) {
                        header("Location: game.php?page=overview");
                        exit;
                    }
                    $Value = $Value / 10;
                    $planetrow[$FieldName] = $Value;
                    $SubQry .= ", `" . $FieldName . "` = '" . $Value . "'";
                }
            }
        }
        $parse['production_level'] = 100;
        if ($planetrow['energy_max'] == 0 && $planetrow['energy_used'] > 0) {
            $post_porcent = 0;
        } elseif ($planetrow['energy_max'] > 0 && ($planetrow['energy_used'] + $planetrow['energy_max']) < 0) {
            $post_porcent = floor(($planetrow['energy_max']) / $planetrow['energy_used'] * 100);
        } else {
            $post_porcent = 100;
        }
        if ($post_porcent > 100) {
            $post_porcent = 100;
        }
        // -------------------------------------------------------------------------------------------------------
        // Mise a jour de l'espace de stockage
        $planetrow['metal_max'] = (floor(BASE_STORAGE_SIZE * pow(1.5, $planetrow[$resource[22]]))) * (1 + ($user['rpg_stockeur'] * 0.5));
        $planetrow['crystal_max'] = (floor(BASE_STORAGE_SIZE * pow(1.5, $planetrow[$resource[23]]))) * (1 + ($user['rpg_stockeur'] * 0.5));
        $planetrow['deuterium_max'] = (floor(BASE_STORAGE_SIZE * pow(1.5, $planetrow[$resource[24]]))) * (1 + ($user['rpg_stockeur'] * 0.5));
        // -------------------------------------------------------------------------------------------------------
        $resource_row = "";
        $planetrow['metal_perhour'] = 0;
        $planetrow['crystal_perhour'] = 0;
        $planetrow['deuterium_perhour'] = 0;
        $planetrow['energy_max'] = 0;
        $planetrow['energy_used'] = 0;
        $BuildTemp = $planetrow['temp_max'];
        foreach ($reslist['prod'] as $ProdID) {
            if ($planetrow[$resource[$ProdID]] > 0 && isset($ProdGrid[$ProdID])) {
                $BuildLevelFactor = $planetrow[$resource[$ProdID] . "_porcent"];
                $BuildLevel = $planetrow[$resource[$ProdID]];
                $metal = floor(eval($ProdGrid[$ProdID]['formule']['metal']) * ( $game_config['resource_multiplier'] ) * ( 1 + ( $user['rpg_geologue'] * 0.05 ) ));
                $crystal = floor(eval($ProdGrid[$ProdID]['formule']['crystal']) * ( $game_config['resource_multiplier'] ) * ( 1 + ( $user['rpg_geologue'] * 0.05 ) ));
                $deuterium = floor(eval($ProdGrid[$ProdID]['formule']['deuterium']) * ( $game_config['resource_multiplier'] ) * ( 1 + ( $user['rpg_geologue'] * 0.05 ) ));
                $energy = floor(eval($ProdGrid[$ProdID]['formule']['energy']) * ( $game_config['resource_multiplier'] ) * ( 1 + ( $user['rpg_ingenieur'] * 0.05 ) ));
                if ($energy > 0) {
                    $planetrow['energy_max'] += $energy;
                } else {
                    $planetrow['energy_used'] += $energy;
                }
                $planetrow['metal_perhour'] += $metal;
                $planetrow['crystal_perhour'] += $crystal;
                $planetrow['deuterium_perhour'] += $deuterium;

                $this->tplObj->assign(array(
                    'ProdID' => $ProdID,
                    'lang' => $lang,
                    'resource' => $resource,
                    'planetrow' => $planetrow,
                    'metal_type' => colorNumber(pretty_number($metal * 0.01 * $post_porcent)),
                    'crystal_type' => colorNumber(pretty_number($crystal * 0.01 * $post_porcent)),
                    'deuterium_type' => colorNumber(pretty_number($deuterium * 0.01 * $post_porcent)),
                    'energy_type' => colorNumber(pretty_number($energy * 0.01 * $post_porcent)),
                    'name' => $resource[$ProdID],
                    'porcent'=>$planetrow[$resource[$ProdID] . "_porcent"],
                ));

                $resource_row .= $this->tplObj->fetch('resources.row.tpl');
            }
        }

        if ($planetrow['energy_max'] == 0 && $planetrow['energy_used'] > 0) {
            $parse['production_level'] = 0;
        } elseif ($planetrow['energy_max'] > 0 && abs($planetrow['energy_used']) > $planetrow['energy_max']) {
            $parse['production_level'] = floor(($planetrow['energy_max']) / $planetrow['energy_used'] * 100);
        } elseif ($planetrow['energy_max'] == 0 && abs($planetrow['energy_used']) > $planetrow['energy_max']) {
            $parse['production_level'] = 0;
        } else {
            $parse['production_level'] = 100;
        }
        if ($parse['production_level'] > 100) {
            $parse['production_level'] = 100;
        }
        $parse['production_level_bar'] = $parse['production_level'] * 2.5;
        $parse['production_level'] = "{$parse['production_level']}%";
        $parse['production_level_barcolor'] = '#00ff00';
        $QryUpdatePlanet = "UPDATE {{table}} SET ";
        $QryUpdatePlanet .= "`id` = '" . $planetrow['id'] . "' ";
        $QryUpdatePlanet .= $SubQry;
        $QryUpdatePlanet .= "WHERE ";
        $QryUpdatePlanet .= "`id` = '" . $planetrow['id'] . "';";
        doquery($QryUpdatePlanet, 'planets');

        $this->tplObj->assign(array(
            'title' => $lang['Resources'],
            'resource_row' => $resource_row,
            'metal_total' => colorNumber(pretty_number(floor(($planetrow['metal_perhour'] * 0.01 * $parse['production_level']) + ($game_config['metal_basic_income'] * $game_config['resource_multiplier'])))),
            'crystal_total' => colorNumber(pretty_number(floor(($planetrow['crystal_perhour'] * 0.01 * $parse['production_level']) + ($game_config['crystal_basic_income'] * $game_config['resource_multiplier'])))),
            'deuterium_total' => colorNumber(pretty_number(floor(($planetrow['deuterium_perhour'] * 0.01 * $parse['production_level']) + ($game_config['deuterium_basic_income'] * $game_config['resource_multiplier'])))),
            'energy_total' => colorNumber(pretty_number(floor(($planetrow['energy_max'] + ($game_config['energy_basic_income'] * $game_config['resource_multiplier'])) + $planetrow['energy_used']))),
            'daily_metal' => colorNumber(pretty_number(floor($planetrow['metal_perhour'] * 24 * 0.01 * $parse['production_level'] + ($game_config['metal_basic_income'] * $game_config['resource_multiplier']) * 24))),
            'weekly_metal' => colorNumber(pretty_number(floor($planetrow['metal_perhour'] * 24 * 7 * 0.01 * $parse['production_level'] + ($game_config['metal_basic_income'] * $game_config['resource_multiplier']) * 24 * 7))),
            'monthly_metal' => colorNumber(pretty_number(floor($planetrow['metal_perhour'] * 24 * 30 * 0.01 * $parse['production_level'] + ($game_config['metal_basic_income'] * $game_config['resource_multiplier']) * 24 * 30))),
            'daily_crystal' => colorNumber(pretty_number(floor($planetrow['crystal_perhour'] * 24 * 0.01 * $parse['production_level'] + ($game_config['crystal_basic_income'] * $game_config['resource_multiplier']) * 24))),
            'weekly_crystal' => colorNumber(pretty_number(floor($planetrow['crystal_perhour'] * 24 * 7 * 0.01 * $parse['production_level'] + ($game_config['crystal_basic_income'] * $game_config['resource_multiplier']) * 24 * 7))),
            'monthly_crystal' => colorNumber(pretty_number(floor($planetrow['crystal_perhour'] * 24 * 30 * 0.01 * $parse['production_level'] + ($game_config['crystal_basic_income'] * $game_config['resource_multiplier']) * 24 * 30))),
            'daily_deuterium' => colorNumber(pretty_number(floor($planetrow['deuterium_perhour'] * 24 * 0.01 * $parse['production_level'] + ($game_config['deuterium_basic_income'] * $game_config['resource_multiplier']) * 24))),
            'weekly_deuterium' => colorNumber(pretty_number(floor($planetrow['deuterium_perhour'] * 24 * 7 * 0.01 * $parse['production_level'] + ($game_config['deuterium_basic_income'] * $game_config['resource_multiplier']) * 24 * 7))),
            'monthly_deuterium' => colorNumber(pretty_number(floor($planetrow['deuterium_perhour'] * 24 * 30 * 0.01 * $parse['production_level'] + ($game_config['deuterium_basic_income'] * $game_config['resource_multiplier']) * 24 * 30))),
            'metal_storage' => floor($planetrow['metal'] / $planetrow['metal_max'] * 100) . $lang['o/o'],
            'crystal_storage' => floor($planetrow['crystal'] / $planetrow['crystal_max'] * 100) . $lang['o/o'],
            'deuterium_storage' => floor($planetrow['deuterium'] / $planetrow['deuterium_max'] * 100) . $lang['o/o'],
            'metal_storage_bar' => floor(($planetrow['metal'] / $planetrow['metal_max'] * 100) * 2.5),
            'crystal_storage_bar' => floor(($planetrow['crystal'] / $planetrow['crystal_max'] * 100) * 2.5),
            'deuterium_storage_bar' => floor(($planetrow['deuterium'] / $planetrow['deuterium_max'] * 100) * 2.5),
            'reslist' => $reslist,
            'resource' => $resource,
            'ProdGrid' => $ProdGrid,
        ));

        $this->render('resources.default.tpl');
    }

}
