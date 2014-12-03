{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <table width=519>
                <tr>
                    <td class=c colspan=11>
                        {$Configure_laws}
                    </td>
                </tr>
                {if count($ally_ranks) == 0 || $ally_ranks == ''}
                    <th>{$There_is_not_range}</th>
                {else}
                    <br>
                    <form action="game.php?page=alliance&mode=admin&edit=rights" method=POST>
                        <tr>
                            <th></th>
                            <th>{$Range_name}</th>
                            <th><img src=images/r1.png></th>
                            <th><img src=images/r2.png></th>
                            <th><img src=images/r3.png></th>
                            <th><img src=images/r4.png></th>
                            <th><img src=images/r5.png></th>
                            <th><img src=images/r6.png></th>
                            <th><img src=images/r7.png></th>
                            <th><img src=images/r8.png></th>
                            <th><img src=images/r9.png></th>
                        </tr>
                        {foreach $ally_ranks as $a => $b}
                            {if ($ally['ally_owner'] == $user['id'])}
                                <tr>
                                    <th>
                                        <a href="game.php?page=alliance&mode=admin&edit=rights&d={$a}">
                                            <img src="{$dpath}pic/abort.gif" alt="{$Delete_range}" border=0>
                                        </a>
                                    </th>
                                    <th>&nbsp;{$b['name']}&nbsp;</th>
                                    <input type="hidden" name="id[]" value="{$a}">
                                    <th>
                                        <input type="checkbox" name="u{$a}r0" id="{$b['delete']}" {if $b['delete'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r1" id="{$b['kick']}" {if $b['kick'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r2" id="{$b['bewerbungen']}" {if $b['bewerbungen'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r3" id="{$b['memberlist']}" {if $b['memberlist'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r4" id="{$b['bewerbungenbearbeiten']}" {if $b['bewerbungenbearbeiten'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r5" id="{$b['administrieren']}" {if $b['administrieren'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r6" id="{$b['onlinestatus']}" {if $b['onlinestatus'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r7" id="{$b['mails']}" {if $b['mails'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r8" id="{$b['rechtehand']}" {if $b['rechtehand'] == "1"}checked="checked"{/if}>
                                    </th>
                                </tr>
                            {else}
                                <tr>
                                    <th>
                                        <a href="game.php?page=alliance&mode=admin&edit=rights&d={$a}">
                                            <img src="{$dpath}pic/abort.gif" alt="{$Delete_range}" border=0>
                                        </a>
                                    </th>
                                    <th>&nbsp;{$b['name']}&nbsp;</th>
                                    <input type="hidden" name="id[]" value="{$a}">
                                    <th>
                                        <b>-</b>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r1" id="{$b['kick']}" {if $b['kick'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r2" id="{$b['bewerbungen']}" {if $b['bewerbungen'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r3" id="{$b['memberlist']}" {if $b['memberlist'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r4" id="{$b['bewerbungenbearbeiten']}" {if $b['bewerbungenbearbeiten'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r5" id="{$b['administrieren']}" {if $b['administrieren'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r6" id="{$b['onlinestatus']}" {if $b['onlinestatus'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r7" id="{$b['mails']}" {if $b['mails'] == "1"}checked="checked"{/if}>
                                    </th>
                                    <th>
                                        <input type="checkbox" name="u{$a}r8" id="{$b['rechtehand']}" {if $b['rechtehand'] == "1"}checked="checked"{/if}>
                                    </th>
                                </tr>
                            {/if}
                        {/foreach}
                        <tr>
                            <th colspan=11>
                                <input type=submit value="{$Save}">
                            </th>
                        </tr>
                    </form>
                {/if}
            </table>
            <br>
            <form action="game.php?page=alliance&mode=admin&edit=rights&add=name" method=POST>
                <table width=519>
                    <tr>
                        <td class=c colspan=2>{$Range_make}</td>
                    </tr>
                    <tr>
                        <th>{$Range_name}</th>
                        <th>
                            <input type=text name="newrangname" size=20 maxlength=30>
                        </th>
                    </tr>
                    <tr>
                        <th colspan=2><input type=submit value="{$Make}"></th>
                    </tr>
                </table>
            </form>
            <form action="game.php?page=alliance&mode=admin&edit=rights" method=POST>
                <table width=519>
                    <tr>
                        <td class=c colspan=2>{$Law_leyends}</td>
                    </tr>
                    <tr>
                        <th><img src=images/r1.png></th>
                        <th>{$Alliance_dissolve}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r2.png></th>
                        <th>{$Expel_users}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r3.png></th>
                        <th>{$See_the_requests}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r4.png></th>
                        <th>{$See_the_list_members}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r5.png></th>
                        <th>{$Check_the_requests}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r6.png></th>
                        <th>{$Alliance_admin}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r7.png></th>
                        <th>{$See_the_online_list_member}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r8.png></th><th>{$Make_a_circular_message}</th>
                    </tr>
                    <tr>
                        <th><img src=images/r9.png></th><th>{$Left_hand_text}</th>
                    </tr>
                    <tr>
                        <td class="c" colspan="2">
                            <a href="game.php?page=alliance&mode=admin&edit=ally">
                                {$Return_to_overview}
                            </a>
                        </td>
                    </tr>
                </form>
            </table>
        </center>
{/block}