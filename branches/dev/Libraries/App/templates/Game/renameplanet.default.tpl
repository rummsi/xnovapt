{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <h1>{$lang['ov_rena_dele']}</h1>
            <form action="game.php?page=renameplanet&pl={$planet_id}" method="POST">
                <table width=519>
                    <tr>
                        <td class="c" colspan=3>{$lang['your_planet']}</td>
                    </tr><tr>
                        <th>{$lang['coords']}</th>
                        <th>{$lang['name']}</th>
                        <th>{$lang['functions']}</th>
                    </tr><tr>
                        <th>{$planetrow['galaxy']}:{$planetrow['system']}:{$planetrow['planet']}</th>
                        <th>{$planetrow['name']}</th>
                        <th><input type="submit" name="action" value="{$lang['colony_abandon']}" alt="{$lang['colony_abandon']}"></th>
                    </tr><tr>
                        <th>{$lang['namer']}</th>
                        <th><input type="text" name="newname" size=25 maxlength=20></th>
                        <th><input type="submit" name="action" value="{$lang['namer']}"></th>
                    </tr>
                </table>
            </form>
        </center>
{/block}