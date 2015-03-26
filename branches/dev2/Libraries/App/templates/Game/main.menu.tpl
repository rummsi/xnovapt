
            <div id="boxBG">
                <div id="box">
                    <a name="anchor"></a>
                    <div id="info" class="header normal">
                        <a href="game.php?page=overview"><img src="images/pixel.gif" id="logoLink"></a>
                        <div id="star"></div>
                        <div id="star1"></div>
                        <div id="star2"></div>
                        <div id="clearAdvice"></div>
                        <a id="changelog_link" href="game.php?page=changelog">{$game_config['game_name']}</a>
                        <div id="bar">
                            <ul>
                                <li id="playerName">
                                    {$lang['user_level'][$user['authlevel']]}: <span class="textBeefy">{$user['username']}</span>
                                </li>
                                <li>
                                    <a class="" accesskey="" href="game.php?page=buddy">{$lang['lft_Buddylist']}</a>
                                </li>{if $game_config['link_enable'] == 1}
                                <li>
                                    <a class="" accesskey="Ignorelist" href="{$game_config['link_url']}">{stripslashes($game_config['link_name'])}</a>
                                </li>{/if}
                                <li>{if $game_config['enable_notes'] == 1}
                                    <a href="game.php?page=notes" class="overlay" data-overlay-title="My notes" data-overlay-class="notices" data-overlay-popup-width="750" data-overlay-popup-height="480" accesskey="">{$lang['lft_Notes']}</a>
                                </li>{/if}
                                <li>
                                    <a href="game.php?page=statistics&range={$user_rank}" accesskey="">{$lang['lft_Statistics']}</a>({$user_rank})</li>
                                <li>
                                    <a class="overlay" href="game.php?page=search&amp;ajax=1" data-overlay-title="Search Universe" data-overlay-close="__default closeSearch" accesskey="">{$lang['lft_Search']}</a>
                                </li>
                                <li>
                                    <a href="game.php?page=options" accesskey="">{$lang['lft_Options']}</a>
                                </li>
                                <li>
                                    <a href="{$game_config['forum_url']}" target="_blank">{$lang['lft_Board']}</a>
                                </li>
                                <li>
                                    <a href="game.php?page=chat" target="_blank">{$lang['lft_Chat']}</a>
                                </li>
                                <li>
                                    <a href="javascript:top.location.href='index.php?page=logout'">{$lang['lft_Logout']}</a>
                                </li>
                                <li class="OGameClock"></li>
                            </ul>
                        </div>