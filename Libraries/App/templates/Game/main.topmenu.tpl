
                    <a name="anchor"></a>
                    <div id="info" class="header normal">
                        <a href="game.php?page=overview">
                            <img src="REDESIGN/images/pixel.gif" id="logoLink">
                        </a>
                        <div id="star"></div>
                        <div id="star1"></div>
                        <div id="star2"></div>
                        <div id="clearAdvice"></div>
                        <a id="changelog_link" href="game.php?page=changelog">{$XNovaRelease}</a>
                        <div id="bar">
                            <ul>
                                <li id="playerName">
                                    {$lang['adm_ch_play']}
                                    <span class="textBeefy">{$user['username']}</span>
                                </li>
                                <li>
                                    <a class="overlay" accesskey="" href="game.php?page=buddy&action=9&ajax=1" data-overlay-title="Lista de Amigos" data-overlay-class="buddies" >
                                        {$lang['lft_Buddylist']}
                                    </a>
                                </li>{if $game_config['enable_notes'] == 1}
                                <li>
                                    <a href="game.php?page=notes" class="overlay" data-overlay-title="As minhas notas" data-overlay-class="notices" data-overlay-popup-width="750" data-overlay-popup-height="480" accesskey="">
                                        {$lang['lft_Notes']}
                                    </a>
                                </li>{/if}
                                <li>
                                    <a href="game.php?page=statistics&range={$user_rank}" accesskey="">{$lang['lft_Statistics']}</a>
                                    ({$user_rank})
                                </li>
                                <li>
                                    <a class="overlay" href="game.php?page=search&ajax=1" data-overlay-title="Procurar no Universo" data-overlay-close="__default closeSearch" accesskey="">
                                        {$lang['lft_Search']}
                                    </a>
                                </li>
                                <li><a href="game.php?page=options" accesskey="">{$lang['lft_Options']}</a></li>
                                {if $game_config['enable_announces'] == 1}<li><a href="game.php?page=annonce" target="_blank">{$lang['lft_Annonces']}</a></li>{/if}
                                <li><a href="game.php?page=chat" target="_blank">{$lang['lft_Chat']}</a></li>
                                <li><a href="javascript:top.location.href='index.php?page=logout'">{$lang['lft_Logout']}</a></li>
                                <li class="OGameClock"></li>
                            </ul>
                        </div>