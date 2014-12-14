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
 * @ShowUserlistPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  12/Dez/2014 16:21:50
 */

/**
 * Description of ShowUserlistPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowUserlistPage extends AbstractAdminPage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'admin_userslist';
    }

    function show() {
        global $lang, $user;

        includeLang('admin');

        if (in_array($user['authlevel'], array(LEVEL_ADMIN, LEVEL_OPERATOR))) {
            $gcmd = filter_input(INPUT_GET, 'cmd');
            if ($gcmd == 'dele') {
                DeleteSelectedUser(filter_input(INPUT_GET, 'user'));
            }
            if ($gcmd == 'sort') {
                $TypeSort = filter_input(INPUT_GET, 'type');
            } else {
                $TypeSort = "id";
            }

            $query = doquery("SELECT * FROM {{table}} ORDER BY `" . $TypeSort . "` ASC", 'users');

            $this->tplObj->assign(array(
                'title' => $lang['adm_ul_title'],
                'query' =>doquery("SELECT * FROM {{table}} ORDER BY `" . $TypeSort . "` ASC", 'users'),
            ));

            $this->render('userlist.default.tpl');
        } else {
            ShowErrorPage::message($lang['sys_noalloaw'], $lang['sys_noaccess']);
        }
    }

}
