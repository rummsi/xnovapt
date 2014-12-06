{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <table width="600">
                <tr>
                    <td class="c" colspan="12">
                        <font color="#FFFFFF">{$lang['annonce_title']}</font>
                    </td>
                </tr>
                <tr>
                    <th colspan="5">{$lang['annonce_seller_info']}</th>
                    <th colspan="3">{$lang['annonce_sell_res']}</th>
                    <th colspan="3">Ressources souhait&eacute;es</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <th>MP</th>
                    <th>Vendeur</th>
                    <th>Data</th>
                    <th>Galaxie</th>
                    <th>Syst&egrave;me</th>
                    <th>M&eacute;tal</th>
                    <th>Cristal</th>
                    <th>Deuterium</th>
                    <th>M&eacute;tal</th>
                    <th>Cristal</th>
                    <th>Deuterium</th>
                    <th>Delet</th>
                </tr>
                {while ($b = mysql_fetch_array($annonce))}
                <tr><tr>
                    <th>
                        <a href=game.php?page=messages&mode=write&id={$b['user_id']}>
                            <img src="{$dpath}img/m.gif" alt="{$lang['gl_sendmess']}" title="{$lang['gl_sendmess']}" border=0>
                        </a>
                    </th>
                    <th>{$b["user"]}</th>
                    <th>{date('d M Y H:i:s', $b['date'])}</th>
                    <th>{$b["galaxie"]}</th>
                    <th>{$b["systeme"]}</th>
                    <th>{$b["metala"]}</th>
                    <th>{$b["cristala"]}</th>
                    <th>{$b["deuta"]}</th>
                    <th>{$b["metals"]}</th>
                    <th>{$b["cristals"]}</th>
                    <th>{$b["deuts"]}</th>
                    <th>
                    {if $user['id'] == $b['user_id']}
                        <a href="game.php?page=annonce&action=6&add={$b['id']}"><img src="images/r1.png"></a>
                    {/if}
                    </th>
                </tr>
                {/while}
                <tr>
                    <th colspan="12" align="center">
                        <a href="game.php?page=annonce&action=2">Ajouter une Annonce</a>
                    </th>
                </tr>
            </table>
        </center>
{/block}