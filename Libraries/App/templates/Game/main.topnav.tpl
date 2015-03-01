
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
                            <li id="energy_box" class="energy tooltipHTML"
                                title="">
                                <div class="resourceIcon energy"></div>
                                <span class="value">
                                    <span id="resources_energy" class=""></span>
                                </span>
                            </li>
                            <li id="darkmatter_box" class="darkmatter dark_highlight_tablet tooltipHTML"
                                title="">
                                <a href="game.php?page=officier">
                                    <img src="REDESIGN/images/401d1a91ff40dc7c8acfa4377d3d65.gif" />
                                    <span class="value">
                                        <span id="resources_darkmatter"></span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div id="message-wrapper">
                            <!-- Neue Nachrichten-Zähler -->
                            <a class=" comm_menu messages tooltip js_hideTipOnMobile" href="game.php?page=messages" title="{if $user['id'] != ''}
                                                                                                                                {if $user['new_message'] != 0}
                                                                                                                                    {if $user['new_message'] == 1}
                                                                                                                                        {$lang['Have_new_message']}
                                                                                                                                    {elseif $user['new_message'] > 1}
                                                                                                                                        {str_replace('%m', pretty_number($user['new_message']), $lang['Have_new_messages'])}
                                                                                                                                    {/if}
                                                                                                                                {/if}
                                                                                                                            {/if}">
                                {if $user['new_message'] > 0}<span class="new_msg_count">{$user['new_message']}</span>{/if}
                            </a>
                            <!-- Neue Chatnachrichten-Zähler -->
                            <a class=" comm_menu chat tooltip js_hideTipOnMobile" href="http://s671-en.ogame.gameforge.com/game/index.php?page=chat" title="0 unread message(s)">
                                <!-- js modification !-->
                            </a>
                            <div id="messages_collapsed">
                            {*    <div id="eventboxFilled" class="eventToggle" style="display: none;">
                                    <a style="display: none;" id="js_eventDetailsClosed" class="tooltipRight js_hideTipOnMobile" href="javascript:void(0);" title="More details"></a>
                                    <a style="display: inline;" id="js_eventDetailsOpen" class="tooltipRight open js_hideTipOnMobile" href="javascript:void(0);" title="Less detail"></a>
                                </div>
                                <div id="eventboxLoading" class="textCenter textBeefy" style="display: none;">
                                    <img src="REDESIGN/images/3f9884806436537bdec305aa26fc60.gif" height="16" width="16">
                                    load...
                                </div>*}
                                {if $game_config['OverviewNewsFrame'] == '1'}
                                    <div id="eventboxBlank" class="textCenter" style="">
                                        {stripslashes($game_config['OverviewNewsText'])}
                                    </div>
                                {elseif ($LvlUpMinier + $LvlUpRaid) <= 100}
                                    {if $XpMinier >= $XpMinierUp}
                                        <div id="eventboxBlank" class="textCenter" style="">
                                            <a href=game.php?page=officier>{$lang['Have_new_level_mineur']}</a>
                                        </div>
                                    {/if}
                                    {if $XPRaid >= $XpRaidUp}
                                        <div id="eventboxBlank" class="textCenter" style="">
                                            <a href=game.php?page=officier>{$lang['Have_new_level_raid']}</a>
                                        </div>
                                    {/if}
                                {/if}
                            </div>
                            <div id="attack_alert" class="tooltip eventToggle noAttack" title="Ataque!">
                                <a href="game.php?page=eventList"></a>
                            </div>
                            <br class="clearfloat" />
                        </div><!-- #message-wrapper -->
                        <div id="helper">
                            <a class="tooltip" href="game.php?page=tutorial" title="Vista geral do Tutorial">
                            </a>
                        </div>
                        <div id="selectedPlanetName" class="textCenter">{$planetrow['name']}</div>
                    </div><!-- Info -->
                    <!-- END HEADER -->
