
                    <!-- LEFTMENU -->
                    <div id="links">
                        <ul id="menuTable" class="leftmenu">
                            <li>
                                <span class="menu_icon">
                                    <a href="game.php?page=eventList" class="eventToggle tooltipRight js_hideTipOnMobile" target="_self" title="Events">
                                        <div class="menuImage overview active"></div>
                                    </a>
                                </span>
                                <a class="menubutton  selected" href="game.php?page=overview" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Overview']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <a href="game.php?page=resources" class="tooltipRight js_hideTipOnMobile" target="_self" title="{$lang['lft_Resources']}">
                                        <div class="menuImage resources"></div>
                                    </a>
                                </span>
                                <a class="menubutton " href="game.php?page=buildings" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Buildings']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <div class="menuImage station"></div>
                                </span>
                                <a class="menubutton " href="game.php?page=station" accesskey="" target="_self">
                                    <span class="textlabel">Facilities</span>
                                </a>
                            </li>{if $game_config['enable_marchand'] == 1}
                            <li>{if $game_config['enable_announces'] == 1}
                                <span class="menu_icon">
                                    <a href="game.php?page=annonce" class="trader tooltipRight js_hideTipOnMobile" target="_self" title="{$lang['lft_Annonces']}">
                                        <div class="menuImage traderOverview"></div>
                                    </a>
                                </span>{/if}
                                <a class="menubutton premiumHighligt" href="game.php?page=marchand" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Marchand']}</span>
                                </a>
                            </li>{/if}
                            <li>
                                <span class="menu_icon">
                                    <a href="game.php?page=techtree" class="overlay tooltipRight js_hideTipOnMobile" target="_blank" title="{$lang['lft_Technology']}">
                                        <div class="menuImage research"></div>
                                    </a>
                                </span>
                                <a class="menubutton " href="game.php?page=research" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Research']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <div class="menuImage shipyard"></div>
                                </span>
                                <a class="menubutton " href="game.php?page=shipyard" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Shipyard']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <div class="menuImage defense"></div>
                                </span>
                                <a class="menubutton " href="game.php?page=defense" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Defense']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <a href="game.php?page=movement" class="tooltipRight js_hideTipOnMobile" target="_self" title="{$lang['lft_movement']}">
                                        <div class="menuImage fleet1 active"></div>
                                    </a>
                                </span>
                                <a class="menubutton " href="game.php?page=fleet1" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Fleet']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <div class="menuImage galaxy"></div>
                                </span>
                                <a class="menubutton " href="game.php?page=galaxy&action=0" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Galaxy']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <div class="menuImage empire"></div>
                                </span>
                                <a class="menubutton " href="game.php?page=empire" accesskey="" target="_blank">
                                    <span class="textlabel">{$lang['lft_Imperium']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <a href="game.php?page=alliance&mode=circular" class="tooltipRight js_hideTipOnMobile" target="_self" title="Circular message">
                                        <div class="menuImage alliance"></div>
                                    </a>
                                </span>
                                <a class="menubutton " href="game.php?page=alliance" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Alliance']}</span>
                                </a>
                            </li>
                            <li>
                                <span class="menu_icon">
                                    <div class="menuImage premium"></div>
                                </span>
                                <a class="menubutton premiumHighligt officers" href="game.php?page=officier" accesskey="" target="_self">
                                    <span class="textlabel">{$lang['lft_Officiers']}</span>
                                </a>
                            </li>{if $game_config['link_enable'] == 1}
                            <li>
                                <span class="menu_icon">
                                 {*   <a href="http://uni20.ogame.org/game/index.php?page=shop#page=inventory&amp;category=d8d49c315fa620d9c7f1f19963970dea59a0e3be" class="tooltipRight js_hideTipOnMobile" target="_self" title="Inventory">*}
                                        <div class="menuImage shop"></div>
                                    </a>
                                </span>
                                <a class="menubutton officierHighligt" href="{$game_config['link_url']}" accesskey="" target="_self">
                                    <span class="textlabel">{stripslashes($game_config['link_name'])}</span>
                                </a>
                            </li>{/if}
                            {if $user['authlevel'] > 0}
                            <li>
                                <span class="menu_icon">
                                    <div class="menuImage feedback"></div>
                                </span>
                                <a class="menubutton" href="admin.php?page=overview" target="_self">
                                    <span class="textlabel"><font color="lime">{$lang['user_level'][$user['authlevel']]}</font></span>
                                </a>
                            </li>{/if}
                        </ul>
                        <div class="adviceWrapper">
                            <div id="promotionCountdownBox">
                                <a class="">
                                    <span>{$lang['lft_lm_ifo_game']}</span>
                                    <span id="promotionCountdown">x {$game_config['game_speed'] / 2500}</span>
                                    <span>{$lang['lft_lm_ifo_fleet']}</span>
                                    <span id="promotionCountdown">x {$game_config['fleet_speed'] / 2500}</span>
                                    <span>{$lang['lft_lm_ifo_serv']}</span>
                                    <span id="promotionCountdown">x {$game_config['resource_multiplier']}</span>
                                    <span>{$lang['lft_lm_ifo_queue']}</span>
                                    <span id="promotionCountdown">{$lm_tx_queue}</span>
                                </a>
                            </div>
                            <div id="advice-bar">
                            </div>
                        </div>
                        <div id="toolLinksWrapper">
                            <ul id="menuTableTools" class="leftmenu"></ul>
                        </div>
                        <br class="clearfloat">
                    </div>
                    <!-- END LEFTMENU -->
