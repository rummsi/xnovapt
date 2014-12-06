{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <form action="game.php?page=multi" method="post">
                <input type="hidden" name="mode" value="addit">
                <table width="305">
                    <tbody>
                        <tr>
                            <td class="c" colspan="6">{$lang['multi_declare']}</td>
                        </tr>
                        <tr>
                            <th>{$lang['fst_player_imp']}</th>
                            <th><input name="dec1" type="text" value="" /></th>
                        </tr>
                        <tr>
                            <th>{$lang['scd_player_imp']}</td>
                            <th><input name="dec2" type="text" value="" /></th>
                        </tr>
                        <tr>
                            <th>{$lang['trd_player_imp']}</td>
                            <th><input name="dec3" type="text" value="" /></th>
                        </tr>
                        <tr>
                            <th>{$lang['multi_motive']}</td>
                            <th><input name="reason" type="text" value="0" /></th>
                        </tr>
                        <tr>
                            <th colspan="2"><input type="Submit" value="{$lang['adm_am_add']}" /></th>
                        </tr>
                    </tbody>
                </table>
            </form>
        </center>
{/block}