
                        <ul id="resources">
                            <li id="metal_box" class="metal tooltipHTML" title="">
                                <div class="resourceIcon metal"></div>
                                <span class="value">
                                    <span id="resources_metal" class="{if $planetrow["metal"] > $planetrow["metal_max"]}overmark{/if}">{pretty_number($planetrow["metal"])}</span>
                                </span>
                            </li>
                            <li id="crystal_box" class="crystal tooltipHTML" title="">
                                <div class="resourceIcon crystal"></div>
                                <span class="value">
                                    <span id="resources_crystal" class="{if $planetrow["crystal"] > $planetrow["crystal_max"]}overmark{/if}">{pretty_number($planetrow["crystal"])}</span>
                                </span>
                            </li>
                            <li id="deuterium_box" class="deuterium tooltipHTML" title="">
                                <div class="resourceIcon deuterium"></div>
                                <span class="value">
                                    <span id="resources_deuterium" class="{if $planetrow["deuterium"] > $planetrow["deuterium_max"]}overmark{/if}">{pretty_number($planetrow["deuterium"])}</span>
                                </span>
                            </li>
                            <li id="energy_box" class="energy tooltipHTML" title="">
                                <div class="resourceIcon energy"></div>
                                <span class="value">
                                    <span id="resources_energy" class="{if $planetrow["energy_max"] > $planetrow["energy_used"]}overmark{/if}">{pretty_number($planetrow["energy_used"])}</span>
                                </span>
                            </li>
                            <li id="darkmatter_box" class="darkmatter dark_highlight_tablet tooltipHTML" title="" data-tooltip-button="Purchase Dark Matter">
                                <a href="game.php?page=premium&amp;openDetail=1">
                                    <img src="images/401d1a91ff40dc7c8acfa4377d3d65.gif">
                                    <span class="value">
                                        <span class="" id="resources_darkmatter">{if $user['new_message'] > 0}
                                            <a href="game.php?page=messages">[ {$user['new_message']} ]</a>{else}[ 0 ]{/if}
                                        </span>
                                    </span>
                                </a>
                            </li>
{*
                <table class="header">
                    <tbody>
                        <tr class="header">
                            <td class="header">
                                <center>
                                    <table class="header">
                                        <tbody>
                                            <tr class="header">
                                                <td class="header">
                                                    <img src="{$dpath}planeten/small/s_{$planetrow['image']}.jpg" height="50" width="50">
                                                </td>
                                                <td  class="header" valign="middle">
                                                    <select size="1" onChange="eval('location=\''+this.options[this.selectedIndex].value+'\'');">{while $CurPlanet = mysqli_fetch_array($ThisUsersPlanets)}{if ($planetrow["destruyed"] == 0)}
                                                        <option {if $CurPlanet['id'] == $user['current_planet']}selected="selected" {/if}value="?page={$page}&cp={$CurPlanet['id']}&mode={$mode}&re=0">
                                                            {$CurPlanet['name']}&nbsp;[{$CurPlanet['galaxy']}:{$CurPlanet['system']}:{$CurPlanet['planet']}]&nbsp;&nbsp;
                                                        </option>{/if}{/while}
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </center>
                            </td>
                            <td class="header">
                                <table style="width: 508px;" class="header" id="resources" padding-right="30" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr class="header">
                                            <td class="header" align="center" width="140"><img src="{$dpath}images/metall.gif" border="0" height="22" width="42"></td>
                                            <td class="header" align="center" width="140"><img src="{$dpath}images/kristall.gif" border="0" height="22" width="42"></td>
                                            <td class="header" align="center" width="140"><img src="{$dpath}images/deuterium.gif" border="0" height="22" width="42"></td>
                                            <td class="header" align="center" width="140"><img src="{$dpath}images/energie.gif" border="0" height="22" width="42"></td>
                                            <td class="header" align="center" width="140"><img src="{$dpath}images/message.gif" border="0" height="22" width="42"></td>
                                        </tr>
                                        <tr class="header">
                                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">{$lang['Metal']}</font></b></i></td>
                                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">{$lang['Crystal']}</font></b></i></td>
                                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">{$lang['Deuterium']}</font></b></i></td>
                                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">{$lang['Energy']}</font></b></i></td>
                                            <td class="header" align="center" width="140"><i><b><font color="#ffffff">{$lang['Message']}</font></b></i></td>
                                        </tr>
                                        <tr class="header">
                                            <td class="header" align="center" width="140"><font>{if $planetrow["metal"] > $planetrow["metal_max"]}
                                                                                                    {colorRed(pretty_number($planetrow["metal"]))}
                                                                                                {else}
                                                                                                    {pretty_number($planetrow["metal"])}
                                                                                                {/if}</font></td>
                                            <td class="header" align="center" width="140"><font>{if $planetrow["crystal"] > $planetrow["crystal_max"]}
                                                                                                    {colorRed(pretty_number($planetrow["crystal"]))}
                                                                                                {else}
                                                                                                    {pretty_number($planetrow["crystal"])}
                                                                                                {/if}</font></td>
                                            <td class="header" align="center" width="140"><font>{if $planetrow["deuterium"] > $planetrow["deuterium_max"]}
                                                                                                    {colorRed(pretty_number($planetrow["deuterium"]))}
                                                                                                {else}
                                                                                                    {pretty_number($planetrow["deuterium"])}
                                                                                                {/if}</font></td>
                                            <td class="header" align="center" width="140"><font>{if $planetrow["energy_max"] > $planetrow["energy_used"]}
                                                                                                    {colorRed(pretty_number($planetrow["energy_used"]))}
                                                                                                {else}
                                                                                                    {pretty_number($planetrow["energy_used"])}
                                                                                                {/if}/{pretty_number($planetrow["energy_max"])}</font></td>
                                            <td class="header" align="center" width="140"><font>{if $user['new_message'] > 0}
                                                                                                    <a href="game.php?page=messages">[ {$user['new_message']} ]</a>
                                                                                                {else}
                                                                                                    0
                                                                                                {/if}</font></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
*}                                        
                                        
                                        
                        </ul>
                        <div id="officers" class="all">
                            
                                    <table class="header">
                                        <tbody>
                                            <tr class="header">
                                                <td class="header">
                                                    <img src="{$dpath}planeten/small/s_{$planetrow['image']}.jpg" height="50" width="50">
                                                </td>
                                                <td  class="header" valign="middle">
                                                    <select size="1" onChange="eval('location=\''+this.options[this.selectedIndex].value+'\'');">{while $CurPlanet = mysqli_fetch_array($ThisUsersPlanets)}{if ($planetrow["destruyed"] == 0)}
                                                        <option {if $CurPlanet['id'] == $user['current_planet']}selected="selected" {/if}value="?page={$page}&cp={$CurPlanet['id']}&mode={$mode}&re=0">
                                                            {$CurPlanet['name']}&nbsp;[{$CurPlanet['galaxy']}:{$CurPlanet['system']}:{$CurPlanet['planet']}]&nbsp;&nbsp;
                                                        </option>{/if}{/while}
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            
                            {*
                            <a href="http://s671-en.ogame.gameforge.com/game/index.php?page=premium&amp;openDetail=2" class="tooltipHTML  on commander js_hideTipOnMobile" title="Hire Commander|Still active for more than 72 days">
                                <img src="ficheiros/3e567d6f16d040326c7a0ea29a4f41.gif" height="30" width="30">
                            </a>
                            <a href="http://s671-en.ogame.gameforge.com/game/index.php?page=premium&amp;openDetail=3" class="tooltipHTML on  admiral js_hideTipOnMobile" title="Hire Admiral|Still active for more than 69 days">
                                <img src="ficheiros/3e567d6f16d040326c7a0ea29a4f41.gif" height="30" width="30">
                            </a>
                            <a href="http://s671-en.ogame.gameforge.com/game/index.php?page=premium&amp;openDetail=4" class="tooltipHTML on  engineer js_hideTipOnMobile" title="Hire Engineer|Still active for more than 159 days">
                                <img src="ficheiros/3e567d6f16d040326c7a0ea29a4f41.gif" height="30" width="30">
                            </a>
                            <a href="http://s671-en.ogame.gameforge.com/game/index.php?page=premium&amp;openDetail=5" class="tooltipHTML on  geologist js_hideTipOnMobile" title="Hire Geologist|Still active for more than 69 days">
                                <img src="ficheiros/3e567d6f16d040326c7a0ea29a4f41.gif" height="30" width="30">
                            </a>
                            <a href="http://s671-en.ogame.gameforge.com/game/index.php?page=premium&amp;openDetail=6" class="tooltipHTML on  technocrat js_hideTipOnMobile" title="Hire Technocrat|Still active for more than 69 days">
                                <img src="ficheiros/3e567d6f16d040326c7a0ea29a4f41.gif" height="30" width="30">
                            </a>*}
                        </div>
                        <div id="message-wrapper">
                            <!-- Neue Nachrichten-Zähler -->
                            <a class=" comm_menu messages tooltip js_hideTipOnMobile" href="game.php?page=messages" title="0 unread message(s)">
                            </a>
                            <!-- Neue Chatnachrichten-Zähler -->
                            <a class=" comm_menu chat tooltip js_hideTipOnMobile" href="game.php?page=chat" title="">
                                <span class="new_msg_count">1</span>
                            </a>
                            <div id="messages_collapsed">
                                <div id="eventboxFilled" class="eventToggle" style="display: none;">
                                    <p class="event_list">2 Missions: 
                                        <span class="undermark">2 own</span>
                                        <p class="event_list">
                                            <span class="next_event">Next: 
                                                <span class="countdown" id="tempcounter" name="countdown">9m 37s</span>
                                            </span>
                                            <span class="next_event">Type: 
                                                <span class="undermark">Transport</span>
                                            </span>
                                        </p>
                                    </p>
                                    <a style="display: none;" id="js_eventDetailsClosed" class="tooltipRight js_hideTipOnMobile" href="javascript:void(0);" title="More details"></a>
                                    <a style="display: inline;" id="js_eventDetailsOpen" class="tooltipRight open js_hideTipOnMobile" href="javascript:void(0);" title="Less detail"></a>
                                </div>
                                <div id="eventboxLoading" class="textCenter textBeefy" style="display: none;">
                                    <img src="images/3f9884806436537bdec305aa26fc60.gif" height="16" width="16">
                                    load...
                                </div>
                                <div id="eventboxBlank" class="textCenter" style="">
                                    No fleet movement
                                </div>
                            </div>
                            <div id="attack_alert" class="tooltip eventToggle noAttack" title="Attack!">
                                <a href="game.php?page=eventList"></a>
                            </div>
                            <br class="clearfloat">
                        </div><!-- #message-wrapper -->
                        <div id="helper">
                            <a class="tooltip" href="game.php?page=tutorial" title="Tutorial overview">
                            </a>
                        </div>
                        <div id="selectedPlanetName" class="textCenter">{$planetrow['name']}</div>
                    </div><!-- Info -->
                    <!-- END HEADER -->