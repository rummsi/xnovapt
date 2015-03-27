
                <tr>
                    <th align="center">{$player_rank}</th>
                    <th align="center">
                        {if $ranking == "0"}<font color="#87CEEB">*</font>{/if}
                        {if $ranking < "0"}<font color="red">{$ranking}</font>{/if}
                        {if $ranking > "0"}<font color="green">+{$ranking}</font>{/if}
                    </th>
                    <th align="left">
                        {if $UsrRow['id'] == $user['id']}
                            <font color="lime">{$UsrRow['username']}</font>
                        {else}
                            {$UsrRow['username']}
                        {/if}
                    </th>
                    <th align="center">
                        <a href="game.php?page=messages&mode=write&id={$UsrRow['id']}">
                            <img src="skins/xnova/img/m.gif" border="0" alt="{$lang['Ecrire']}" />
                        </a>
                    </th>
                    <th align="left">
                        {if $UsrRow['ally_name'] == $user['ally_name']}
                            <font color="#33CCFF">{$UsrRow['ally_name']}</font>";
                        {else}
                            {$UsrRow['ally_name']}
                        {/if}
                    </th>
                    <th align="right">{$player_points}</th>
                </tr>