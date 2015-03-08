                        <form action="raketenangriff.php?c={$CurrentPlanet['id']}&action=2&galaxy={$Galaxy}&system={$System}&planet={$Planet}" method="POST">
                            <tr>
                                <table border="0">
                                    <tr>
                                        <td class="c" colspan="2">
                                            {$lang['gm_launch']} [{$galaxy}:{$system}:{$planet}]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="c">{sprintf($lang['gm_restmi'], $CurrentMIP)}
                                            <input type="text" name="SendMI" size="2" maxlength="7" />
                                        </td>
                                        <td class="c">{$lang['gm_target']}
                                            <select name="Target">
                                                <option value="all" selected>{$lang['gm_all']}</option>
                                                <option value="0">{$lang['tech'][401]}</option>
                                                <option value="1">{$lang['tech'][402]}</option>
                                                <option value="2">{$lang['tech'][403]}</option>
                                                <option value="3">{$lang['tech'][404]}</option>
                                                <option value="4">{$lang['tech'][405]}</option>
                                                <option value="5">{$lang['tech'][406]}</option>
                                                <option value="6">{$lang['tech'][407]}</option>
                                                <option value="7">{$lang['tech'][408]}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="c" colspan="2">
                                            <input type="submit" name="aktion" value="{$lang['gm_send']}">
                                        </td>
                                    </tr>
                                </table>
                            </tr>
                        </form>
