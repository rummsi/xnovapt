{block name="title" prepend}{/block}
{block name="content"}
    <center>
        <div id="main">
            <script type="text/javascript">
                var lastType = "";
                function changeAction(type)
                {
                    if (document.formular.Uni.value === '')
                    {
                        alert('{$lang['log_univ']}');
                    } else {
                        if(type === "login" && lastType === "")
                        {
                            var url = "http://" + document.formular.Uni.value + "";
                            document.formular.action = url;
                        } else {
                            var url = "http://" + document.formular.Uni.value + "/index.php?page=register";
                            document.formular.action = url;
                            document.formular.submit();
                        }
                    }
                }
            </script>
                <div id="login">
                    <div id="login_input">
                        <form name="formular" action="" method="post" onsubmit="changeAction('login');">
                            <table width="400" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr style="vertical-align: top;">
                                        <td style="padding-right: 4px;">
                                            {$lang['User_name']}<input name="username" value="" type="text">
                                            {$lang['Password']}<input name="password" value="" type="password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right: 4px;">
                                            {$lang['Remember_me']}
                                            <input name="rememberme" type="checkbox">
                                            <script type="text/javascript">
                                                document.formular.Uni.focus();
                                            </script>
                                            <input name="submit" value="{$lang['Login']}" type="submit">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right: 4px;">
                                            <a href="index.php?page=lostpassword">{$lang['PasswordLost']}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div id="mainmenu" style="margin-top: 20px;">
                    <a href="index.php?page=register">{$lang['log_reg']}</a>
                    <a href="{$game_config['forum_url']}" target="_blank">{$lang['log_board']}</a>
                    <a href="index.php?page=contact">{$lang['log_contact']}</a>
                    <a href="index.php?page=rules" target="_blank">{$lang['log_rules']}</a>
                </div>
                <div id="rightmenu" class="rightmenu">
                    <div id="title">{$lang['log_welcome']} {$game_config['game_name']}</div>
                    <div id="content">
                        <center>
                            <div id="text1">
                                <div style="text-align: left;">
                                    <strong>{$game_config['game_name']}</strong> 
                                    {$lang['log_desc']} {$game_config['game_name']}.
                                </div>
                            </div>
                        <div id="register" class="bigbutton" onclick="document.location.href='index.php?page=register';">
                            <font color="#cc0000">
                            {$lang['log_toreg']}
                            </font></div>
                        <div id="text2">
                            <div id="text3">
                            <center>
                                <b>
                                    <font color="#00cc00">{$lang['log_online']}: </font> 
                                    <font color="#c6c7c6">{$PlayersOnline['onlinenow']}</font> - 
                                    <font color="#00cc00">{$lang['log_lastreg']}: </font> 
                                    <font color="#c6c7c6">{$LastPlayer['username']}</font> - 
                                    <font color="#00cc00">{$lang['log_numbreg']}: </font> 
                                    <font color="#c6c7c6">{$Count['players']}</font>
                                </b>
                            </center>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>
        </center>
{/block}