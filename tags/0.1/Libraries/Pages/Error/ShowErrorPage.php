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
 * @ShowErrorPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  2/Dez/2014 20:55:02
 */

/**
 * Description of ShowErrorPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowErrorPage {

    static function message($mes, $title = 'Error', $dest = "", $time = "3", $color = 'orange') {
        $parse['color'] = $color;
        $parse['title'] = $title;
        $parse['mes'] = $mes;

        $page = parsetemplate(gettemplate('admin/message_body'), $parse);

        Display::login2($page, $title, false, (($dest != "") ? "<meta http-equiv=\"refresh\" content=\"$time;URL={$dest}\">" : ""), true);
    }

}
