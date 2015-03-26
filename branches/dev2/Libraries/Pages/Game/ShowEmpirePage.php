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
 * @ShowEmpirePage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 20:22:38
 */

/**
 * Description of ShowEmpirePage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowEmpirePage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'empire';
    }

    function show() {
        global $lang, $user, $resource, $reslist;
        includeLang('imperium');

        $this->initTemplate();
        $this->setWindow('popup');

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
        $planetsrow = doquery($QryPlanets, 'planets');

        $planet = array();
        while ($p = mysqli_fetch_array($planetsrow)) {
            $planet[] = $p;
        }

        $this->tplObj->assign(array(
            'title' => $lang['Imperium'],
            'mount' => count($planet) + 1,
            'planet' => $planet,
            'planetsrow' => $planetsrow,
            'resource' => $resource,
            'reslist' => $reslist,
//            'datatext' => ($p[$resource[$i]]    === 0) ? '-' : "<a href=\"buildings.php?cp={$p['id']}&amp;re=0&amp;planettype={$p['planet_type']}\">{$p[$resource[$i]]}</a>",
        ));

        $this->render('empire.default.tpl');
    }

}
