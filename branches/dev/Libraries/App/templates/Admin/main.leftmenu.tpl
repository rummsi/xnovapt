        <div id='leftmenu' class="style">
            <script language="JavaScript">
                function f(target_url,win_name) {
                    var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
                    new_win.focus();
                }
                parent.frames['Hauptframe'].location.replace("overview.php");
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
                                            {$servername}<br>
                                            (<a href="admin.php?page=changelog" target=_self><font color=red>{$XNovaRelease}</font></a>)
                                        </center>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif">
                                    <center>{$lang['admin']}</center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=overview" accesskey="v" target="_self">{$lang['adm_over']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=settings" accesskey="e" target="_self">{$lang['adm_conf']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=XNovaResetUnivers" accesskey="e" target="_self">{$lang['adm_reset']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif">
                                    <center>{$lang['player']}</center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=userlist" accesskey="a" target="_self">{$lang['adm_plrlst']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=multi" accesskey="a" target="_self">{$lang['adm_multi']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=paneladmina" accesskey="k" target="_self">{$lang['adm_plrsch']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=QueryExecute" accesskey="k" target="_self">{$lang['qry']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=variables" accesskey="k" target="_self">PhpInfo</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=add_money" accesskey="k" target="_self">{$lang['adm_addres']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=planetlist" accesskey="1" target="_self">{$lang['adm_actplt']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=activeplanet" accesskey="k" target="_self">{$lang['adm_actplt']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=moonlist" accesskey="k" target="_self">{$lang['adm_moonlst']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=declare_list" accesskey="k" target="_self">{$lang['multis_declared']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=add_moon" accesskey="k" target="_self">{$lang['adm_addmoon']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=ShowFlyingFleets" accesskey="k" target="_self">{$lang['adm_fleet']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=banned" accesskey="k" target="_self">{$lang['adm_ban']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=md5changepass" accesskey="k" target="_self">{$lang['change_pass']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=unbanned" accesskey="k" target="_self">{$lang['adm_unban']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2" background="{$dpath}img/bg1.gif"><center>{$lang['tool']}</center></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=chat" accesskey="p" target="_self">{$lang['adm_chat']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=statbuilder" accesskey="p">{$lang['adm_updpt']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=messagelist" accesskey="k" target="_self">{$lang['adm_msg']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="admin.php?page=md5enc" accesskey="p" target="_self">{$lang['adm_md5']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="index.php?page=ElementQueueFixer"  accesskey="p" target="_blank">{$lang['adm_build']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="index.php?page=errors" accesskey="e" target="_self" >{$lang['adm_error']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="http://wootook.org/board/" accesskey="3" target="_blank">{$lang['adm_help']}</a></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div><a href="game.php?page=overview" accesskey="i" target="_top" style="color:red">{$lang['adm_back']}</a></div></td>
                            </tr>
                        </table>
                    </div>
                </center>
            </body>
        </div>