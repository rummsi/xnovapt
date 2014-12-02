{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <h2>
                <font size="5">
                    {$lang['ResetPass']}
                    </font>
                    <br>{$servername}
            </h2>
            <form action="?page=lostpassword&action=1" method="post">
                <table width="400">
                    <tbody>
                        <tr>
                            <td colspan="2" class="c"><b>{$lang['PassForm']}</b></td>
                        </tr>
                        <tr>
                            <th colspan="2">{$lang['TextPass1']} {$servername} {$lang['TextPass2']}</th>
                        </tr>
                        <tr>
                            <th>{$lang['pseudo']}:</th>
                            <th>
                                <input name="pseudo" maxlength="30" size="20" value="" type="text">
                            </th>
                        </tr>
                        <tr>
                            <th>{$lang['email']}:</th>
                            <th>
                                <input name="email" maxlength="50" size="20" value="" type="text">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <input value="{$lang['ButtonSendPass']}" type="submit">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <a href="index.php">
                                    {$lang['go_back']}
                                </a>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </form>
        </center>
{/block}