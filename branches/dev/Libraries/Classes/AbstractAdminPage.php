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
 * @AbstractAdminPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  11/Dez/2014 14:02:49
 */

/**
 * Description of AbstractAdminPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class AbstractAdminPage {

    protected $tplObj;
    protected $window;
    public $defaultWindow = 'full';

    function __construct() {
        if (!AJAX_REQUEST) {
            $this->setWindow($this->defaultWindow);
            $this->initTemplate();
        } else {
            $this->setWindow('ajax');
        }
    }

    protected function setWindow($window) {
        $this->window = $window;
    }

    protected function initTemplate() {
        if (isset($this->tplObj)) {
            return true;
        }
        $this->tplObj = new template;
        list($tplDir) = $this->tplObj->getTemplateDir();
        $this->tplObj->setTemplateDir($tplDir . 'admin/');
        return true;
    }

    protected function render($file) {
        global $langInfos, $user, $planetrow;

        if ($this->getWindow() !== 'ajax') {
            $this->ShowNavigationMenus($user, $planetrow);
        }

        $this->tplObj->assign(array(
            'dpath' => DEFAULT_SKINPATH,
            'encoding' => $langInfos['ENCODING'],
        ));

        $this->tplObj->display('extends:layout.' . $this->getWindow() . '.tpl|' . $file);
        exit;
    }

    protected function getWindow() {
        return $this->window;
    }

    protected function getQueryString() {
        $queryString = array();
        $page = HTTP::_GP('page', '');
        if (!empty($page)) {
            $queryString['page'] = $page;
        }
        $mode = HTTP::_GP('mode', '');
        if (!empty($mode)) {
            $queryString['mode'] = $mode;
        }
        return http_build_query($queryString);
    }

    function ShowNavigationMenus() {
        global $lang, $user, $game_config, $planetrow;

        includeLang('leftmenu');
        includeLang('admin');

        if (in_array($user['authlevel'], array(LEVEL_ADMIN, LEVEL_OPERATOR, LEVEL_MODERATOR))) {
            $this->tplObj->assign(array(
                'XNovaRelease' => VERSION,
                'servername' => $game_config['game_name'],
                'lang' => $lang,
            ));
        } else {
            message($lang['sys_noalloaw'], $lang['sys_noaccess']);
        }
    }

    function getTemplate($templateName) {
        $filename = realpath(ROOT_PATH . '/Libraries/App/templates/Admin') . "/{$templateName}";
        return ReadFromFile($filename);
    }

}
