
                </div><!-- box -->
            </div><!-- boxBG -->
        </div><!-- contentBoxBody -->
        <!-- Chat Bar -->
        <div id="chatBar">
            <ul class="chat_bar_list">
                <li id="chatBarPlayerList" class="chat_bar_pl_list_item">Playerlist Button
                    <div class="cb_playerlist_box" style="display:none;">
                        <div class="js_playerlist pl_container contentbox fleft">
                            <h2 class="header">
                                <span class="c-right"></span>
                                <span class="c-left"></span>
                                Player list
                            </h2>
                            <div class="content">
                                <a href="http://s671-en.ogame.gameforge.com/game/index.php?page=search" class="txt_link overlay pl_search_link">Search player</a>
                                <form id="playerlistFilters">
                                    <p class="overlay pl_filter_title">Filter by:</p>
                                    <fieldset class="pl_filter_set">
                                        <input id="filteronline" class="fleft" type="checkbox"><label for="filteronline" class="pl_filter">Online chats </label>
                                    </fieldset>
                                    <fieldset class="pl_filter_set">
                                        <input id="filterchatactive" class="fleft" type="checkbox"><label for="filterchatactive" class="pl_filter">Active chats </label>
                                    </fieldset>
                                </form>
                                <div role="tablist" class="playerlist_box js_accordion ui-accordion ui-widget ui-helper-reset">
                                    <h3 tabindex="0" aria-selected="true" aria-controls="ui-accordion-1-panel-0" id="ui-accordion-1-header-0" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-header-active ui-state-active ui-corner-top ui-accordion-icons"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s"></span>Buddies</h3>
                                    <ul aria-hidden="false" aria-expanded="true" role="tabpanel" aria-labelledby="ui-accordion-1-header-0" id="ui-accordion-1-panel-0" style="" class="playerlist ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active">
                                        <li class="playerlist_item first textCenter nothingThere">No buddies found</li>
                                    </ul>
                                </div>
                                <div role="tablist" class="playerlist_box js_accordion ui-accordion ui-widget ui-helper-reset">
                                    <h3 tabindex="0" aria-selected="true" aria-controls="ui-accordion-2-panel-0" id="ui-accordion-2-header-0" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-header-active ui-state-active ui-corner-top ui-accordion-icons"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s"></span>Alliance</h3>
                                    <ul aria-hidden="false" aria-expanded="true" role="tabpanel" aria-labelledby="ui-accordion-2-header-0" id="ui-accordion-2-panel-0" style="" class="playerlist ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active">
                                        <li class="playerlist_item first textCenter nothingThere odd">No alliances found</li>
                                    </ul>
                                </div>
                                <div role="tablist" id="plAliens" class="playerlist_box js_accordion ui-accordion ui-widget ui-helper-reset">
                                    <h3 tabindex="0" aria-selected="true" aria-controls="ui-accordion-plAliens-panel-0" id="ui-accordion-plAliens-header-0" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-header-active ui-state-active ui-corner-top ui-accordion-icons"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-s"></span>Aliens</h3>
                                    <ul aria-hidden="false" aria-expanded="true" role="tabpanel" aria-labelledby="ui-accordion-plAliens-header-0" id="ui-accordion-plAliens-panel-0" style="" class="playerlist ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active">
                                        <li class="playerlist_item first textCenter nothingThere">No alien contacts</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="c-right"></div>
                                <div class="c-left"></div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul><!-- END Chat Bar List -->
        </div>
        <!-- END Chat Bar -->
        <button class="scroll_to_top">
            <span class="arrow"></span>Back to top
        </button>
        <div id="siteFooter">
            <div class="content">
                <div class="fleft textLeft">
                    <a href="game.php?page=changelog" class="tooltip js_hideTipOnMobile" title="{$game_config['game_name']}">{$XNovaRelease}</a>
                    <a class="homeLink" href="game.php?page=multi" target="_blank">{$lang['lft_multi']}</a>
                </div>
                <div class="fright textRight">
                    <a href="index.php?page=contact" target="_blank">{$lang['lft_Contact']}</a>|
                    <a href="{$game_config['forum_url']}" target="_blank">{$lang['lft_Board']}</a>|
                    <a class="overlay" href="index.php?page=rules" data-overlay-iframe="true" data-iframe-width="450" data-overlay-title="Rules">{$lang['lft_Rules']}</a>|
                    <a href="game.php?page=banned" target="_blank">{$lang['lft_blocked']}</a>|
                    <a href="game.php?page=records" target="_blank">{$lang['lft_Records']}</a>
                </div>
            </div><!-- -->
        </div>
        <div id="decisionTB" style="display:none;">
            <div id="errorBoxDecision" class="errorBox TBfixedPosition">
                <div class="head"><h4 id="errorBoxDecisionHead">-</h4></div>
                <div class="middle">
                    <span id="errorBoxDecisionContent">-</span>
                    <div class="response">
                        <div style="float:left; width:180px;">
                            <a href="javascript:void(0);" class="yes"><span id="errorBoxDecisionYes">.</span></a>
                        </div>
                        <div style="float:left; width:180px;">
                            <a href="javascript:void(0);" class="no"><span id="errorBoxDecisionNo">.</span></a>
                        </div>
                        <br class="clearfloat">
                    </div>
                </div>
                <div class="foot"></div>
            </div> 
        </div>
        <div id="fadeBox" class="fadeBox fixedPostion" style="display:none;">
            <div>
                <span id="fadeBoxStyle" class="success"></span>
                <p id="fadeBoxContent"></p>
            </div>
        </div>
        <div id="notifyTB" style="display:none;">
            <div id="errorBoxNotify" class="errorBox TBfixedPosition">
                <div class="head"><h4 id="errorBoxNotifyHead">-</h4></div>
                <div class="middle">
                    <span id="errorBoxNotifyContent">-</span>
                    <div class="response">
                        <div>
                            <a href="javascript:void(0);" class="ok">
                                <span id="errorBoxNotifyOk">.</span>
                            </a>
                        </div>
                        <br class="clearfloat">
                    </div>
                </div>
                <div class="foot"></div>
            </div>
        </div>
        <script type="text/javascript">
            var visibleChats = [];
            var bigChatLink = "game.php?page=chat";
            var locaKeys = {
                "bold": "Bold",
                "italic": "Italic",
                "underline": "Underline",
                "stroke": "Strikethrough",
                "sub": "Subscript",
                "sup": "Superscript",
                "fontColor": "Font colour",
                "fontSize": "Font size",
                "backgroundColor": "Background colour",
                "backgroundImage": "Background image",
                "tooltip": "Tool-tip",
                "alignLeft": "Left align",
                "alignCenter": "Centre align",
                "alignRight": "Right align",
                "alignJustify": "Justify",
                "block": "Break",
                "code": "Code",
                "spoiler": "Spoiler",
                "list": "List",
                "hr": "Horizontal line",
                "picture": "Image",
                "link": "Link",
                "email": "Email",
                "player": "Player",
                "item": "Item",
                "coordinates": "Coordinates",
                "preview": "Preview",
                "textPlaceHolder": "Text...",
                "playerPlaceHolder": "Player ID or name",
                "itemPlaceHolder": "Item ID",
                "coordinatePlaceHolder": "Galaxy:system:position",
                "charsLeft": "",
                "colorPicker": {
                    "ok": "Ok",
                    "cancel": "Cancel",
                    "rgbR": "R",
                    "rgbG": "G",
                    "rgbB": "B"
                },
                "backgroundImagePicker": {
                    "ok": "Ok",
                    "repeatX": "Repeat horizontally",
                    "repeatY": "Repeat vertically"
                }
            };
        </script>    
    </body>
</html>