{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br>
            <table width=519>
                <tr>
                    <td class=c colspan=2>{$lang['your_alliance']}</td>
                </tr>
                {$ally_image}
                <tr>
                    <th>{$lang['Tag']}</th>
                    <th>{$ally['ally_tag']}</th>
                </tr>
                <tr>
                    <th>{$lang['Name']}</th>
                    <th>{$ally['ally_name']}</th>
                </tr>
                <tr>
                    <th>{$lang['Members']}</th>
                    <th>{$ally['ally_members']} 
                        {if $ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['memberlist'] != 0}
                            (<a href="game.php?page=alliance&mode=memberslist">
                                {$lang['Members_list']}
                            </a>)
                        {/if}
                    </th>
                </tr>
                <tr>
                    <th>{$lang['Range']}</th>
                    <th>{$range}
                        {if ($ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['administrieren'] != 0)}
                             (<a href="game.php?page=alliance&mode=admin&edit=ally">{$lang['Alliance_admin']}</a>)
                        {/if}
                    </th>
                </tr>
                {if $request_count != 0}
                    {if ($ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['bewerbungen'] != 0)}
                        <tr>
                            <th>{$lang['Requests']}</th>
                            <th>
                                <a href="game.php?page=alliance&mode=admin&edit=requests">
                                    {$request_count} {$lang['Requests']}
                                </a>
                            </th>
                        </tr>
                    {/if}
                {/if}
                {if $ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['mails'] != 0}
                    <tr>
                        <th>{$lang['Circular_message']}</th>
                        <th>
                            <a href="game.php?page=alliance&mode=circular">
                                {$lang['Send_circular_mail']}
                            </a>
                        </th>
                    </tr>
                {/if}
                <tr>
                    <th colspan=2 height=100>{nl2br($ally['ally_description'])}</th>
                </tr>
                <tr>
                    <th>{$lang['Main_Page']}</th>
                    <th>
                        <a href="{$ally['ally_web']}">
                            {$ally['ally_web']}
                        </a>
                    </th>
                </tr>
                <tr>
                    <td class=c colspan=2>{$lang['Inner_section']}</th>
                </tr>
                <tr>
                    <th colspan=2 height=100>{nl2br($ally['ally_text'])}</th>
                </tr>
            </table>
            {if $ally['ally_owner'] != $user['id']}
                {$ally_owner}
            {/if}
        </center>
{/block}