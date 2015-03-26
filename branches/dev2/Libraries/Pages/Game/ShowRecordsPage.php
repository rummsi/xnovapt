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
 * @ShowRecordsPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 12:02:58
 */

/**
 * Description of ShowRecordsPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowRecordsPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'records';
    }

    function show() {
        global $lang, $resource, $element;

        $cacheFile = ROOT_PATH . '/cache/' . basename(__FILE__) . '.cache';
        $timeDelay = 21600; // 21600s = 6h

        if (!file_exists($cacheFile) || (time() - filemtime($cacheFile)) > $timeDelay) {
            ob_start();

            includeLang('records');


            foreach ($lang['tech'] as $element => $elementName) {
                if (!empty($elementName) && !empty($resource[$element])) {
                    $data = array();
                    if ($element >= 0 && $element < 100 || $element >= 200 && $element < 600) {
                        $record = doquery(sprintf(
                                        'SELECT IF(COUNT(u.username)<=10,GROUP_CONCAT(DISTINCT u.username ORDER BY u.username DESC SEPARATOR ", "),"Plus de 10 joueurs ont ce record") AS players, p.%1$s AS level ' .
                                        'FROM {{table}}users AS u ' .
                                        'LEFT JOIN {{table}}planets AS p ON (u.id=p.id_owner) ' .
                                        'WHERE p.%1$s=(SELECT MAX(p2.%1$s) FROM {{table}}planets AS p2) AND p.%1$s>0 ' .
                                        'GROUP BY p.%1$s ORDER BY u.username ASC', $resource[$element]), '', true);
                    } else if ($element >= 100 && $element < 200) {
                        $record = doquery(sprintf(
                                        'SELECT IF(COUNT(u.username)<=10,GROUP_CONCAT(DISTINCT u.username ORDER BY u.username DESC SEPARATOR ", "),"Plus de 10 joueurs ont ce record") AS players, u.%1$s AS level ' .
                                        'FROM {{table}}users AS u ' .
                                        'WHERE u.%1$s=(SELECT MAX(u2.%1$s) FROM {{table}}users AS u2) AND u.%1$s>0 ' .
                                        'GROUP BY u.%1$s ORDER BY u.username ASC', $resource[$element]), '', true);
                    } else {
                        continue;
                    }
                }
            }

            $this->tplObj->assign(array(
                'title' => $lang['rec_title'],
                'tech' => $lang['tech'],
                'resource' => $resource,
                'element' => $element,
                'record' => $record,
                'winner' => !empty($record['players']) ? $record['players'] : '-',
            ));

            $this->render('records.default.tpl');

            $data = ob_get_contents();
            ob_end_flush();

            file_put_contents($cacheFile, $data);
        } else {
            echo file_get_contents($cacheFile);
        }
    }

}
