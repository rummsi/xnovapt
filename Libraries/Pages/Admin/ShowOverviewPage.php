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
 * @ShowOverviewPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  11/Dez/2014 14:07:19
 */

/**
 * Description of ShowOverviewPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowOverviewPage extends AbstractAdminPage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'admin_overview';
    }

    function show() {
        global $lang, $user, $dpath;
        includeLang('admin');

        if (in_array($user['authlevel'], array(LEVEL_ADMIN, LEVEL_OPERATOR, LEVEL_MODERATOR))) {

            if (filter_input(INPUT_GET, 'cmd') == 'sort') {
                $TypeSort = filter_input(INPUT_GET, 'type');
            } else {
                $TypeSort = "id";
            }

            $Last15Mins = doquery("SELECT * FROM {{table}} WHERE `onlinetime` >= '" . (time() - 15 * 60) . "' ORDER BY `" . $TypeSort . "` ASC;", 'users');
            while ($TheUser = mysql_fetch_array($Last15Mins)) {
                $UserPoints = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $TheUser['id'] . "';", 'statpoints', true);

                $this->tplObj->assign(array(
                    'adm_ov_data_point' => pretty_number($UserPoints['total_points']),
                    'PrevIP' => $TheUser['user_lastip'],
                ));
            }

            $this->tplObj->assign(array(
                'title' => $lang['sys_overview'],
                'adm_ov_data_yourv' => colorRed(VERSION),
                'Last15Mins' => doquery("SELECT * FROM {{table}} WHERE `onlinetime` >= '" . (time() - 15 * 60) . "' ORDER BY `" . $TypeSort . "` ASC;", 'users'),
            ));

            $this->render('overview.default.tpl');
        } else {
            AdminMessage($lang['sys_noalloaw'], $lang['sys_noaccess']);
        }
    }

}
