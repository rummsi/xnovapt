{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <h2>{$lang['adm_ov_title']}</h2>
            <table width="600">
                <tr>
                    <td class="c" colspan="2">{$lang['adm_ov_infos']}</td>
                </tr>
                <tr>
                    <td class="b" style="color:#FFFFFF">{$lang['adm_ov_yourv']}: <strong>{$adm_ov_data_yourv}</strong></td>
                    <td class="b" style="color:#FFFFFF">{$lang['adm_ov_lastv']}: <b><a style="color:orange;" target= "_blank"href="http://wootook.org/downloads">{$lang['adm_ov_here']}</a></b></td>
                </tr>
            </table>
            <br>
            <table width="600">
                <tr>
                    <td class="c" colspan="13">{$lang['adm_ov_onlin']}</td>
                </tr>
                <tr>
                    <th><a href="?cmd=sort&type=id">{$lang['adm_ul_id']}</a></th>
                    <th><a href="?cmd=sort&type=username">{$lang['adm_ul_name']}</a></th>
                    <th><a href="?cmd=sort&type=user_lastip">{$lang['adm_ul_adip']}</a></th>
                    <th><a href="?cmd=sort&type=ally_name">{$lang['adm_ov_ally']}</a></th>
                    <th>{$lang['adm_ov_point']}</th>
                    <th><a href="?cmd=sort&type=onlinetime">{$lang['adm_ov_activ']}</a></th>
                    <th>{$lang['usr_email']}</th>
                    <th>{$lang['xp_raid']}</th>
                    <th>{$lang['xp_min']}</th>
                    <th>{$lang['lang_vacancy']}</th>
                    <th>{$lang['banned_lang']}</th>
                    <th>{$lang['usr_current_planet']}</th>
                    <th>{$lang['usr_current_page']}</th>
                </tr>
                {$Count = 0}
                {while $TheUser = mysqli_fetch_array($Last15Mins)}
                    {if $PrevIP != ""}
                        {if $PrevIP == !$TheUser['user_lastip']}
                            {$Color = "red"}
                        {else}
                            {$Color = "lime"}
                        {/if}
                    {/if}
                <tr>
                    <th>
                        <a href="game.php?page=messages&mode=write&id={$TheUser['id']}">
                            <img src="{$dpath}img/m.gif" alt="{$lang['adm_ov_altpm']}" title="{$lang['adm_ov_wrtpm']}" border="0">
                        </a>
                    </th>
                    <th>
                        <a href= # title="{$TheUser['user_agent']}">{$TheUser['username']} ({$TheUser['id']})</a></th>
                    <th>
                        <a style="color:{$Color};" href="http://network-tools.com/default.asp?prog=trace&host={$TheUser['user_lastip']}">
                            [{$TheUser['user_lastip']}]
                        </a>
                    </th>
                    <th>{$TheUser['ally_name']}</th>
                    <th>{$adm_ov_data_point}</th>
                    <th>{pretty_time(time() - $TheUser['onlinetime'])}</th>
                    <th>
                        <a href="mailto:{$TheUser['email']}">
                            {$TheUser['email']}
                        </a>
                    </th>
                    <th>{$TheUser['xpraid']}</th>
                    <th>{$TheUser['xpminier']}</th>
                    <th>{if $TheUser['urlaubs_modus'] == 1}<img src="images/true.png" >{else}<img src="images/false.png">{/if}</th>
                    <th>{if $TheUser['bana'] == 1}<img src="images/banned.png" >{else}{$lang['is_banned_lang']}{/if}</th>
                    <th>[<a href="game.php?page=galaxy&mode=0&galaxy={$TheUser['galaxy']}&system={$TheUser['system']}">{$TheUser['galaxy']}:{$TheUser['system']}:{$TheUser['planet']}</a>]</th>
                    <th>{$TheUser['current_page']}</th>
                </tr>
                {$Count++}
                {/while}
                <tr>
                    <th class="b" colspan="13">{$lang['adm_ov_count']}: {$Count}</th>
                </tr>
            </table>
        </center>
{/block}