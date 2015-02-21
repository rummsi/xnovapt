{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <form action="game.php?page=notes" method=post>
                <input type=hidden name=s value=2>
                <input type=hidden name=n value={$note['id']}>
                <table width=519>
                    <tr>
                        <td class=c colspan=2>{$lang['Editnote']}</td>
                    </tr>
                    <tr>
                        <th>{$lang['Priority']}</th>
                        <th>
                            <select name=u>
                                {$c_Options}
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['Subject']}</th>
                        <th>
                            <input type="text" name="title" size="30" maxlength="30" value="{$title}">
                        </th>
                    </tr>
                    <tr>
                        <th>{$lang['Note']} (<span id="cntChars">{strlen($note['text'])}</span> / 5000 {$lang['characters']})</th>
                        <th>
                            <textarea name="text" cols="60" rows="10" onkeyup="javascript:cntchar(5000)">{$note['text']}</textarea>
                        </th>
                    </tr>
                    <tr>
                        <td class="c">
                            <a href="game.php?page=notes">{$lang['Back']}</a>
                        </td>
                        <td class="c">
                            <input type="reset" value="{$lang['Reset']}">
                            <input type="submit" value="{$lang['Save']}">
                        </td>
                    </tr>
                </table>
            </form>
        </center>
{/block}