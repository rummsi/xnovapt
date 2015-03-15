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
 * @ShowStatisticsPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 11:49:49
 */

/**
 * Description of ShowStatisticsPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowStatisticsPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'statistics';
    }

    function show() {
        global $lang, $user;

        includeLang('stat');

        $pwho = filter_input(INPUT_POST, 'who');
        $gwho = filter_input(INPUT_GET, 'who');
        $ptype = filter_input(INPUT_POST, 'type');
        $gtype = filter_input(INPUT_GET, 'type');
        $prange = filter_input(INPUT_POST, 'range');
        $grange = filter_input(INPUT_GET, 'range');

        $who = (isset($pwho)) ? $pwho : $gwho;
        if (!isset($who)) {
            $who = 1;
        }
        $type = (isset($ptype)) ? $ptype : $gtype;
        if (!isset($type)) {
            $type = 1;
        }
        $range = (isset($prange)) ? $prange : $grange;
        if (!isset($range)) {
            $range = 1;
        }

        if ($type == 1) {
            $Order = "total_points";
            $Points = "total_points";
            $Counts = "total_count";
            $Rank = "total_rank";
            $OldRank = "total_old_rank";
        } elseif ($type == 2) {
            $Order = "fleet_points";
            $Points = "fleet_points";
            $Counts = "fleet_count";
            $Rank = "fleet_rank";
            $OldRank = "fleet_old_rank";
        } elseif ($type == 3) {
            $Order = "tech_count";
            $Points = "tech_points";
            $Counts = "tech_count";
            $Rank = "tech_rank";
            $OldRank = "tech_old_rank";
        } elseif ($type == 4) {
            $Order = "build_points";
            $Points = "build_points";
            $Counts = "build_count";
            $Rank = "build_rank";
            $OldRank = "build_old_rank";
        } elseif ($type == 5) {
            $Order = "defs_points";
            $Points = "defs_points";
            $Counts = "defs_count";
            $Rank = "defs_rank";
            $OldRank = "defs_old_rank";
        }

        if ($who == 2) {
            $MaxAllys = doquery("SELECT COUNT(*) AS `count` FROM {{table}} WHERE 1;", 'alliance', true);
            if ($MaxAllys['count'] > 100) {
                $LastPage = floor($MaxAllys['count'] / 100);
            }
            $range = "";
            for ($Page = 0; $Page <= @$LastPage; $Page++) {
                $PageValue = ($Page * 100) + 1;
                $PageRange = $PageValue + 99;
                $range .= "<option value=\"" . $PageValue . "\"" . (($range == $PageValue) ? " SELECTED" : "") . ">" . $PageValue . "-" . $PageRange . "</option>";
            }

            $start = floor($range / 100 % 100) * 100;
            $query = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '2' AND `stat_code` = '1' ORDER BY `" . $Order . "` DESC LIMIT " . $start . ",100;", 'statpoints');

            $start++;
            $stat_values = "";
            while ($StatRow = mysqli_fetch_assoc($query)) {
                $stat_date = date("d M Y - H:i:s", $StatRow['stat_date']);
                $AllyRow = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $StatRow['id_owner'] . "';", 'alliance', true);

                $rank_old = $StatRow[$OldRank];
                if ($rank_old == 0) {
                    $rank_old = $start;
                    $QryUpdRank = doquery("UPDATE {{table}} SET `" . $Rank . "` = '" . $start . "', `" . $OldRank . "` = '" . $start . "' WHERE `stat_type` = '2' AND `stat_code` = '1' AND `id_owner` = '" . $StatRow['id_owner'] . "';", "statpoints");
                } else {
                    $QryUpdRank = doquery("UPDATE {{table}} SET `" . $Rank . "` = '" . $start . "' WHERE `stat_type` = '2' AND `stat_code` = '1' AND `id_owner` = '" . $StatRow['id_owner'] . "';", "statpoints");
                }
                $rank_new = $start;
                $ranking = $rank_old - $rank_new;

                $this->tplObj->assign(array(
                    'ally_rank' => $start,
                    'ranking' => $ranking,
                    'ally_tag' => $AllyRow['ally_tag'],
                    'ally_name' => $AllyRow['ally_name'],
                    'ally_mes' => '',
                    'ally_members' => $AllyRow['ally_members'],
                    'ally_points' => pretty_number($StatRow[$Order]),
                    'ally_members_points' => pretty_number(floor($StatRow[$Order] / $AllyRow['ally_members'])),
                ));

                $stat_values .= $this->tplObj->fetch('statistics.alliance.tpl');
                $start++;
            }

            $this->tplObj->assign(array(
                'title' => $lang['stat_title'],
                'who' => $who,
                'type' => $type,
                'range' => $range,
                'query' => $query,
                'ranking' => $rank_old - $rank_new,
                'start' => $start,
                'Order' => $Order,
                'stat_values' => $stat_values,
                'stat_date' => $stat_date,
            ));

            $this->render('statistics.default.tpl');
        } else {
            $MaxUsers = doquery("SELECT COUNT(*) AS `count` FROM {{table}} WHERE `db_deaktjava` = '0';", 'users', true);
            if ($MaxUsers['count'] > 100) {
                $LastPage = floor($MaxUsers['count'] / 100);
            }
            $range = "";
            for ($Page = 0; $Page <= @$LastPage; $Page++) {
                $PageValue = ($Page * 100) + 1;
                $PageRange = $PageValue + 99;
                $range .= "<option value=\"" . $PageValue . "\"" . (($range == $PageValue) ? " SELECTED" : "") . ">" . $PageValue . "-" . $PageRange . "</option>";
            }


            $start = floor($range / 100 % 100) * 100;
            $query = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `" . $Order . "` DESC LIMIT " . $start . ",100;", 'statpoints');

            $start++;
            $stat_values = "";
            while ($StatRow = mysqli_fetch_assoc($query)) {
                $stat_date = date("d M Y - H:i:s", $StatRow['stat_date']);
                $UsrRow = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $StatRow['id_owner'] . "';", 'users', true);

                $rank_old = $StatRow[$OldRank];
                if ($rank_old == 0) {
                    $rank_old = $start;
                    $QryUpdRank = doquery("UPDATE {{table}} SET `" . $Rank . "` = '" . $start . "', `" . $OldRank . "` = '" . $start . "' WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $StatRow['id_owner'] . "';", "statpoints");
                } else {
                    $QryUpdRank = doquery("UPDATE {{table}} SET `" . $Rank . "` = '" . $start . "' WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $StatRow['id_owner'] . "';", "statpoints");
                }
                $rank_new = $start;
                $ranking = $rank_old - $rank_new;

                $this->tplObj->assign(array(
                    'player_rank' => $start,
                    'range' => $range,
                    'ranking' => $ranking,
                    'UsrRow' => $UsrRow,
                    'lang' => $lang,
                    'user' => $user,
                    'player_points' => pretty_number($StatRow[$Order]),
                ));

                $stat_values .= $this->tplObj->fetch('statistics.player.tpl');
                $start++;
            }

            $this->tplObj->assign(array(
                'title' => $lang['stat_title'],
                'who' => $who,
                'type' => $type,
                'stat_date' => $stat_date,
                'range' => $range,
                'query' => $query,
                'ranking' => $rank_old - $rank_new,
                'start' => $start,
                'UsrRow' => $UsrRow,
                'Order' => $Order,
                'stat_values' => $stat_values,
            ));

            $this->render('statistics.default.tpl');
        }
    }

}
