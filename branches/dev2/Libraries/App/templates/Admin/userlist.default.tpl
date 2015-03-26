{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <h2>{$lang['adm_ul_title']}</h2>
            <table width="569" style="color:#FFFFFF">
                <tr>
                    <td class="c" colspan="10">{$lang['adm_ul_ttle2']}</td>
                </tr>
                <tr>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=id">{$lang['adm_ul_id']}</a></th>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=username">{$lang['adm_ul_name']}</a></th>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=email">{$lang['adm_ul_mail']}</a></th>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=ip_at_reg">{$lang['adm_ul_data_ip_reg']}</a></th>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=user_lastip">{$lang['adm_ul_adip']}</a></th>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=register_time">{$lang['adm_ul_regd']}</a></th>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=onlinetime">{$lang['adm_ul_lconn']}</a></th>
                    <th><a href="admin.php?page=userlist&cmd=sort&type=bana">{$lang['adm_ul_bana']}</a></th>
                    <th>{$lang['adm_ul_detai']}</th>
                    <th>{$lang['adm_ul_actio']}</th>
                </tr>
                <!--{$i = 0}-->
                {while $u = mysqli_fetch_assoc($query)}
                    {*$PrevIP = $u['user_lastip']}
                    {if $PrevIP != ""}
                        {if $PrevIP == $u['user_lastip']}
                            {$Color = "red"}
                        {else}
                            {$Color = "lime"}
                        {/if}
                    {/if*}
                <tr>
                    <th>{$u['id']}</th>
                    <th>{$u['username']}</th>
                    <th>{$u['email']}</th>
                    <th>{$u['ip_at_reg']}</th>
                    <th><font color="{$Color}">{$u['user_lastip']}</font></th>
                    <th>{gmdate("d/m/Y G:i:s", $u['register_time'])}</th>
                    <th>{gmdate("d/m/Y G:i:s", $u['onlinetime'])}</th>
                    <th>{if $u['bana'] == 1}
                        <a href="#" title="{gmdate("d/m/Y G:i:s", $u['banaday'])}">
                            {$lang['adm_ul_yes']}
                        </a>
                        {else}
                        {$lang['adm_ul_no']}
                        {/if}
                    </th>
                    <th>{*// Lien vers une page de details genre Empire*}</th>
                    <th><a href="admin.php?page=userlist&cmd=dele&user={$u['id']}"><img src="images/r1.png"></a></th>
                </tr>
                {$i++}
                {/while}
                <tr>
                    <th class="b" colspan="10">{$i}{$lang['adm_ul_playe']}</th>
                </tr>
            </table>
        </center>
{/block}