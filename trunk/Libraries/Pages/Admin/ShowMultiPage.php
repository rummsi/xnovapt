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
 * @ShowMultiPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  14/Dez/2014 11:20:52
 */

/**
 * Description of ShowMultiPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowMultiPage extends AbstractAdminPage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'admin_multi';
    }

    function show() {
        global $lang, $user;

        includeLang('admin/multi');

        if (in_array($user['authlevel'], array(LEVEL_ADMIN, LEVEL_OPERATOR, LEVEL_MODERATOR))) {

            $this->tplObj->assign(array(
                'title' => $lang['adm_mt_title'],
                'query' => doquery("SELECT * FROM {{table}}", 'multi'),
            ));

            $this->render('multi.default.tpl');
        } else {
            ShowErrorPage::message($lang['sys_noalloaw'], $lang['sys_noaccess']);
        }
    }

}
