
                    <!-- RIGHTMENU -->
                    <div id="rechts">
                        <div id="cutty">
                            <div id="myPlanets">
                                <div id="countColonies">
                                    <p class="textCenter">
                                        <span>6/6</span> Planets
                                    </p>    
                                </div>
                                <div id="planetList">
                                    {while $UserPlanet = mysqli_fetch_array($planets_query)}
                                    {if $UserPlanet['id']}
                                    {if $UserPlanet['planet_type'] != 3}
                                    <div class="smallplanet" id="planet-{$UserPlanet['id']}">
                                        <a href="?page={$smarty.get.page}&cp={$UserPlanet['id']}&re=0" title="<b>{$UserPlanet['name']} [{$UserPlanet['galaxy']}:{$UserPlanet['system']}:{$UserPlanet['planet']}]</B><BR>{pretty_number($UserPlanet['diameter'])}km ({$UserPlanet['field_current']}/{CalculateMaxPlanetFields($UserPlanet)})<BR>{$UserPlanet['temp_min']}{$lang['ov_temp_unit']} {$lang['ov_temp_to']} {$UserPlanet['temp_max']}{$lang['ov_temp_unit']}" class="planetlink {if $UserPlanet['id'] == $user['current_planet']}active {/if}tooltipRight js_hideTipOnMobile">
                                            <img class="planetPic js_replace2x" src="{$dpath}planeten/small/s_{$UserPlanet['image']}.jpg" height="30" width="30">
                                            <span class="planet-name  ">{$UserPlanet['name']}</span>
                                            <span class="planet-koords  ">[{$UserPlanet['galaxy']}:{$UserPlanet['system']}:{$UserPlanet['planet']}]</span>
                                        </a>
                                        <a class="constructionIcon tooltip js_hideTipOnMobile" href="game.php?page=overview&amp;cp=33621079" title="Lunar Base">
                                            <span class="icon12px icon_wrench"></span>
                                        </a>
                                    {else}
                                        <a class="moonlink {if $UserPlanet['id'] == $user['current_planet']}active {/if}tooltipLeft js_hideTipOnMobile" title="<B>{$UserPlanet['name']} [{$UserPlanet['galaxy']}:{$UserPlanet['system']}:{$UserPlanet['planet']}]</B><BR>{pretty_number($UserPlanet['diameter'])}km ({$UserPlanet['field_current']}/{CalculateMaxPlanetFields($UserPlanet)})" href="?page=overview&cp={$UserPlanet['id']}&re=0">
                                            <img src="{$dpath}planeten/small/s_{$UserPlanet['image']}.jpg" alt="" class="icon-moon" height="16" width="16">
                                        </a>
                                        <a class="constructionIcon moon tooltip js_hideTipOnMobile" href="game.php?page=overview&amp;cp=33621079" title="Lunar Base">
                                            <span class="icon12px icon_wrench"></span>
                                        </a>
                                    </div>
                                    {/if}
                                    {/if}
                                    {/while}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END RIGHTMENU -->