        <div id='leftmenu' class="style">
            <script language="JavaScript">
                function f(target_url,win_name)
                {
                    var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
                    new_win.focus();
                }
            </script>
            <body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
                <center>
                    <div id='menu'>
                        <br>
                        <table width="130" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="2" style="border-top: 1px #545454 solid">
                                    <div>
                                        <center>
                                            {$game_config['game_name']}<br>
                                            (<a href="game.php?page=changelog" target=_self><font color=red>{$XNovaRelease}</font></a>)
                                        </center>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif">
                                    <center>{$lang['lft_devlp']}</center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=overview" accesskey="g" target="_self">{$lang['lft_Overview']}</a></div></td>
                            </tr>
                            <tr>
                                <td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=buildings" accesskey="b" target="_self">{$lang['lft_Buildings']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=research" accesskey="r" target="_self">{$lang['lft_Research']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=shipyard" accesskey="f" target="_self">{$lang['lft_Shipyard']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=defense" accesskey="d" target="_self">{$lang['lft_Defense']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=officier" accesskey="o" target="_self">{$lang['lft_Officiers']}</a></div></td>
                            </tr>
                            {if $game_config['enable_marchand'] == 1}
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=marchand" target="_self">{$lang['lft_Marchand']}</a></div></td>
                            </tr>
                            {/if}
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif"><center>{$lang['lft_navig']}</center></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=alliance" accesskey="a" target="_self">{$lang['lft_Alliance']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=fleet1" accesskey="t" target="_self">{$lang['lft_Fleet']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=movement" accesskey="t" target="_self">{$lang['lft_movement']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=messages" accesskey="c" target="_self">{$lang['lft_Messages']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif"><center>{$lang['lft_observ']}</center></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=galaxy&action=0" accesskey="s" target="_self">{$lang['lft_Galaxy']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=empire" accesskey="i" target="_blank">{$lang['lft_Imperium']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=resources" accesskey="r" target="_self">{$lang['lft_Resources']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=techtree" accesskey="g" target="_self">{$lang['lft_Technology']}</a></div></td>
                            </tr>
                            <tr>
                                <td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=records" accesskey="3" target="_self">{$lang['lft_Records']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=statistics&range={$user_rank}" accesskey="k" target="_self">{$lang['lft_Statistics']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=search" accesskey="b" target="_self">{$lang['lft_Search']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=banned" accesskey="3" target="_self">{$lang['lft_blocked']}</a></div></td>
                            </tr>
                            {if $game_config['enable_announces'] == 1}
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=annonce" target="_self">{$lang['lft_Annonces']}</a></div></td>
                            </tr>
                            {/if}
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif"><center>{$lang['lft_commun']}</center></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="#" onClick="f('game.php?page=buddy', '');" accesskey="c">{$lang['lft_Buddylist']}</a></div></td>
                            </tr>
                            {if $game_config['enable_notes'] == 1}
                            <tr>
                                <td colspan="2"><div><a href="#" onClick="f('game.php?page=notes', 'Report');" accesskey="n">{$lang['lft_Notes']}</a></div></td>
                            </tr>
                            {/if}
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=chat" accesskey="a" target="_self">{$lang['lft_Chat']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="{$game_config['forum_url']}" accesskey="1" target="_self">{$lang['lft_Board']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=multi" accesskey="1" target="_self">{$lang['lft_multi']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="index.php?page=rules"  accesskey="c" target="_blank">{$lang['lft_Rules']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="index.php?page=contact" accesskey="3" target="_self" >{$lang['lft_Contact']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=options" accesskey="o" target="_self">{$lang['lft_Options']}</a></div></td>
                            </tr>
                            {if $user['authlevel'] > 0}
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=overview"><font color="lime">{$lang['user_level'][$user['authlevel']]}</font></a></div></td>
                            </tr>
                            {/if}
                            {if $game_config['link_enable'] == 1}
                            <tr>
                                <td colspan="2"><div><a href="{$game_config['link_url']}" target="_self">{stripslashes($game_config['link_name'])}</a></div></td>
                            </tr>
                            {/if}
                            <tr>
                                <td colspan="2"><div><a href="javascript:top.location.href='index.php?page=logout'" accesskey="s" style="color:red">{$lang['lft_Logout']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif"><center>{$lang['lft_infog']}</center></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 3px">{$lang['lft_lm_ifo_game']}</td>
                                <td align="right" style="padding-right: 3px">x {$game_config['game_speed'] / 2500}</td>
                            </tr>
                            <tr>
                              <td style="padding-left: 3px">{$lang['lft_lm_ifo_fleet']}</td>
                              <td align="right" style="padding-right: 3px">x {$game_config['fleet_speed'] / 2500}</td>
                            </tr>
                            <tr>
                              <td style="padding-left: 3px">{$lang['lft_lm_ifo_serv']}</td>
                              <td align="right" style="padding-right: 3px">x {$game_config['resource_multiplier']}</td>
                            </tr>
                            <tr>
                              <td style="padding-left: 3px">{$lang['lft_lm_ifo_queue']}</td>
                              <td align="right" style="padding-right: 3px">{$lm_tx_queue}</td>
                            </tr>
                        </table>
                    </div>
                </center>
            </body>
        </div>