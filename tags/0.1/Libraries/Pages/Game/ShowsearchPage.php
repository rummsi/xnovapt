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
 * @ShowsearchPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 11:57:15
 */

/**
 * Description of ShowsearchPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowSearchPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'search';
    }

    function show() {
        global $lang, $user;
        includeLang('search');

        $type = filter_input(INPUT_POST, 'type');

        $dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];

        $i = 0;
        //creamos la query
        $searchtext = mysql_real_escape_string(filter_input(INPUT_POST, 'searchtext'));
        switch ($type) {
            case "playername":
                $table = $this->getTemplate('search.user_table.tpl');
                $row = $this->getTemplate('search.user_row.tpl');
                $search = doquery("SELECT * FROM {{table}} WHERE username LIKE '%{$searchtext}%' LIMIT 30;", "users");
                break;
            case "planetname":
                $table = $this->getTemplate('search.user_table.tpl');
                $row = $this->getTemplate('search.user_row.tpl');
                $search = doquery("SELECT * FROM {{table}} WHERE name LIKE '%{$searchtext}%' LIMIT 30", 'planets');
                break;
            case "allytag":
                $table = $this->getTemplate('search.ally_table.tpl');
                $row = $this->getTemplate('search.ally_row.tpl');
                $search = doquery("SELECT * FROM {{table}} WHERE ally_tag LIKE '%{$searchtext}%' LIMIT 30", "alliance");
                break;
            case "allyname":
                $table = $this->getTemplate('search.ally_table.tpl');
                $row = $this->getTemplate('search.ally_row.tpl');
                $search = doquery("SELECT * FROM {{table}} WHERE ally_name LIKE '%{$searchtext}%' LIMIT 30", "alliance");
                break;
            default:
                $table = $this->getTemplate('search.user_table.tpl');
                $row = $this->getTemplate('search.user_row.tpl');
                $search = doquery("SELECT * FROM {{table}} WHERE username LIKE '%{$searchtext}%' LIMIT 30", "users");
        }
        /*
          Esta es la tecnica de, "el ahorro de queries".
          Inventada por Perberos :3
          ...pero ahora no... porque tengo sueño ;P
         */
        if (isset($searchtext) && isset($type)) {
            while ($r = mysql_fetch_array($search, MYSQL_BOTH)) {
                if ($type == 'playername' || $type == 'planetname') {
                    $s = $r;
                    //para obtener el nombre del planeta
                    //ahora la alianza
                    if (@$s['ally_id'] != 0 && $s['ally_request'] == 0) {
                        $aquery = doquery("SELECT ally_name FROM {{table}} WHERE id = {$s['ally_id']}", "alliance", true);
                    } else {
                        $aquery = array();
                    }
                    if ($type == "planetname") {
                        $pquery = doquery("SELECT * FROM {{table}} WHERE id = {$s['id_owner']}", "users", true);
                        /* 			$farray = mysql_fetch_array($pquery); */
                        $s['planet_name'] = $s['name'];
                        $s['username'] = $pquery['username'];
                        $s['ally_name'] = ($pquery['ally_name'] != '') ? "<a href=\"game.php?page=alliance&mode=ainfo&tag={$pquery['ally_name']}\">{$pquery['ally_name']}</a>" : '';
                    } else {
                        $pquery = doquery("SELECT name FROM {{table}} WHERE id = {$s['id_planet']}", "planets", true);
                        $s['planet_name'] = $pquery['name'];
                        @$s['ally_name'] = ($aquery['ally_name'] != '') ? "<a href=\"game.php?page=alliance&mode=ainfo&tag={$aquery['ally_name']}\">{$aquery['ally_name']}</a>" : '';
                    }

                    @$s['position'] = "<a href=\"game.php?page=statistics&start=" . $s['rank'] . "\">" . $s['rank'] . "</a>";
                    $s['dpath'] = $dpath;
                    $s['coordinated'] = "{$s['galaxy']}:{$s['system']}:{$s['planet']}";
                    $s['buddy_request'] = $lang['buddy_request'];
                    $s['write_a_messege'] = $lang['write_a_messege'];
                    @$result_list .= parsetemplate($row, $s);
                } elseif ($type == 'allytag' || $type == 'allyname') {
                    $s = $r;

                    @$s['ally_points'] = pretty_number($s['ally_points']);

                    $s['ally_tag'] = "<a href=\"game.php?page=alliance&mode=ainfo&tag={$s['ally_tag']}\">{$s['ally_tag']}</a>";
                    @$result_list .= parsetemplate($row, $s);
                }
            }
            if ($result_list != '') {
                $lang['result_list'] = $result_list;
                $search_results = parsetemplate($table, $lang);
            }
        }

        $this->tplObj->assign(array(
            'title' => $lang['Search'],
            'type_playername' => ($type == "playername") ? " SELECTED" : "",
            'type_planetname' => ($type == "planetname") ? " SELECTED" : "",
            'type_allytag' => ($type == "allytag") ? " SELECTED" : "",
            'type_allyname' => ($type == "allyname") ? " SELECTED" : "",
            'searchtext' => $searchtext,
            'search_results' => @$search_results,
        ));

        $this->render('search.default.tpl');
    }

}
