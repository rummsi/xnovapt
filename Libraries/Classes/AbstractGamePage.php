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
 * @AbstractGamePage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  2/Dez/2014 22:55:09
 */

/**
 * Description of AbstractGamePage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
abstract class AbstractGamePage {

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
        $this->tplObj->setTemplateDir($tplDir . 'game/');
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
        includeLang('topnav');

        $rank = doquery("SELECT `total_rank` FROM {{table}} WHERE `stat_code` = '1' AND `stat_type` = '1' AND `id_owner` = '" . $user['id'] . "';", 'statpoints', true);
        $this->tplObj->assign(array(
            'XNovaRelease' => VERSION,
            'user_rank' => $rank['total_rank'],
            'lm_tx_game' => $game_config['game_speed'] / 2500,
            'lm_tx_fleet' => $game_config['fleet_speed'] / 2500,
            'lm_tx_queue' => MAX_FLEET_OR_DEFS_PER_ROW,
            'user' => $user,
            'lang' => $lang,
            'game_config' => $game_config,
            'lm_tx_queue' => MAX_FLEET_OR_DEFS_PER_ROW,
        ));

        if ($user) {
            if (!$planetrow) {
                $planetrow = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $user['current_planet'] . "';", 'planets', true);
            }

            $this->tplObj->assign(array(
                'planetrow' => $planetrow,
                'ThisUsersPlanets' => SortUserPlanets($user),
                'page'=>filter_input(INPUT_GET, 'page'),
                'mode'=>HTTP::_GP('mode', ''),
            ));
        }
    }

    function getTemplate($templateName) {
        $filename = realpath(ROOT_PATH . '/Libraries/App/templates/Game') . "/{$templateName}";
        return ReadFromFile($filename);
    }

}
