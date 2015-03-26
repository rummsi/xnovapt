{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br>
            <table width="569">
                <tr>
                    <td class="c" colspan="3">{$lang['off_points']} {$user['rpg_points']}</td>
                </tr>
                {for $Officier=601 to 615}
                    {$Result = IsOfficierAccessible($user, $Officier)}
                    {if $Result != 0}
                    <tr>
                        <th width=120><img src="images/officiers/{$Officier}.jpg" align="top" width="120" height="120" /></th>
                        <th align=center><font color="#ff8900">{$lang['off_tx_lvl']} {$user[$resource[$Officier]]}</font>{$lang['Desc'][$Officier]}</th>
                        <th align=center>
                            {if $Result == 1}
                                <a href="game.php?page=officier&mode=hire&offi={$Officier}"><font color="#00ff00">{$lang['link'][$Officier]}</font>
                            {else}
                                {$lang['Maxlvl']}
                            {/if}
                        </th>
                    </tr>
                    {/if}
                {/for}
                
                
                
            </table>
        </center>
{/block}