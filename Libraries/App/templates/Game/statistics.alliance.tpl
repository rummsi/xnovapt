
                <tr>
                    <th>{$ally_rank}</th>
                    <th>{if $ranking == "0"}<font color="#87CEEB">*</font>{/if}
                        {if $ranking < "0"}<font color="red">{$ranking}</font>{/if}
                        {if $ranking > "0"}<font color="green">+{$ranking}</font>{/if}
                    </th>
                    <th><a href="game.php?page=alliance&mode=ainfo&tag={$ally_tag}" target='_ally'>{$ally_name}</a></th>
                    <th>{$ally_mes}</th>
                    <th>{$ally_members}</th>
                    <th>{$ally_points}</th>
                    <th>{$ally_members_points}</th>
                </tr>