{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <form action="game.php?page=options&mode=change" method="post">
                <table width="519">
                    <tbody>
                        {if $user['authlevel'] != LEVEL_PLAYER}
                            <tr>
                                <td class="c" colspan="2">{$lang['opt_adm_title']}</td>
                            </tr>
                            <tr>
                                <th>{$lang['opt_adm_planet_prot']}</th>
                                <th>
                                    <input name="adm_pl_prot"{($IsProtOn['id_level'] > 0) ? " checked='checked'/" : ''} type="checkbox" />
                                </th>
                            </tr>
                        {/if}
                        <tr>
                            <td class="c" colspan="2">{$lang['userdata']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['username']}</th>
                            <th><input name="db_character" size="20" value="{$user['username']}" type="text"></th>
                        </tr><tr>
                            <th>{$lang['lastpassword']}</th>
                            <th><input name="db_password" size="20" value="" type="password" autocomplete="off"></th>
                        </tr><tr>
                            <th>{$lang['newpassword']}</th>
                            <th><input name="newpass1"    size="20" maxlength="40" type="password"></th>
                        </tr><tr>
                            <th>{$lang['newpasswordagain']}</th>
                            <th><input name="newpass2"    size="20" maxlength="40" type="password"></th>
                        </tr><tr>
                            <th><a title="{$lang['emaildir_tip']}">{$lang['emaildir']}</a></th>
                            <th><input name="db_email" maxlength="100" size="20" value="{$user['email']}" type="text"></th>
                        </tr><tr>
                            <th>{$lang['permanentemaildir']}</th>
                            <th>{$user['email_2']}</th>
                        </tr><tr>
                            <th colspan="2"></th>
                        </tr><tr>
                            <td class="c" colspan="2">{$lang['general_settings']}</td>
                        </tr><tr>
                            <th>{$lang['opt_lst_ord']}</th>
                            <th>
                                <select name="settings_sort">
                                    <option value ="0"{(($user['planet_sort'] == 0) ? " selected" : "")}>{$lang['opt_lst_ord0']}</option>
                                    <option value ="1"{(($user['planet_sort'] == 1) ? " selected" : "")}>{$lang['opt_lst_ord1']}</option>
                                    <option value ="2"{(($user['planet_sort'] == 2) ? " selected" : "")}>{$lang['opt_lst_ord2']}</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>{$lang['opt_lst_cla']}</th>
                            <th>
                                <select name="settings_order">
                                    <option value ="0"{(($user['planet_sort_order'] == 0) ? " selected" : "")}>{$lang['opt_lst_cla0']}</option>
                                    <option value ="1"{(($user['planet_sort_order'] == 1) ? " selected" : "")}>{$lang['opt_lst_cla1']}</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>{$lang['skins_example']}<br> <a href="http://80.237.203.201/download/" target="_blank">{$lang['Download']}</a></th>
                            <th>
                                <input name="dpath" maxlength="80" size="40" value="{$user['dpath']}" type="text">
                                <br>
                                <select name="dpaths" size="1">
                                    <option selected="selected">  </option>
                                    <option value ="skins/xnova/">skins/xnova/</option>
                                </select>
                            </th>
                        </tr><tr>
                            <th>{$lang['opt_chk_skin']}</th>
                            <th><input name="design"{($user['design'] == 1) ? " checked='checked'" : ''} type="checkbox"></th>
                        </tr><tr>
                            <th>{$lang['avatar_example']}<br> <a href="http://www.google.com.ar/imghp" target="_blank">{$lang['Search']}</a></th>
                            <th><input name="avatar" maxlength="80" size="40" value="{$user['avatar']}" type="text"></th>
                        </tr><tr>
                            <th><a title="{$lang['untoggleip_tip']}">{$lang['untoggleip']}</a></th>
                            <th><input name="noipcheck"{($user['noipcheck'] == 1) ? " checked='checked'" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <td class="c" colspan="2">{$lang['galaxyvision_options']}</td>
                        </tr><tr>
                            <th><a title="{$lang['spy_cant_tip']}">{$lang['spy_cant']}</a></th>
                            <th><input name="spio_anz" maxlength="2" size="2" value="{$user['spio_anz']}" type="text"></th>
                        </tr><tr>
                            <th>{$lang['tooltip_time']}</th>
                            <th><input name="settings_tooltiptime" maxlength="2" size="2" value="{$user['settings_tooltiptime']}" type="text"> {$lang['seconds']}</th>
                        </tr><tr>
                            <th>{$lang['mess_ammount_max']}</th>
                            <th><input name="settings_fleetactions" maxlength="2" size="2" value="{$user['settings_fleetactions']}" type="text"></th>
                        </tr><tr>
                            <th>{$lang['show_ally_logo']}</th>
                            <th><input name="settings_allylogo"{($user['settings_allylogo'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <th>{$lang['shortcut']}</th>
                            <th>{$lang['show']}</th>
                        </tr><tr>
                            <th><img src="{$dpath}img/e.gif" alt="">   {$lang['spy']}</th>
                            <th><input name="settings_esp"{($user['settings_esp'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <th><img src="{$dpath}img/m.gif" alt="">   {$lang['write_a_messege']}</th>
                            <th><input name="settings_wri"{($user['settings_wri'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <th><img src="{$dpath}img/b.gif" alt="">   {$lang['add_to_buddylist']}</th>
                            <th><input name="settings_bud"{($user['settings_bud'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <th><img src="{$dpath}img/r.gif" alt="">   {$lang['attack_with_missile']}</th>
                            <th><input name="settings_mis"{($user['settings_mis'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <th><img src="{$dpath}img/s.gif" alt="">   {$lang['show_report']}</th>
                            <th><input name="settings_rep"{($user['settings_rep'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <td class="c" colspan="2">{$lang['delete_vacations']}</td>
                        </tr><tr>
                            <th><a title="{$lang['vacations_tip']}">{$lang['mode_vacations']}</a></th>
                            <th><input name="urlaubs_modus"{($user['urlaubs_modus'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <th><a title="{$lang['deleteaccount_tip']}">{$lang['deleteaccount']}</a></th>
                            <th><input name="db_deaktjava"{($user['db_deaktjava'] == 1) ? " checked='checked'/" : ''} type="checkbox" /></th>
                        </tr><tr>
                            <th colspan="2"><input value="{$lang['save_settings']}" type="submit"></th>
                        </tr>
                    </tbody>
                </table>
            </form>
        </center>
{/block}