{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br>
            <form action="game.php?page=search" method="post">
                <table width="519">
                    <tr>
                        <td class="c">{$lang['Search_in_all_game']}</td>
                    </tr>
                    <tr>
                        <th>
                            <select name="type">
                                <option value="playername"{$type_playername}>{$lang['Player_name']}</option>
                                <option value="planetname"{$type_planetname}>{$lang['Planet_name']}</option>
                                <option value="allytag"{$type_allytag}>{$lang['Alliance_tag']}</option>
                                <option value="allyname"{$type_allyname}>{$lang['Alliance_name']}</option>
                            </select>
                            &nbsp;&nbsp;
                            <input type="text" name="searchtext" value="{$searchtext}"/>
                            &nbsp;&nbsp;
                            <input type="submit" value="{$lang['Search']}" />
                        </th>
                    </tr>
               </table>
            </form>
            {$search_results}
        </center>
{/block}