{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <h2>{$lang['adm_rz_ttle']}</h2>
            <form action="XNovaResetUnivers.php" method="post">
                <input type="hidden" name="mode" value="reset">
                <table width="500">
                    <tbody>
                        <tr>
                            <td class="c" colspan="6">{$lang['adm_rz_conf']}</td>
                        </tr>
                        <tr>
                            <th colspan="2">{$lang['adm_rz_text']}</th>
                        </tr>
                        <tr>
                            <th colspan="2"><input type="Submit" value="{$lang['adm_rz_doit']}" /></th>
                        </tr>
                    </tbody>
                </table>
            </form>
        </center>
{/block}