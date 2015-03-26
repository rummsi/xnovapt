{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br>
                <form action="" method="post">
                    <table width="569">
                        <tbody>
                            <tr>
                                <td class="c" colspan="5">{str_replace('%s', $planetrow['name'], $lang['Production_of_resources_in_the_planet'])}</td>
                            </tr>
                            <tr>
                                <th height="22">{$lang['Resources']}</th>
                                <th width="60">{$lang['Metal']}</th>
                                <th width="60">{$lang['Crystal']}</th>
                                <th width="60">{$lang['Deuterium']}</th>
                                <th width="60">{$lang['Energy']}</th>
                            </tr>
                            <tr>
                                <th height="22">{$lang['Basic_income']}</th>
                                <td class="k">{$game_config['metal_basic_income']     * $game_config['resource_multiplier']}</td>
                                <td class="k">{$game_config['crystal_basic_income']   * $game_config['resource_multiplier']}</td>
                                <td class="k">{$game_config['deuterium_basic_income'] * $game_config['resource_multiplier']}</td>
                                <td class="k">{$game_config['energy_basic_income']    * $game_config['resource_multiplier']}</td>
                            </tr>
                            {$resource_row}
                            <tr>
                                <th height="22">{$lang['Stores_capacity']}</th>
                                <td class="k">
                                    {if ($planetrow['metal_max'] < $planetrow['metal'])}
                                        <font color="#ff0000">
                                    {else}
                                        <font color="#00ff00">
                                    {/if}
                                    {pretty_number($planetrow['metal_max'] / 1000)} {$lang['k']}</font>
                                </td>
                                <td class="k">
                                    {if ($planetrow['crystal_max'] < $planetrow['crystal'])}
                                        <font color="#ff0000">
                                    {else}
                                        <font color="#00ff00">
                                    {/if}
                                    {pretty_number($planetrow['crystal_max'] / 1000)} {$lang['k']}</font>
                                </td>
                                <td class="k">
                                    {if ($planetrow['deuterium_max'] < $planetrow['deuterium'])}
                                        <font color="#ff0000">
                                    {else}
                                        <font color="#00ff00">
                                    {/if}
                                    {pretty_number($planetrow['deuterium_max'] / 1000)} {$lang['k']}</font>
                                </td>
                                <td class="k"><font color="#00ff00">-</font></td>
                                <td class="k"><input name="action" value="{$lang['Calcule']}" type="submit"></td>
                            </tr>
                            <tr>
                                <th height="22">Total:</th>
                                <td class="k">{$metal_total}</td>
                                <td class="k">{$crystal_total}</td>
                                <td class="k">{$deuterium_total}</td>
                                <td class="k">{$energy_total}</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <br>
                <table width="569">
                    <tbody>
                    <tr>
                        <td class="c" colspan="4">{$lang['Widespread_production']}</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th>{$lang['Daily']}</th>
                        <th>{$lang['Weekly']}</th>
                        <th>{$lang['Monthly']}</th>
                    </tr>
                    <tr>
                        <th>{$lang['Metal']}</th>
                        <th>{$daily_metal}</th>
                        <th>{$weekly_metal}</th>
                        <th>{$monthly_metal}</th>
                    </tr>
                    <tr>
                        <th>{$lang['Crystal']}</th>
                        <th>{$daily_crystal}</th>
                        <th>{$weekly_crystal}</th>
                        <th>{$monthly_crystal}</th>
                    </tr>
                    <tr>
                        <th>{$lang['Deuterium']}</th>
                        <th>{$daily_deuterium}</th>
                        <th>{$weekly_deuterium}</th>
                        <th>{$monthly_deuterium}</th>
                    </tr>
                </tbody>
            </table>
            <br>
            <table width="569">
                <tbody>
                    <tr>
                        <td class="c" colspan="3">{$lang['Storage_state']}</td>
                    </tr>
                    <tr>
                        <th>{$lang['Metal']}</th>
                        <th>{$metal_storage}</th>
                        <th width="250">
                            <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
                                <div id="AlmMBar" style="background-color: {if $metal_storage_bar > (100 * 2.5)}
                                                                               #C00000
                                                                           {elseif $metal_storage_bar > (80 * 2.5)}
                                                                               #C0C000
                                                                           {else}
                                                                               #00C000
                                                                           {/if}; width: 
                                                                               {if $metal_storage_bar > (100 * 2.5)}
                                                                                   250
                                                                               {/if}px;">
                                    &nbsp;
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['Crystal']}</th>
                        <th>{$crystal_storage}</th>
                        <th width="250">
                            <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
                                <div id="AlmCBar" style="background-color: {if $crystal_storage_bar > (100 * 2.5)}
                                                                               #C00000
                                                                           {elseif $crystal_storage_bar > (80 * 2.5)}
                                                                               #C0C000
                                                                           {else}
                                                                               #00C000
                                                                           {/if}; width: 
                                                                               {if $crystal_storage_bar > (100 * 2.5)}
                                                                                   250
                                                                               {/if}px; opacity: 0.98;">
                                    &nbsp;
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['Deuterium']}</th>
                        <th>{$deuterium_storage}</th>
                        <th width="250">
                            <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
                                <div id="AlmDBar" style="background-color: {if $deuterium_storage_bar > (100 * 2.5)}
                                                                               #C00000
                                                                           {elseif $deuterium_storage_bar > (80 * 2.5)}
                                                                               #C0C000
                                                                           {else}
                                                                               #00C000
                                                                           {/if}; width: 
                                                                               {if $deuterium_storage_bar > (100 * 2.5)}
                                                                                   250
                                                                               {/if}px;">
                                    &nbsp;
                                </div>
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
            <br>
        </center>
{/block}