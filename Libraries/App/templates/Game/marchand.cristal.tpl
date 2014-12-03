{block name="title" prepend}{/block}
{block name="content"}
        <script type="text/javascript" >
            function calcul()
            {
                var Cristal = document.forms['marchand'].elements['metal'].value;
                var Deuterium = document.forms['marchand'].elements['deut'].value;
                Metal = Metal * {$mod_ma_res_a};
                Deuterium = Deuterium * {$mod_ma_res_b};
                var Cristal = Metal + Deuterium;
                document.getElementById("cristal").innerHTML = Metal;
                if (isNaN(document.forms['marchand'].elements['metal'].value))
                {
                    document.getElementById("cristal").innerHTML = "{$lang['mod_ma_nbre']}";
                }
                if (isNaN(document.forms['marchand'].elements['deut'].value))
                {
                    document.getElementById("cristal").innerHTML = "{$lang['mod_ma_nbre']}";
                }
            }
        </script>
        <br>
        <center>
            <form action="game.php?page=marchand" method="post">
                <input type="hidden" name="ress" value="cristal">
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
                        <th><span id='cristal'></span></th>
                        <th>{$mod_ma_res}</th>
                    </tr>
                    <tr>
                        <th>{$lang['Deuterium']}</th>
                        <th><input name="deut" type="text" value="0" onkeyup="calcul()"/></th>
                        <th>{$mod_ma_res_b}</th>
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