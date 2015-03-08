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
 * @ShowChatPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 13:26:07
 */

/**
 * Description of ShowChatPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowChatPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'chat';
    }

    function show() {
        global $lang, $title, $user;
        includeLang('chat');

        $this->tplObj->assign(array(
            'title' => $lang['Chat'],
            'nick' => $user['username'],
        ));

        $this->render('chat.default.tpl');
    }

}
