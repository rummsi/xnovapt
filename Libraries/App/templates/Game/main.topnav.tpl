
                        <ul id="resources">
                            <li id="metal_box" class="metal tooltipHTML" title="">
                                <div class="resourceIcon metal"></div>
                                <span class="value">
                                    <span id="resources_metal" class=""></span>
                                </span>
                            </li>
                            <li id="crystal_box" class="crystal tooltipHTML" title="">
                                <div class="resourceIcon crystal"></div>
                                <span class="value">
                                    <span id="resources_crystal" class=""></span>
                                </span>
                            </li>
                            <li id="deuterium_box" class="deuterium tooltipHTML" title="">
                                <div class="resourceIcon deuterium"></div>
                                <span class="value">
                                    <span id="resources_deuterium" class=""></span>
                                </span>
                            </li>
                            <li id="energy_box" class="energy tooltipHTML" title="">
                                <div class="resourceIcon energy"></div>
                                <span class="value">
                                    <span id="resources_energy" class=""></span>
                                </span>
                            </li>
                            <li id="darkmatter_box" class="darkmatter dark_highlight_tablet tooltipHTML" title="" data-tooltip-button="Purchase Dark Matter">
                                <a href="game.php?page=messages">
                                    <img src="images/401d1a91ff40dc7c8acfa4377d3d65.gif">
                                    <span class="value">
                                        <span class="" id="resources_darkmatter"></span>
                                    </span>
                                </a>
                            </li>
                        </ul>
{*                        <div id="officers" class="all">
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
                            </a>
                        </div>
*}                        <div id="message-wrapper">
                            <!-- Neue Nachrichten-Zähler -->
                            <a class=" comm_menu messages tooltip js_hideTipOnMobile" href="game.php?page=messages">
                                {if $user['new_message'] > 0}
                                    <span class="new_msg_count">{$user['new_message']}</span>
                                {/if}
                            </a>
                            <!-- Neue Chatnachrichten-Zähler -->
                    <!--        <a class=" comm_menu chat tooltip js_hideTipOnMobile" href="game.php?page=chat" title="">-->
                                <!-- js modification !-->
                    <!--        </a>-->
                            <div id="messages_collapsed">
                                <div id="eventboxFilled" class="eventToggle eventboxHover" style="">
                                    <p class="event_list">2 Missions: 
                                        <span class="undermark">2 own</span>
                                        <p class="event_list">
                                            <span class="next_event">Next: 
                                                <span class="countdown" id="tempcounter" name="countdown">11m 30s</span>
                                            </span>
                                            <span class="next_event">Type: 
                                                <span class="undermark">Transport</span>
                                            </span>
                                        </p>
                                    </p>
                                    <a style="display: block;" id="js_eventDetailsClosed" class="tooltipRight js_hideTipOnMobile" href="javascript:void(0);" title="More details"></a>
                                    <a style="display: none;" id="js_eventDetailsOpen" class="tooltipRight open js_hideTipOnMobile" href="javascript:void(0);" title="Less detail"></a>
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