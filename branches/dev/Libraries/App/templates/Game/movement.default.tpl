{block name="title" prepend}{/block}
{block name="content"}
        <script language="JavaScript" src="scripts/flotten.js"></script>
        <script language="JavaScript" src="scripts/ocnt.js"></script>
        <br>
        <center>
            <table width='519' border='0' cellpadding='0' cellspacing='1'>
                <tr height='20'>
                    <td colspan='9' class='c'>
                        <table border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td style="background-color: transparent;">
                                        {$fl_title} {$MaxFlyingFleets} {$fl_sur} {$MaxFlottes}
                                    </td>
                                    <td style="background-color: transparent;" align="right">
                                        {$ExpeditionEnCours}/{$EnvoiMaxExpedition} {$fl_expttl}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                {if $MaxFlottes == $MaxFlyingFleets}
                    <tr height="20">
                        <th colspan="9">
                            <font color="red">
                                {$lang['fl_noslotfree']}
                            </font>
                        </th>
                    </tr>
                {/if}
                <tr height='20'>
                    <th>{$fl_id}</th>
                    <th>{$fl_mission}</th>
                    <th>{$fl_count}</th>
                    <th>{$fl_from}</th>
                    <th>{$fl_start_t}</th>
                    <th>{$fl_dest}</th>
                    <th>{$fl_dest_t}</th>
                    <!--<th>{$fl_back_t}</th>-->
                    <th>{$fl_back_in}</th>
                    <th>{$fl_order}</th>
                </tr>
                {while $f = mysqli_fetch_array($fq)}
                <!--{$i++}-->
                <tr height=20>
                    <th>{$i}</th>
                    <th>
                        <a>{$missiontype[$f['fleet_mission']]}</a>
                        {if ($f['fleet_start_time'] + 1) == $f['fleet_end_time']}
                        <br><a title="{$lang['fl_back_to_ttl']}">{$lang['fl_back_to']}</a>
                        {else}
                        <br><a title="{$lang['fl_get_to_ttl']}">{$lang['fl_get_to']}</a>
                        {/if}
                    </th>
                    <th><a title="{$fleet = explode(";", $f['fleet_array'])}{$e = 0}{foreach $fleet as $a => $b}{if $b != ''}{$e++}{$a = explode(",", $b)}{$lang['tech'][$a[0]]}:{$a[1]}\n{if $e > 1}\t{/if}{/if}{/foreach}">{pretty_number($f['fleet_amount'])}</a></th>
                    <th>[{$f['fleet_start_galaxy']}:{$f['fleet_start_system']}:{$f['fleet_start_planet']}]</th>
                    <th>{gmdate("d. M Y H:i:s", $f['fleet_start_time'])}</th>
                    <th>[{$f['fleet_end_galaxy']}:{$f['fleet_end_system']}:{$f['fleet_end_planet']}]</th>
                    <th>{gmdate("d. M Y H:i:s", $f['fleet_end_time'])}</th>
                    <!--<th><font color="lime"><div id="time_0"><font>{pretty_time(floor($f['fleet_end_time'] + 1 - time()))}</font></th>-->
                    <th><font color="lime"><div id="time_0"><font>{pretty_time(floor($f['fleet_end_time'] + 1 - time()))}</font></th>
                    <th>{if $f['fleet_mess'] == 0}
                        <form action="game.php?page=Fleetback" method="post">
                            <input name="fleetid" value="{$f['fleet_id']}" type="hidden">
                            <input value="{$lang['fl_back_to_ttl']}" type="submit" name="send">
                        </form>
                            {if $f['fleet_mission'] == 1}
                            <form action="verband.php" method="post">
                                <input name="fleetid" value="{$f['fleet_id']}" type="hidden">
                                <input value="{$lang['fl_associate']}" type="submit">
                            </form>
                            {/if}
                        {else}
                            &nbsp;-&nbsp;
                        {/if}
                    </th>
                </tr>
                {/while}
            </table>
        </center>
{/block}