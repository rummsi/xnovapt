{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br/>
            {if $Queue_lenght > 0}
                {InsertBuildListScript ("buildings")}
            {/if}
            <table width=530>
            {if $Queue_lenght > 0}
                {$Queue['buildlist']}
            {/if}
                <tr>
                    <th >{$lang['bld_usedcells']}</th>
                    <th colspan="2">
                        <font color="#00FF00">{$planetrow["field_current"]}</font> / 
                        <font color="#FF0000">{$planetrow['field_max'] + ($planetrow[$resource[33]] * 5)}</font> 
                        {$lang['bld_theyare']} {($planetrow['field_max'] + ($planetrow[$resource[33]] * 5)) - $planetrow['field_current']} {$lang['bld_cellfree']}
                    </th >
                </tr>
                {foreach $lang['tech'] as $Element => $ElementName}
                    {if in_array($Element, $Allowed[$planetrow['planet_type']])}
                        {if IsTechnologieAccessible($user, $planetrow, $Element)}
                    <tr>
                        <td class="l">
                            <a href="game.php?page=infos&gid={$Element}">
                            <img border="0" src="{$dpath}gebaeude/{$Element}.gif" align="top" width="120" height="120">
                            </a>
                        </td>
                        <td class="l">
                            <a href="game.php?page=infos&gid={$Element}">{$ElementName}</a>{if $planetrow[$resource[$Element]] > 0}({$lang['level']}{$planetrow[$resource[$Element]]}){/if}<br>
                            {$lang['res']['descriptions'][$Element]}<br>
                            {GetElementPrice($user, $planetrow, $Element)}
                            {ShowBuildTime(GetBuildingTime($user, $planetrow, $Element))}
                            {GetRestPrice($user, $planetrow, $Element)}
                        </td>
                        <td class="k">
                            {if $Element == 31}
                                {if $user["b_tech_planet"] != 0 && $game_config['BuildLabWhileRun'] != 1}
                                    <font color=#FF0000>{$lang['in_working']}</font>
                                {/if}
                            {/if}
                            {if $RoomIsOk && $CanBuildElement}
                                {if $Queue['lenght'] == 0}
                                    {if $planetrow[$resource[$Element]] + 1 == 1}
                                        {if IsElementBuyable($user, $planetrow, $Element, true, false) == true}
                                            <a href="game.php?page=buildings&cmd=insert&building={$Element}">
                                                <font color=#00FF00>{$lang['BuildFirstLevel']}</font>
                                            </a>
                                        {else}
                                            <font color=#FF0000>{$lang['BuildFirstLevel']}</font>
                                        {/if}
                                    {else}
                                        {if IsElementBuyable($user, $planetrow, $Element, true, false) == true}
                                            <a href="game.php?page=buildings&cmd=insert&building={$Element}"><font color=#00FF00>{$lang['BuildNextLevel']} {$planetrow[$resource[$Element]] + 1}</font></a>
                                        {else}
                                            <font color=#FF0000>{$lang['BuildNextLevel']} {$planetrow[$resource[$Element]] + 1}</font>
                                        {/if}
                                    {/if}
                                {else}
                                    <a href="game.php?page=buildings&cmd=insert&building={$Element}"><font color=#00FF00>{$lang['InBuildQueue']}</font></a>
                                {/if}
                            {elseif $RoomIsOk && !$CanBuildElement}
                                {if $planetrow[$resource[$Element]] + 1 == 1}
                                    <font color=#FF0000>{$lang['BuildFirstLevel']}</font>
                                {else}
                                    <font color=#FF0000>{$lang['BuildNextLevel']} {$planetrow[$resource[$Element]] + 1}</font>
                                {/if}
                            {else}
                                <font color=#FF0000>{$lang['NoMoreSpace']}</font>
                            {/if}
                        </td>
                    </tr>
                    {/if}
                    {/if}
                {/foreach}
            </table>
            <br/>
        </center>
{/block}