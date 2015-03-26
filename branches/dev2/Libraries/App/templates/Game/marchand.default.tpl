{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <form action="game.php?page=marchand" method="post">
                <input type="hidden" name="action" value="2">
                <br>
                <table width="600">
                    <tr>
                        <td class="c" colspan="10"><font color="#FFFFFF">{$lang['mod_ma_title']}</font><td>
                    </tr>
                    <tr>
                        <th colspan="10">
                            {$lang['mod_ma_typer']} 
                            <select name="choix">
                                <option value="metal">{$lang['Metal']}</option>
                                <option value="cristal">{$lang['Crystal']}</option>
                                <option value="deut">{$lang['Deuterium']}</option>
                            </select>
                            <br>
                            {$lang['mod_ma_rates']}
                            <br /><br />
                            <input type="submit" value="{$lang['mod_ma_buton']}" /></th>
                    </tr>
                </table>
            </form>
        </center>
{/block}