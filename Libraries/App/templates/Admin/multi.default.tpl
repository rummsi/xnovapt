{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br><br>
            <h2>{$lang['adm_mt_title']}</h2>
            <table width="570" style="color:#FFFFFF">
                <tr>
	<td class="c" colspan="9">{$lang['adm_mt_list']}</td>
                </tr>
                <tr>
                    <th width="20%">{$lang['adm_mt_player']}</th>
                    <th width="80%">{$lang['adm_mt_text']}</th>
                </tr>
                {$i = 0}
                {while $infos = mysql_fetch_assoc($query)}
                <tr>
                    <th>{$infos['player']}</th>
                    <th>{$infos['text']}</th>
                </tr>
                {$i++}
                {/while}
                <tr>
                    <th class="b" colspan="9">{$i} {$lang['adm_mt_multi']}</th>
                </tr>
            </table>
        </center>
{/block}