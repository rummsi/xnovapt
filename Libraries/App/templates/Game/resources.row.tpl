
                            <tr>
                                <th height="22">{$lang['tech'][$ProdID]} ({($ProdID > 200) ? $lang['quantity'] : $lang['level']} {$planetrow[$resource[$ProdID]]})</th>
                                <th><font color="#ffffff">{$metal_type}</font></th>
                                <th><font color="#ffffff">{$crystal_type}</font></th>
                                <th><font color="#ffffff">{$deuterium_type}</font></th>
                                <th><font color="#ffffff">{$energy_type}</font></th>
                                <th>
                                    <select name="{$name}" size="1">
                                        {for $Option = 10; $Option >= 0; $Option--}
                                        {$OptValue = $Option * 10}
                                        {if $Option == $porcent}
                                            {$OptSelected = " selected=selected"}
                                        {else}
                                            {$OptSelected = ""}
                                        {/if}
                                        <option value="{$OptValue}"{$OptSelected}>{$OptValue}%</option>
                                        {/for}
                                    </select>
                                </th>
                            </tr>





