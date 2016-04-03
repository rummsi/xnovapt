{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br/><br/>
            <h2>
                <font size="+3">
                    {$lang['registry']}
                </font><br>
                {$servername}
            </h2>
            <form action="" method="post">
                <table width="438">
                <tbody>
                    <tr>
                        <td colspan="2" class="c">
                            <b>{$lang['form']}</b>
                        </td>
                    </tr>
                    <tr>
                        <th width="293">{$lang['GameName']}</th>
                        <th width="293">
                            <input name="character" size="20" maxlength="20" type="text" onKeypress="
                                if (event.keyCode===60 || event.keyCode===62) event.returnValue = false;
                                if (event.which===60 || event.which===62) return false;">
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['neededpass']}</th>
                        <th>
                            <input name="passwrd" size="20" maxlength="20" type="password" onKeypress="
                                if (event.keyCode===60 || event.keyCode===62) event.returnValue = false;
                                if (event.which===60 || event.which===62) return false;">
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['E-Mail']}</th>
                        <th>
                            <input name="email" size="20" maxlength="40" type="text" onKeypress="
                                if (event.keyCode===60 || event.keyCode===62) event.returnValue = false;
                                if (event.which===60 || event.which===62) return false;">
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['MainPlanet']}</th>
                        <th>
                            <input name="planet" size="20" maxlength="20" type="text" onKeypress="
                                if (event.keyCode===60 || event.keyCode===62) event.returnValue = false;
                                if (event.which===60 || event.which===62) return false;">
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['Sex']}</th>
                        <th>
                            <select name="sex">
                                <option value="">{$lang['Undefined']}</option>
                                <option value="M">{$lang['Male']}</option>
                                <option value="F">{$lang['Female']}</option>
                            </select>
                        </th>
                    </tr>{if $game_config['secu'] == 1}
                    <tr>
                        {$code_secu}
                        <th>{$affiche}</th>
                    </tr>{/if}
                    <tr>
                        <th>
                            <input name="rgt" type="checkbox">
                            {$lang['accept']}
                        </th>
                        <th>
                            <input name="submit" type="submit" value="{$lang['signup']}">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <a href="index.php">
                                {$lang['reg_go_back']}
                            </a>
                        </th>
                    </tr>
                </table>
            </form>
        </center>
{/block}