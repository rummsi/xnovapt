{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <script src="scripts/cntchar.js" type="text/javascript"></script>
            <br />
            {if ($post)}
            {$error = 0}
            {if (!$post["subject"])}
                <br><font color=#FF0000>{$lang['mess_no_subject']}</font><br>
            {/if}
            {if (!$post["text"])}
                <br><font color=#FF0000>{$lang['mess_no_text']}</font><br>
            {/if}
            {if ($error == 0)}
                <font color=#00FF00>{$lang['mess_sended']}</font><br>
                {$post['text'] = str_replace("'", '&#39;', $post['text'])}
            {/if}
            {/if}
            <form action="game.php?page=messages&mode=write&id={$OwnerID}" method="post">
                <table width="519">
                    <tr>
                        <td class="c" colspan="2">{$lang['mess_pagetitle']}</td>
                    </tr>
                    <tr>
                        <th>{$lang['mess_recipient']}</th>
                        <th><input type="text" name="to" size="40" value="{$OwnerRecord['username']} [{$OwnerHome['galaxy']}:{$OwnerHome['system']}:{$OwnerHome['planet']}]" /></th>
                    </tr>
                    <tr>
                        <th>{$lang['mess_subject']}</th>
                        <th><input type="text" name="subject" size="40" maxlength="40" value="{(!isset($subject)) ? $lang['mess_no_subject'] : $subject}" /></th>
                    </tr>
                    <tr>
                        <th>{$lang['Message']}(<span id="cntChars">0</span> / 5000 {$lang['mess_characters']})</th>
                        <th><textarea name="text" cols="40" rows="10" size="100" onkeyup="javascript:cntchar(5000)">{$text}</textarea></th>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th colspan="2"><input type="reset" value="Effacer" /></th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <input type="submit" value="Envoyer" size="20" style="font-weight:bold" onClick="this.form.submit();this.disabled=true;this.value='Patientez...'"/>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            {$lang['bbc_emos']}
                            <br />{$lang['bbc_use']}<br />
                            <br />{$lang['bbc_def']}<br />
                            <img src="emoticones/Smile.png" alt="Sourire ;)"> = Smile<br />
                            <img src="emoticones/cool.png" alt="cool ;)"> = cool<br />
                            <img src="emoticones/grrr.png" alt="Enerv�"> = grrr<br />
                            <img src="emoticones/love.png" alt="Amour^^"> = love<br />
                            <img src="emoticones/msn.png" alt="msn"> = msn<br />
                            <img src="emoticones/Oo.png" alt="Oo"> = Oo<br />
                            <img src="emoticones/perdu.png" alt="perdu"> = perdu<br />
                            <img src="emoticones/wink.png" alt="wink"> = wink<br />
                            <img src="emoticones/wow.png" alt="wow"> = wow<hr />
                            {$lang['bbc_Texte_en_gras']} = [b]{$lang['bbc_text']}[/b]<br />
                            {$lang['mess_Texte_souligne']} = [u]{$lang['bbc_text']}[/u]<br />
                            {$lang['bbc_Texte_en_italliqiue']} = [i]{$lang['bbc_text']}[/i]<br />
                            {$lang['bbc_Une_image']} = [img]http://linkimage.com[/img]
                        </th>
                    </tr>
                </table>
            </form>
        </center>
{/block}