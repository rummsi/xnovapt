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
 * @version 0.01  6/Dez/2014 13:37:22
 */

/**
 * Description of ShowMultiPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowMultiPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'multi';
    }

    function show() {
        global $lang, $title;

        includeLang('multi');

        $Mode = HTTP::_GP('mode', '');

        $this->tplObj->assign(array(
            'title' => $lang['multi_declare'],
        ));

        $this->render('multi.default.tpl');
    }

    function addit() {
        global $lang, $title, $user;

        includeLang('multi');
        $Mode = HTTP::_GP('mode', '');

        $declarator = $user['id'];
        $declarator_name = addslashes(htmlspecialchars($user['username']));
        $decl1 = addslashes(htmlspecialchars($_POST['dec1']));
        $decl2 = addslashes(htmlspecialchars($_POST['dec2']));
        $decl3 = addslashes(htmlspecialchars($_POST['dec3']));
        $reason1 = addslashes(htmlspecialchars($_POST['reason']));

        $QryDeclare = "INSERT INTO {{table}} SET ";
        $QryDeclare .= "`declarator` = '" . $declarator . "', ";
        $QryDeclare .= "`declarator_name` = '" . $declarator_name . "', ";
        $QryDeclare .= "`declared_1` = '" . $decl1 . "', ";
        $QryDeclare .= "`declared_2` = '" . $decl2 . "', ";
        $QryDeclare .= "`declared_3` = '" . $decl3 . "', ";
        $QryDeclare .= "`reason`     = '" . $reason1 . "' ";

        doquery($QryDeclare, "declared");
        doquery("UPDATE {{table}} SET multi_validated ='1' WHERE username='{$user['username']}'", "users");

        AdminMessage($lang['multi_message_content'], $lang['multi_message_add']);
    }

}
