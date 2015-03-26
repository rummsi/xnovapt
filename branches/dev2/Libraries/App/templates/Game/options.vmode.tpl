{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
                <table width="519">
                    <tbody>
                        <tr>
                            <td class="c" colspan="2">{$lang['Vaccation_mode']}  {date("d.m.Y G:i:s", $user['urlaubs_until'])}</td>
                        </tr>
                        <tr>
                            <th><a title="{$vacations_tip}">{$lang['exit_vacations']}</a></th>
                            <form action="game.php?page=options&mode=exit" method="post">
                            <th>
                                <input type="checkbox" name="exit_modus"{($user['urlaubs_modus'] == 0) ? " checked='1'/" : ''}/>
                            </th>
                        </tr>
                        <tr>
                           <th colspan="2">
                               <input type="submit" value="{$lang['save_settings']}" >
                           </th>
                        </tr>
                    </tbody>
                </table>
            </form>
        </center>
{/block}