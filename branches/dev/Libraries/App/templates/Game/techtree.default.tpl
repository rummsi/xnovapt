{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <table width="569">
                <tbody>
                {foreach $lang['tech'] as $Element => $ElementName}
                    {if (!isset($resource[$Element]))}
                        <tr>
                            <td class="c">{$ElementName}</td>
                            <td class="c">{$lang['Requirements']}</td>
                        </tr>
                    {else}
                        <tr>
                            <th class="l" width="40%">
                                <table width="100%">
                                    <tr>
                                        <td style="background-color: transparent;" align="left">
                                            <a href="game.php?page=infos&gid={$Element}">{$ElementName}</a>
                                        </td>
                                        <td style="background-color: transparent;" align="right">
                                            <a href="techdetails.php?techid={$Element}">{$lang['treeinfo']}</a>
                                        </td>
                                    </tr>
                                </table>
                            </th>
                            <th class="l" width="60%">
                                <table width="100%">
                                    <tr>
                                        <td style="background-color: transparent;" align="left">
                                            {if (isset($requirements[$Element]))}
                                                {foreach $requirements[$Element] as $ResClass => $Level}
                                                    {if (isset($user[$resource[$ResClass]]) && $user[$resource[$ResClass]] >= $Level)}
                                                        <font color="#00ff00">
                                                    {elseif (isset($planetrow[$resource[$ResClass]]) && $planetrow[$resource[$ResClass]] >= $Level)}
                                                        <font color="#00ff00">
                                                    {else}
                                                        <font color="#ff0000">
                                                    {/if}
                                                    {$lang['tech'][$ResClass]} ({$lang['level']} {$Level})
                                                    </font>
                                                    <br>
                                                {/foreach}
                                            {/if}
                                        </td>
                                    </tr>
                                </table>
                            </th>
                        </tr>
                    {/if}
                {/foreach}
            </tbody>
            </table>
        </center>
{/block}