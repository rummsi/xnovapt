{block name="title" prepend}{/block}
{block name="content"}
        <script type="text/javascript" >
            function calcul()
            {
                var Cristal = document.forms['marchand'].elements['metal'].value;
                var Deuterium = document.forms['marchand'].elements['cristal'].value;
                Cristal   = Cristal * {$mod_ma_res_a};
                Deuterium = Deuterium * {$mod_ma_res_b};
                var Metal = Cristal + Deuterium;
                document.getElementById("deut").innerHTML = Metal;
                if (isNaN(document.forms['marchand'].elements['metal'].value))
                {
                    document.getElementById("deut").innerHTML = "{$lang['mod_ma_nbre']}";
                }
                if (isNaN(document.forms['marchand'].elements['cristal'].value))
                {
                    document.getElementById("deut").innerHTML = "{$lang['mod_ma_nbre']}";
                }
            }
        </script>
        <br>
        <center>
            <form action="game.php?page=marchand" method="post">
                <input type="hidden" name="ress" value="deuterium">
                <table width="569">
                    <tr>
                        <td class="c" colspan="5"><b>{$lang['mod_ma_buton']}</b></td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>{$lang['mod_ma_cours']}</th>
                    </tr>
                    <tr>
                        <th>{$lang['Metal']}</th>
                        <th><input name="metal" type="text" value="0" onkeyup="calcul()"/></th>
                        <th>{$mod_ma_res_a}</th>
                    </tr>
                    <tr>
                        <th>{$lang['Crystal']}</th>
                        <th><input name="crystal" type="text" value="0" onkeyup="calcul()"/></th>
                        <th>{$mod_ma_res_b}</th>
                    </tr>
                    <tr>
                        <th>{$lang['Deuterium']}</th>
                        <th><span id='deut'></span></th>
                        <th>{$mod_ma_res}</th>
                    </tr>
                    <tr>
                        <th colspan="6">
                            <input type="submit" value="{$lang['mod_ma_excha']}" />
                        </th>
                    </tr>
                </table>
            </form>
        </center>
{/block}