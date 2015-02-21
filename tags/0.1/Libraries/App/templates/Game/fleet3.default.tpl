{block name="title" prepend}{/block}
{block name="content"}
            <center>
                <script type="text/javascript" src="scripts/flotten.js"></script>
                <script type="text/javascript">
                    function getStorageFaktor()
                    {
                        return 1;
                    }
                </script>
                <br>
                <form action="game.php?page=fleet4" method="post">
                    <input type="hidden" name="thisresource1"  value="{$pmetal}" />
                    <input type="hidden" name="thisresource2"  value="{$pcrystal}" />
                    <input type="hidden" name="thisresource3"  value="{$pdeuterium}" />
                    <input type="hidden" name="consumption"    value="{$consumption}" />
                    <input type="hidden" name="dist"           value="{$distance}" />
                    <input type="hidden" name="speedfactor"    value="{$Pspeedfactor}" />
                    <input type="hidden" name="thisgalaxy"     value="{$Pthisgalaxy}" />
                    <input type="hidden" name="thissystem"     value="{$Pthissystem}" />
                    <input type="hidden" name="thisplanet"     value="{$Pthisplanet}" />
                    <input type="hidden" name="galaxy"         value="{$Pgalaxy}" />
                    <input type="hidden" name="system"         value="{$Psystem}" />
                    <input type="hidden" name="planet"         value="{$Pplanet}" />
                    <input type="hidden" name="thisplanettype" value="{$Pthisplanettype}" />
                    <input type="hidden" name="planettype"     value="{$Pplanettype}" />
                    <input type="hidden" name="speedallsmin"   value="{$Pspeedallsmin}" />
                    <input type="hidden" name="speed"          value="{$Pspeed}" />
                    <input type="hidden" name="speedfactor"    value="{$Pspeedfactor}" />
                    <input type="hidden" name="usedfleet"      value="{$Pusedfleet}" />
                    <input type="hidden" name="maxepedition"   value="{$Pmaxepedition}" />
                    <input type="hidden" name="curepedition"   value="{$Pcurepedition}" />
                    {foreach $fleetarray as $Ship => $Count}
                    <input type="hidden" name="ship{$Ship}"        value="{$Count}" />
                    <input type="hidden" name="capacity{$Ship}"    value="{$pricelist[$Ship]['capacity']}" />
                        <input type="hidden" name="consumption{$Ship}" value="{GetShipConsumption ( $Ship, $user )}" />
                        <input type="hidden" name="speed{$Ship}"       value="{GetFleetMaxSpeed ( "", $Ship, $user )}" />
                    {/foreach}
                    <table border="0" cellpadding="0" cellspacing="1" width="519">
                        <tbody>
                            <tr align="left" height="20">
                                <td class="c" colspan="2">
                                    {if {$Pthisplanettype} == 1}
                                        {$Pthisgalaxy}:{$Pthissystem}:{$Pthisplanet} - {$lang['fl_planet']}
                                    {elseif {$Pthisplanettype} == 3}
                                        {$Pthisgalaxy}:{$Pthissystem}:{$Pthisplanet} - {$lang['fl_moon']}
                                    {/if}
                                    <!--{$TableTitle}-->
                                </td>
                            </tr>
                            <tr align="left" valign="top">
                                <th width="50%">
                                    <table border="0" cellpadding="0" cellspacing="0" width="259">
                                        <tbody>
                                            <tr height="20">
                                                <td class="c" colspan="2">
                                                    {$lang['fl_mission']}
                                                </td>
                                            </tr>
                                            {if count($missiontype) > 0}
                                                {if $planet == 16}
                                                    <tr height="20">
                                                        <th>
                                                            <input type="radio" name="mission" value="15" checked="checked">
                                                                {$lang['type_mission'][15]}
                                                            <br/>
                                                            <br/>
                                                            <font color=\"red\">
                                                                {$lang['fl_expe_warning']}
                                                            </font>
                                                        </th>
                                                    </tr>
                                                {else}
                                                    {foreach $missiontype as $a => $b}
                                                        <tr height="20">
                                                            <th>
                                                                <input id="inpuT_{$i}" type="radio" name="mission" value="{$a}"{$mission_cheked}>
                                                                <label for="inpuT_{$i}">
                                                                    {$b}
                                                                </label>
                                                                <br>
                                                            </th>
                                                        </tr>
                                                    {/foreach}
                                                {/if}
                                            {else}
                                                <tr height="20">
                                                    <th>
                                                        <font color="red">
                                                            {$lang['fl_bad_mission']}
                                                        </font>
                                                    </th>
                                                </tr>
                                            {/if}
                                            <!--{$MissionSelector}-->
                                        </tbody>
                                    </table>
                                </th>
                                <th>
                                    <table border="0" cellpadding="0" cellspacing="0" width="259">
                                        <tbody>
                                            <tr height="20">
                                                <td colspan="3" class="c">
                                                    {$lang['fl_ressources']}
                                                </td>
                                            </tr>
                                            <tr height="20">
                                                <th>
                                                    {$lang['Metal']}
                                                </th>
                                                <th>
                                                    <a href="javascript:maxResource('1');">
                                                        {$lang['fl_selmax']}
                                                    </a>
                                                </th>
                                                <th>
                                                    <input name="resource1" alt="{$lang['Metal']} {floor($planetrow['metal'])}" size="10" onchange="calculateTransportCapacity();" type="text">
                                                </th>
                                            </tr>
                                            <tr height="20">
                                                <th>
                                                    {$lang['Crystal']}
                                                </th>
                                                <th>
                                                    <a href="javascript:maxResource('2');">
                                                        {$lang['fl_selmax']}
                                                    </a>
                                                </th>
                                                <th>
                                                    <input name="resource2" alt="{$lang['Crystal']} {$fcrystal}" size="10" onchange="calculateTransportCapacity();" type="text">
                                                </th>
                                            </tr>
                                            <tr height="20">
                                                <th>
                                                    {$lang['Deuterium']}
                                                </th>
                                                <th>
                                                    <a href="javascript:maxResource('3');">
                                                        {$lang['fl_selmax']}
                                                    </a>
                                                </th>
                                                <th>
                                                    <input name="resource3" alt="{$lang['Deuterium']} {$fdeuterium}" size="10" onchange="calculateTransportCapacity();" type="text">
                                                </th>
                                            </tr>
                                            <tr height=\"20\">
                                                <th>{$lang['fl_space_left']}</th>
                                                <th colspan="2">
                                                    <div id="remainingresources">-</div>
                                                </th>
                                            </tr>
                                            <tr height="20">
                                                <th colspan="3">
                                                    <a href="javascript:maxResources()">
                                                        {$lang['fl_allressources']}
                                                    </a>
                                                </th>
                                            </tr>
                                            <tr height="20">
                                                <th colspan="3">
                                                </th>
                                            </tr>
                                            {if ($planet == 16)}
                                                <tr height="20">
                                                    <td class="c" colspan="3">{$lang['fl_expe_staytime']}</td>
                                                </tr>
                                                <tr height="20">
                                                    <th colspan="3">
                                                        <select name="expeditiontime" >
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                        </select>
                                                        {$lang['fl_expe_hours']}
                                                    </th>
                                                </tr>
                                            {elseif (isset($missiontype[5]) != '' )}
                                                <tr height="20">
                                                    <td class="c" colspan="3">{$lang['fl_expe_staytime']}</td>
                                                </tr>
                                                <tr height="20">
                                                    <th colspan="3">
                                                        <select name=\"holdingtime\" >
                                                            <option value="0">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="4">4</option>
                                                            <option value="8">8</option>
                                                            <option value="16">16</option>
                                                            <option value="32">32</option>
                                                        </select>
                                                    </th>
                                                </tr>
                                            {/if}
                                        </tbody>
                                    </table>
                                </th>
                            </tr>
                            <tr height="20">
                                <th colspan="2">
                                    <input accesskey="z" value="{$lang['fl_continue']}" type="submit">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </center>
{/block}