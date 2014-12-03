                            <tr>
                                <th width="30">16</th>
                                <th colspan=7>
                                    <a href=game.php?page=fleet1&galaxy={$galaxy}&amp;system={$system}&amp;planet=16;planettype=1&amp;target_mission=15>{$lang['gf_unknowsp']}</a>
                                </th>
                            </tr>
                            <tr>
                                <td class=c colspan=6>
                                    ( {if $planetcount == 1}{$planetcount} {$lang['gf_cntmone']}{elseif ($planetcount == 0)}{$lang['gf_cntmnone']}{else}{$planetcount} {$lang['gf_cntmsome']}{/if} )
                                </td>
                                <td class=c colspan=2>
                                    {$LegendPopup}
                                </td>
                            </tr>
                            <tr>
                                <td class=c colspan=3>
                                    <span id="missiles">{$CurrentMIP}</span> {$lang['gf_mi_title']}
                                </td>
                                <td class=c colspan=3>
                                    <span id="slots">{$maxfleet_count}</span>/{$fleetmax} {$lang['gf_fleetslt']}
                                </td>
                                <td class=c colspan=2>
                                    <span id="recyclers">{pretty_number($CurrentPlanet['recycler'])}</span> {$lang['gf_rc_title']}<br>
                                    <span id="probes">{pretty_number($CurrentPlanet['spy_sonde'])}</span> {$lang['gf_sp_title']}
                                </td>
                            </tr>
                            <tr style="display: none;" id="fleetstatusrow">
                                <th class=c colspan=8>
                                    <!--<div id="fleetstatus"></div>-->
                                    <table style="font-weight: bold" width="100%" id="fleetstatustable">
                                        <!-- will be filled with content later on while processing ajax replys -->
                                    </table>
                                </th>
                            </tr>
                            