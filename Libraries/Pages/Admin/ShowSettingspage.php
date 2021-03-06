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
 * @ShowSettingspage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  11/Dez/2014 19:20:09
 */

/**
 * Description of ShowSettingspage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowSettingspage extends AbstractAdminPage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'admin_settings';
    }

    function show() {
        global $lang, $game_config, $user;

        includeLang('admin/settings');

        if (in_array((int) $user['authlevel'], array(LEVEL_ADMIN))) {
            $post = filter_input_array(INPUT_POST);
            if ($post['opt_save'] == "1") {
                // Jeu Ouvert ou Ferm� !
                if (isset($post['closed']) && $post['closed'] == 'on') {
                    $game_config['game_disable'] = "1";
                    $game_config['close_reason'] = addslashes($post['close_reason']);
                } else {
                    $game_config['game_disable'] = "0";
                    $game_config['close_reason'] = "";
                }

                // Y a un News Frame ? !
                if (isset($post['newsframe']) && $post['newsframe'] == 'on') {
                    $game_config['OverviewNewsFrame'] = "1";
                    $game_config['OverviewNewsText'] = addslashes($post['NewsText']);
                } else {
                    $game_config['OverviewNewsFrame'] = "0";
                    $game_config['OverviewNewsText'] = "";
                }

                // Y a un TCHAT externe ??
                if (isset($post['chatframe']) && $post['chatframe'] == 'on') {
                    $game_config['OverviewExternChat'] = "1";
                    $game_config['OverviewExternChatCmd'] = addslashes($post['ExternChat']);
                } else {
                    $game_config['OverviewExternChat'] = "0";
                    $game_config['OverviewExternChatCmd'] = "";
                }

                if (isset($post['googlead']) && $post['googlead'] == 'on') {
                    $game_config['OverviewBanner'] = "1";
                    $game_config['OverviewClickBanner'] = addslashes($post['GoogleAds']);
                } else {
                    $game_config['OverviewBanner'] = "0";
                    $game_config['OverviewClickBanner'] = "";
                }

                // Y a un BANNER Frame ?
                if (isset($post['bannerframe']) && $post['bannerframe'] == 'on') {
                    $game_config['ForumBannerFrame'] = "1";
                } else {
                    $game_config['ForumBannerFrame'] = "0";
                }

                // Mode Debug ou pas !
                if (isset($post['debug']) && $post['debug'] == 'on') {
                    $game_config['debug'] = "1";
                } else {
                    $game_config['debug'] = "0";
                }

                // Nom du Jeu
                if (isset($post['game_name']) && $post['game_name'] != '') {
                    $game_config['game_name'] = $post['game_name'];
                }

                // Adresse du Forum
                if (isset($post['forum_url']) && $post['forum_url'] != '') {
                    $game_config['forum_url'] = $post['forum_url'];
                }

                // Vitesse du Jeu
                if (isset($post['game_speed']) && is_numeric($post['game_speed'])) {
                    $game_config['game_speed'] = $post['game_speed'];
                }

                // Vitesse des Flottes
                if (isset($post['fleet_speed']) && is_numeric($post['fleet_speed'])) {
                    $game_config['fleet_speed'] = $post['fleet_speed'];
                }

                // Multiplicateur de Production
                if (isset($post['resource_multiplier']) && is_numeric($post['resource_multiplier'])) {
                    $game_config['resource_multiplier'] = $post['resource_multiplier'];
                }

                // Taille de la planete mère
                if (isset($post['initial_fields']) && is_numeric($post['initial_fields'])) {
                    $game_config['initial_fields'] = $post['initial_fields'];
                }

                // Revenu de base Metal
                if (isset($post['metal_basic_income']) && is_numeric($post['metal_basic_income'])) {
                    $game_config['metal_basic_income'] = $post['metal_basic_income'];
                }

                // Revenu de base Cristal
                if (isset($post['crystal_basic_income']) && is_numeric($post['crystal_basic_income'])) {
                    $game_config['crystal_basic_income'] = $post['crystal_basic_income'];
                }

                // Revenu de base Deuterium
                if (isset($post['deuterium_basic_income']) && is_numeric($post['deuterium_basic_income'])) {
                    $game_config['deuterium_basic_income'] = $post['deuterium_basic_income'];
                }

                // Revenu de base Energie
                if (isset($post['energy_basic_income']) && is_numeric($post['energy_basic_income'])) {
                    $game_config['energy_basic_income'] = $post['energy_basic_income'];
                }

                // Lien supplémentaire dans le menu
                if (isset($post['enable_link_']) && is_numeric($post['enable_link_'])) {
                    $game_config['link_enable'] = $post['enable_link_'];
                }
                // Texte de ce lien...
                $game_config['link_name'] = addslashes($post['name_link_']);

                // URL de ce lien...
                $game_config['link_url'] = $post['url_link_'];
                // Image de la bannière
                $game_config['banner_source_post'] = $post['banner_source_post'];
                // 1 point = ??? Ressources ?
                if (isset($post['stat_settings']) && is_numeric($post['stat_settings'])) {
                    $game_config['stat_settings'] = $post['stat_settings'];
                }
                // Activation -ou non- des annonces
                if (isset($post['enable_announces_']) && is_numeric($post['enable_announces_'])) {
                    $game_config['enable_announces'] = $post['enable_announces_'];
                }
                // Activation -ou non- du marchand
                if (isset($post['enable_marchand_']) && is_numeric($post['enable_marchand_'])) {
                    $game_config['enable_marchand'] = $post['enable_marchand_'];
                }
                // Activation -ou non- des notes
                if (isset($post['enable_notes_']) && is_numeric($post['enable_notes_'])) {
                    $game_config['enable_notes'] = $post['enable_notes_'];
                }
                // Nom du bot antimulti
                $game_config['bot_name'] = addslashes($post['name_bot']);

                // email du bot antimulti
                $game_config['bot_adress'] = addslashes($post['adress_bot']);

                // Activation -ou non- des notes
                if (isset($post['duration_ban']) && is_numeric($post['duration_ban'])) {
                    $game_config['ban_duration'] = $post['duration_ban'];
                }

                // Activation -ou non- du bot
                if (isset($post['bot_enable']) && is_numeric($post['bot_enable'])) {
                    $game_config['enable_bot'] = $post['bot_enable'];
                }

                // BBCode ou pas ?
                if (isset($post['bbcode_field']) && is_numeric($post['bbcode_field'])) {
                    $game_config['enable_bbcode'] = $post['bbcode_field'];
                }

                // Activation du jeu
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['game_disable'] . "' WHERE `config_name` = 'game_disable';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['close_reason'] . "' WHERE `config_name` = 'close_reason';", 'config');

                //Stats
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['stat_settings'] . "' WHERE `config_name` = 'stat_settings';", 'config');

                // Configuration du Jeu
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['forum_url'] . "' WHERE `config_name` = 'forum_url';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['game_name'] . "' WHERE `config_name` = 'game_name';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['game_speed'] . "' WHERE `config_name` = 'game_speed';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['fleet_speed'] . "' WHERE `config_name` = 'fleet_speed';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['resource_multiplier'] . "' WHERE `config_name` = 'resource_multiplier';", 'config');

                // Page Generale
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['OverviewNewsFrame'] . "' WHERE `config_name` = 'OverviewNewsFrame';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['OverviewNewsText'] . "' WHERE `config_name` = 'OverviewNewsText';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['OverviewExternChat'] . "' WHERE `config_name` = 'OverviewExternChat';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['OverviewExternChatCmd'] . "' WHERE `config_name` = 'OverviewExternChatCmd';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['OverviewBanner'] . "' WHERE `config_name` = 'OverviewBanner';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['OverviewClickBanner'] . "' WHERE `config_name` = 'OverviewClickBanner';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['ForumBannerFrame'] . "' WHERE `config_name` = 'ForumBannerFrame';", 'config');

                //Bannière
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['banner_source_post'] . "' WHERE `config_name` = 'banner_source_post';", 'config');

                // Lien supplémentaire dans le menu
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['link_enable'] . "' WHERE `config_name` = 'link_enable';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['link_name'] . "' WHERE `config_name` = 'link_name';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['link_url'] . "' WHERE `config_name` = 'link_url';", 'config');

                // Options Planete
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['initial_fields'] . "' WHERE `config_name` = 'initial_fields';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['metal_basic_income'] . "' WHERE `config_name` = 'metal_basic_income';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['crystal_basic_income'] . "' WHERE `config_name` = 'crystal_basic_income';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['deuterium_basic_income'] . "' WHERE `config_name` = 'deuterium_basic_income';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['energy_basic_income'] . "' WHERE `config_name` = 'energy_basic_income';", 'config');

                //Bot antimulti
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['bot_name'] . "' WHERE `config_name` = 'bot_name';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['bot_adress'] . "' WHERE `config_name` = 'bot_adress';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['ban_duration'] . "' WHERE `config_name` = 'ban_duration';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['enable_bot'] . "' WHERE `config_name` = 'enable_bot';", 'config');

                //Réglage du BBCode
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['enable_bbcode'] . "' WHERE `config_name` = 'enable_bbcode';", 'config');

                //Controle des pages
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['enable_announces'] . "' WHERE `config_name` = 'enable_announces';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['enable_marchand'] . "' WHERE `config_name` = 'enable_marchand';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['enable_notes'] . "' WHERE `config_name` = 'enable_notes';", 'config');

                // Mode Debug
                doquery("UPDATE {{table}} SET `config_value` = '" . $game_config['debug'] . "' WHERE `config_name` ='debug'", 'config');
                AdminMessage('Options changees avec succes !', 'Succes', '?');
            } else {

                $this->tplObj->assign(array(
                    'title' => $lang['adm_opt_title'],
                    'game_config' => $game_config,
                    'closed' => ($game_config['game_disable'] == 1) ? " checked = 'checked' " : "",
                    'newsframe' => ($game_config['OverviewNewsFrame'] == 1) ? " checked = 'checked' " : "",
                    'chatframe' => ($game_config['OverviewExternChat'] == 1) ? " checked = 'checked' " : "",
                    'googlead' => ($game_config['OverviewBanner'] == 1) ? " checked = 'checked' " : "",
                    'debug' => ($game_config['debug'] == 1) ? " checked = 'checked' " : "",
                    'bannerframe' => ($game_config['ForumBannerFrame'] == 1) ? " checked = 'checked' " : "",
                ));

                $this->render('settings.default.tpl');
            }
        } else {
            AdminMessage($lang['sys_noalloaw'], $lang['sys_noaccess']);
        }
    }

}
