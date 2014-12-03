{block name="title" prepend}{/block}
{block name="content"}
        <script language="JavaScript" src="scripts/flotten.js"></script>
        <script language="JavaScript" src="scripts/ocnt.js"></script>
        <br>
        <center>
            <table width='519' border='0' cellpadding='0' cellspacing='1'>
                <tr height='20'>
                    <td colspan='9' class='c'>
                        <table border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td style="background-color: transparent;">
                                        {$lang['fl_title']} {$MaxFlyingFleets} {$lang['fl_sur']} {$MaxFlottes}
                                    </td>
                                    <td style="background-color: transparent;" align="right">
                                        {$ExpeditionEnCours}/{$EnvoiMaxExpedition} {$lang['fl_expttl']}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                {if $MaxFlottes == $MaxFlyingFleets}
                    <tr height="20">
                        <th colspan="9">
                            <font color="red">
                                {$lang['fl_noslotfree']}
                            </font>
                        </th>
                    </tr>
                {/if}
            </table>
        </center>
        <center>
            <form action="game.php?page=fleet2" method="post">
                <table width="519" border="0" cellpadding="0" cellspacing="1">
                    <tr height="20">
                        <td colspan="4" class="c">{$lang['fl_new_miss']}</td>
                    </tr>
                    <tr height="20">
                        <th>{$lang['fl_fleet_typ']}</th>
                        <th>{$lang['fl_fleet_disp']}</th>
                        <th>-</th>
                        <th>-</th>
                    </tr>
                    {if !$planetrow}
                        {ShowErrorPage::message($lang['fl_noplanetrow'], $lang['fl_error'])}
                    {/if}
                    {foreach $reslist['fleet'] as $n => $i}
                        {if $planetrow[$resource[$i]] > 0}
                            <tr height="20">
                                <th><a title="{$lang['fl_fleetspeed']}{$CurrentShipSpeed}">{$lang['tech'][$i]}</a></th>
                                <th>{pretty_number($planetrow[$resource[$i]])}
                                    <input type="hidden" name="maxship{$i}" value="{$planetrow[$resource[$i]]}" />
                                    <input type="hidden" name="consumption{$i}" value="{GetShipConsumption($i, $user)}" />
                                    <input type="hidden" name="speed{$i}" value="{GetFleetMaxSpeed("", $i, $user)}" />
                                    <input type="hidden" name="capacity{$i}" value="{$pricelist[$i]['capacity']}" />
                                </th>
                                {if $i == 212}
                                    <th></th><th></th>
                                {else}
                                    <th>
                                        <a href="javascript:maxShip('ship{$i}'); shortInfo();">
                                            {$lang['fl_selmax']}
                                        </a>
                                    </th>
                                    <th>
                                        <input name="ship{$i}" size="10" value="0" onfocus="javascript:if(this.value == '0') this.value='';" onblur="javascript:if(this.value == '') this.value='0';" alt="{$lang['tech'][$i]}{$planetrow[$resource[$i]]}" onChange="shortInfo()" onKeyUp="shortInfo()" />
                                    </th>
                                {/if}
                            </tr>
                        {/if}
                    {/foreach}
                    <tr height="20">
                        {if !$have_ships}
                                <th colspan="4">{$lang['fl_noships']}</th>
                            </tr>
                            <tr height="20">
                                <th colspan="4">
                                    <input type="submit" value="{$lang['fl_noships']}"/>
                                </th>
                        {else}
                                <th colspan="2">
                                    <a href="javascript:noShips();shortInfo();noResources();" >
                                        {$lang['fl_unselectall']}
                                    </a>
                                </th>
                                <th colspan="2">
                                    <a href="javascript:maxShips();shortInfo();" >
                                        {$lang['fl_selectall']}
                                    </a>
                                </th>
                            </tr>
                            {if $MaxFlottes > $MaxFlyingFleets}
                                <tr height="20">
                                    <th colspan="4">
                                        <input type="submit" value="{$lang['fl_continue']}" />
                                    </th>
                            {/if}
                        {/if}
                    </tr>
                </table>
                    {$ShipData}
                    <input type="hidden" name="galaxy" value="{$galaxy}" />
                    <input type="hidden" name="system" value="{$system}" />
                    <input type="hidden" name="planet" value="{$planet}" />
                    <input type="hidden" name="planet_type" value="{$planettype}" />
                    <input type="hidden" name="mission" value="{$target_mission}" />
                    <input type="hidden" name="maxepedition" value="{$EnvoiMaxExpedition}" />
                    <input type="hidden" name="curepedition" value="{$ExpeditionEnCours}" />
                    <input type="hidden" name="target_mission" value="{$target_mission}" />
                </form>
            </center>
{/block}