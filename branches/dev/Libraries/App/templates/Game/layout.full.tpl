{include file="main.header.tpl"}
{include file="main.menu.tpl"}
{include file="main.topnav.tpl"}
{include file="main.leftmenu.tpl"}

                    <!-- CONTENT AREA -->
                    <div id="contentWrapper" class="with_chat_bar">
                        <div id="eventboxContent"{if count($fleet_list) == 0} style="display: none;"{/if}>
                            <div id="eventListWrap">
                                <div id="eventHeader">
                                    <a class="close_details eventToggle" href="javascript:void(0);">
                                        <img src="images/3e567d6f16d040326c7a0ea29a4f41.gif" height="16" width="16">
                                    </a>
                                    <h4>{$lang['Events']}</h4>
                                </div>
                                <table id="eventContent">
                                    <tbody>
                                        {$fleet_list}
                                    </tbody>
                                </table>
                                <div id="eventFooter"></div>
                            </div>
                        </div>
                        <div id="inhalt">
{block name="content"}{/block}
                        </div>
                    </div>
                    <!-- END CONTENT AREA -->
{include file="main.rightmenu.tpl"}
{include file="main.javascript.tpl"}
{include file="main.footer.tpl"}