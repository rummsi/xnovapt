{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br /><br />
            <h2>{$lang['adm_opt_title']}</h2>
            <form action="" method="post">
                <input type="hidden" name="opt_save" value="1">
                <table width="519" style="color:#FFFFFF">
                    <tbody>
                        <tr>
                            <td class="c" colspan="2">{$lang['adm_opt_game_settings']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_name']}</th>
                            <th><input name=game_name size=20 value={$game_config['game_name']} type=text></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_menu_link_enable']}</th>
                            <th><input name="enable_link_" size="20" value="{$game_config['link_enable']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_menu_link_text']}</th>
                            <th><input name="name_link_" size="20" value="{$game_config['link_name']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_menu_link_url']}</th>
                            <th><input name="url_link_" size="20" value="{$game_config['link_url']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_gspeed']}</th>
                            <th><input name="game_speed" size="2" value="{$game_config['game_speed']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_fspeed']}</th>
                            <th><input name="fleet_speed" size="2" value="{$game_config['fleet_speed']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['stat_settings_desc']}</th>
                            <th>{$lang['stat_desc']}<input name="stat_settings" size="2" value="{stripslashes($game_config['stat_settings'])}" type="text">{$lang['stat_units']}</th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_pspeed']}</th>
                            <th><input name="resource_multiplier" maxlength="8" size="10" value="{$game_config['resource_multiplier']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_forum']}<br /></th>
                            <th><input name="forum_url" size="40" maxlength="254" value="{$game_config['forum_url']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_online']}<br /></th>
                            <th><input name="closed"{$closed} type="checkbox" /></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_offreaso']}<br /></th>
                            <th><textarea name="close_reason" cols="80" rows="5" size="80" >{stripslashes($game_config['close_reason'])}</textarea></th>
                        </tr>
                        <tr>
                            <td class="c" colspan="2">{$lang['messages_settings']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['bbcode_settings']}<br /></th>
                            <th><input name="bbcode_field" size="1" maxlength="254" value="{stripslashes($game_config['enable_bbcode'])}" type="text"></th>
                        </tr>
                        <tr>
                            <td class="c" colspan="2">{$lang['multi_bot_settings']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['bot_active']}</th>
                            <th><input name="bot_enable" size="1" value="{stripslashes($game_config['enable_bot'])}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['bot_name_multi']}</th>
                            <th><textarea name="name_bot" cols="1" rows="1" size="80" >{stripslashes($game_config['bot_name'])}</textarea></th>
                        </tr>
                        <tr>
                            <th>{$lang['bot_adress_multi']}</th>
                            <th><textarea name="adress_bot" cols="80" rows="1" size="80" >{stripslashes($game_config['bot_adress'])}</textarea></th>
                        </tr>
                        <tr>
                            <th>{$lang['bot_ban_duration']}</th>
                            <th><input name="duration_ban" size="20" value="{stripslashes($game_config['ban_duration'])}" type="text"></th>
                        </tr>
                        <tr>
                            <td class="c" colspan="2">{$lang['adm_opt_plan_settings']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_plan_initial']}</th>
                            <th><input name="initial_fields" maxlength="80" size="10" value="{$game_config['initial_fields']}" type="text"> cases</th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_plan_base_inc']}{$lang['Metal']}</th>
                            <th><input name="metal_basic_income" maxlength="2" size="10" value="{$game_config['metal_basic_income']}" type="text"> par heure</th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_plan_base_inc']}{$lang['Crystal']}</th>
                            <th><input name="crystal_basic_income" maxlength="2" size="10" value="{$game_config['crystal_basic_income']}" type="text"> par heure   </th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_plan_base_inc']}{$lang['Deuterium']}</th>
                            <th><input name="deuterium_basic_income" maxlength="2" size="10" value="{$game_config['deuterium_basic_income']}" type="text"> par heure   </th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_plan_base_inc']}{$lang['Energy']}</th>
                            <th><input name="energy_basic_income" maxlength="2" size="10" value="{$game_config['energy_basic_income']}" type="text"> par heure</th>
                        </tr>
                        <tr>
                            <td class="c" colspan="2">{$lang['adm_opt_control_pages']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['enable_the_anounces']}</th>
                            <th><input name="enable_announces_" size=1" value="{$game_config['enable_announces']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['enable_the_marchand']}</th>
                            <th><input name="enable_marchand_" size="1" value="{$game_config['enable_marchand']}" type="text"></th>
                        </tr>
                        <tr>
                            <th>{$lang['enable_the_notes']}</th>
                            <th><input name="enable_notes_" size="1" value="{$game_config['enable_notes']}" type="text"></th>
                        </tr>
                        <tr>
                            <td class="c" colspan="2">{$lang['adm_opt_game_oth_info']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_oth_bann']}<br /></th>
                            <th><input name="bannerframe"{$bannerframe} type="checkbox" />({$lang['adm_opt_warning1']})</th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_oth_news']}<br /></th>
                            <th><input name="newsframe"{$newsframe} type="checkbox" /></th>
                        </tr>
                        <tr>
                            <th colspan="2"><textarea name="NewsText" cols="80" rows="5" size="80" >{stripslashes($game_config['OverviewNewsText'])}</textarea></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_oth_chat']}</th>
                            <th><input name="chatframe"{$chatframe} type="checkbox" /></th>
                        </tr>
                        <tr>
                            <th colspan="2"><textarea name="ExternChat" cols="80" rows="5" size="80" >{stripslashes($game_config['OverviewExternChatCmd'])}</textarea></th>
                        </tr>
                        <tr>
                            <th>{$lang['adm_opt_game_oth_adds']}</th>
                            <th><input name="googlead"{$googlead} type="checkbox" /></th>
                        </tr>
                        <tr>
                            <th colspan="2"><textarea name="GoogleAds" cols="80" rows="5" size="80" >{stripslashes($game_config['OverviewClickBanner'])}</textarea></th>
                        </tr><tr>
                            <th>{$lang['adm_opt_game_debugmod']}</a></th>
                            <th><input name="debug"{$debug} type="checkbox" /></th>
                        </tr>
                        <tr>
                            <th>{$lang['banner']}</th>
                            <th><textarea name="banner_source_post" cols="80" rows="1" size="80" >{$game_config['banner_source_post']}</textarea></th>
                        </tr>
                        <tr>
                            <th colspan="2"><img src="{$game_config['banner_source_post']}" alt="{$game_config['banner_source_post']}" title="{$game_config['banner_source_post']}"></th>
                        </tr>
                        <tr>
                            <th colspan="3"><input value="{$lang['adm_opt_btn_save']}" type="submit"></th>
                        </tr>
                    </tbody>
                </table>
            </form>
        </center>
{/block}