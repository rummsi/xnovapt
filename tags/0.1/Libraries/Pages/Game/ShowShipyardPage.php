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
 * @ShowShipyardPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 15:40:35
 */

require_once ROOT_PATH . 'includes/classes/Legacies/Empire/Shipyard.php';

/**
 * Description of ShowShipyardPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowShipyardPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'shipyard';
    }

    function show() {
        global $lang, $resource, $planetrow, $user;

        includeLang('buildings');
        includeLang('infos');

        // S'il n'y a pas de Chantier
        if (!isset($planetrow[$resource[Legacies_Empire::ID_BUILDING_SHIPYARD]]) || $planetrow[$resource[Legacies_Empire::ID_BUILDING_SHIPYARD]] == 0) {
            message($lang['need_hangar'], $lang['tech'][Legacies_Empire::ID_BUILDING_SHIPYARD]);
            return;
        }

        $shipyard = Legacies_Empire_Shipyard::factory($planetrow, $user);
        if (isset($_POST['fmenge']) && is_array($_POST['fmenge'])) {
            foreach ($_POST['fmenge'] as $shipId => $count) {
                $shipId = intval($shipId);
                if (in_array($shipId, $resource)) {
                    continue;
                }
                $count = intval($count);
                if ($count <= 0) {
                    continue;
                }

                if ($shipId == Legacies_Empire::ID_SHIP_DEATH_STAR && $user['rpg_destructeur'] == 1) { // FIXME: Officers
                    $count = $count * 2;
                }
                $shipyard->appendQueue($shipId, $count);
            }
            $planetrow = $shipyard->save();
        }

        $types = include ROOT_PATH . 'includes/data/types.php';
        $shipId = $types[Legacies_Empire::TYPE_SHIP];

        $data = array();
        foreach ($shipyard->getQueue() as $item) {
            $data[] = array_merge($item, array(
                'label' => $lang['tech'][$item['ship_id']],
                'speed' => $shipyard->getBuildTime($item['ship_id'], 1)
            ));
        }

        $this->tplObj->assign(array(
            'title' => $lang['Shipyard'],
            'types' => $types,
            'shipyard' => $shipyard,
            'resource' => $resource,
            'data' => json_encode($data),
        ));

        $this->render('shipyard.default.tpl');
    }

}
