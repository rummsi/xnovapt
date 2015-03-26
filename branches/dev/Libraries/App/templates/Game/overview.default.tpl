{block name="title" prepend}{/block}
{block name="content"}
                            <div id="planet" style="background-image:url({$dpath}planeten/redesign/{$planetrow['image']}.jpg);">
                                <div id="detailWrapper">
                                    <div id="header_text">
                                        <h2>
                                            <a href="javascript:void(0);" class="openPlanetRenameGiveupBox">
                                                <p class="planetNameOverview">{$title} -</p>
                                                <span id="planetNameHeader">{$planetrow['name']}</span>
                                                <img class="hinted tooltip" title="{$lang['Planet_menu']}" src="images/1f57d944fff38ee51d49c027f574ef.gif" height="16" width="16">
                                            </a>
                                        </h2>
                                    </div>
                                    <div id="detail" class="detail_screen">
                                        <div id="techDetailLoading"></div>
                                    </div>
                                    <div id="planetdata">
                                        <div class="overlay"></div>
                                        <div id="planetDetails">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td class="desc">
                                                            <span id="diameterField"></span>
                                                        </td>
                                                        <td class="data">
                                                            <span id="diameterContentField"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="desc">
                                                            <span id="temperatureField"></span>
                                                        </td>
                                                        <td class="data">
                                                            <span id="temperatureContentField"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="desc">
                                                            <span id="positionField"></span>
                                                        </td>
                                                        <td class="data">
                                                            <span id="positionContentField"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="desc">
                                                            <span id="scoreField"></span></td>
                                                        <td class="data">
                                                            <span id="scoreContentField"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="desc">
                                                            <span id="honorField"></span></td>
                                                        <td class="data ">
                                                            <span id="honorContentField"></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="planetOptions">
                                            <div class="planetMoveStart fleft" style="display: inline;">
                                                <a class="tooltipLeft dark_highlight_tablet fleft" style="display: inline-block" href="http://s671-en.ogame.gameforge.com/game/index.php?page=galaxy" title="The relocation allows you to move your planets to a different position in another preferred system far away. &lt;br /&gt;&lt;br /&gt;
                                                   The actual relocation takes place 24 hours after activation. During this time you can use your planets as per normal. A countdown shows you the time remaining before the relocation.&lt;br /&gt;&lt;br /&gt;
                                                   Once the countdown finishes and the planet is to be moved, none of your fleets that are stationed here will be able to be active. Nothing will be able to be built or researched either. Should a construction contract or a fleet still be active once the countdown finishes, the relocation will be cancelled.&lt;br /&gt;&lt;br /&gt;
                                                   If the move is successful, 240.000 Dark Matter will be deducted from your account. The moon, buildings and all stored resources will move with planet/moon immediately. Your fleets will fly automatically to new coordinates on speed of slowest ship. The jump gate of a relocated moon will be deactivated for 24 hours." data-tooltip-button="To galaxy">
                                                    <span class="planetMoveIcons planetMoveDefault icon"></span>
                                                    <span class="planetMoveOverviewMoveLink">Relocate</span>
                                                </a>
                                            </div>
                                            <a class="dark_highlight_tablet float_right openPlanetRenameGiveupBox" href="javascript:void(0);">
                                                <span class="planetMoveOverviewGivUpLink">give up/rename</span>
                                                <span class="planetMoveIcons settings planetMoveGiveUp icon"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="buffBar" class="sliderWrapper">
                                    <div data-uuid="" data-id="" class="add_item">
                                        <a class="activate_item border3px" href="javascript:void(0);" ref="1"></a>
                                    </div>
                                    <div style="width: 532px; height: 36px;" class="anythingSlider anythingSlider-default activeSlider">
                                        <div class="anythingWindow">
                                            <ul style="width: 532px; left: 0px;" class="active_items anythingBase horizontal">
                                                <li style="width: 532px; height: 36px;" class="panel activePage">
                                                </li>
                                            </ul>
                                        </div>
                                        <span style="display: none;" class="arrow back disabled">
                                            <a href="#"><span>«</span></a>
                                        </span>
                                        <span style="display: none;" class="arrow forward disabled">
                                            <a href="#"><span>»</span></a>
                                        </span>
                                    </div>
                                </div>
                                <div id="moon">            
                                    <a href="http://s671-en.ogame.gameforge.com/game/index.php?page=overview&amp;cp=33621079" class="tooltipBottom js_hideTipOnMobile" title="Switch to Moon  Moon">
                                        <img alt="Moon" src="images/b6fbbe98ca42ef920c23590da28a5f.gif">
                                    </a>
                                </div>
                            </div>
                            <div class="c-left"></div>
                            <div class="c-right"></div>
                            <div id="overviewBottom">
                                <div class="content-box-s">
                                    <div class="header">
                                        <h3>{$lang['Buildings']}</h3>
                                    </div>
                                    <div class="content">
                                        <table class="construction active" cellpadding="0" cellspacing="0">
                                        {if $planetrow['b_building'] != 0}
                                        {*UpdatePlanetBatimentQueueList($planetrow, $user)*}
                                        {if $planetrow['b_building'] != 0}
                                        {InsertBuildListScript("buildings")}
                                            <tr>
                                                <th colspan="2">{$lang['tech'][$CurrBuild[0]]}</th>
                                            </tr>
                                            <tr class="data">
                                                <td class="first" rowspan="3">
                                                    <div>
                                                        <img class="queuePic" width="40" height="40" src="{$dpath}gebaeude/{$CurrBuild[0]}.gif" alt="{$lang['tech'][$CurrBuild[0]]}">
                                                    </div>
                                                </td>
                                                <td class="desc ausbau">Improve to 
                                                    <span class="level">Level {$CurrBuild[1]}</span>
                                                </td>
                                            </tr>
                                            <tr class="data">
                                                <td class="desc">Duration:</td>
                                            </tr>
                                            <tr class="data">
                                                <td class="desc timer">
                                                    <div id="blc" class="z">{pretty_time($RestTime)}</div>
                                                </td>
                                            </tr>
                                            <script language="JavaScript">
                                                pp = "{$RestTime}";
                                                pk = "{1}";
                                                pm = "cancel";
                                                pl = "{$PlanetID}";
                                                t();
                                            </script>
                                        {else}
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="idle">
                                                        <a class="tooltip js_hideTipOnMobile
                                                           " title="" href="game.php?page=buildings">
                                                            {$lang['Free']}.<br>(To resources)
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        {/if}
                                        {else}
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="idle">
                                                        <a class="tooltip js_hideTipOnMobile
                                                           " title="" href="game.php?page=buildings">
                                                            {$lang['Free']}.<br>(To resources)
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        {/if}
                                        </table>
                                    </div>
                                    <div class="footer"></div>
                                </div>
                                <div class="content-box-s">
                                    <div class="header">
                                        <h3>{$lang['Research']}</h3>
                                    </div>
                                    <div class="content">    
                                        <table class="construction active" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="idle">
                                                        <a class="tooltip js_hideTipOnMobile
                                                           " title="There is no research done at the moment. Click here to get to your research lab." href="http://s671-en.ogame.gameforge.com/game/index.php?page=research">
                                                            There is no research in progress at the moment.<br>(To research)
                                                        </a>
                                                    </td>
                                                </tr>   
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="footer"></div>
                                </div>
                                <div class="content-box-s">
                                    <div class="header">
                                        <h3>{$lang['Shipyard']}</h3>
                                    </div>
                                    <div class="content">    
                                        <table class="construction active" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="idle">
                                                        <a class="tooltip js_hideTipOnMobile
                                                           " title="At the moment there are no ships or defence being built on this planet. Click here to get to the shipyard." href="http://s671-en.ogame.gameforge.com/game/index.php?page=shipyard">
                                                            No ships/defence in construction.<br>(To shipyard)
                                                        </a>
                                                    </td>
                                                </tr>   
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="footer"></div>
                                </div>
                                <div class="clearfloat"></div>
                                <div class="clearfloat"></div>
                            </div><!-- #overviewBottom -->
    
    
    
    
    
    
        <center>
            <br>
            <table width="519">
                <tr>
                    <td class="c" colspan="4">
                        <a href="game.php?page=renameplanet" title="{$lang['Planet_menu']}">
                            {$lang['Planet']} "{$planetrow['name']}"
                        </a> ({$user['username']})
                    </td>
		</tr>
                {if $user['id'] != ''}
                    {if $user['new_message'] != 0}
                        <tr>
                            {if $user['new_message'] == 1}
                                <th colspan=4><a href=game.php?page=messages>{$lang['Have_new_message']}</a></th>
                            {elseif $user['new_message'] > 1}
                                <th colspan=4><a href=game.php?page=messages>
                                    {str_replace('%m', pretty_number($user['new_message']), $lang['Have_new_messages'])}
                                </a></th>
                            {/if}
                        </tr>
                    {/if}
                {/if}
                {if ($LvlUpMinier + $LvlUpRaid) <= 100}
                    {if $XpMinier >= $XpMinierUp}
                        <tr>
                            <th colspan=4><a href=game.php?page=officier>{$lang['Have_new_level_mineur']}</a></th>
                        </tr>
                    {/if}
                    {if $XPRaid >= $XpRaidUp}
                        <tr>
                            <th colspan=4><a href=game.php?page=officier>{$lang['Have_new_level_raid']}</a></th>
                        </tr>
                    {/if}
                {/if}
		<tr>
                    <th>{$lang['MembersOnline']}</th>
                    <th colspan="3">{$OnlineUsers[0]}</th>
		</tr>
                {if $game_config['OverviewNewsFrame'] == '1'}
                    <tr>
                        <th>{$lang['ov_news_title']}</th>
                        <th colspan="3">{stripslashes($game_config['OverviewNewsText'])}</th>
                    </tr>
                {/if}
		<tr>
                    <th>
                        {if $lunarow['id'] <> 0}
                            {if $planetrow['planet_type'] == 1}
                                <a href="?page=overview&cp={$lune['id']}&re=0" title="{$lune['name']}">
                                    <img src="{$dpath}planeten/{$lune['image']}.jpg" height="50" width="50">
                                </a>
                                <br>
                                {$lune['name']}
                            {/if}
                        {/if}
                    </th>
                    <th colspan="2">
                        <img src="{$dpath}planeten/{$planetrow['image']}.jpg" height="200" width="200">
                        <br>
                    </th>
                    <th class="s">
                        <table class="s" align="top" border="0">
                            <tr>{$anothers_planets}</tr>
			</table>
                    </th>
		</tr>
		<tr>
                    <th>{$lang['Developed_fields']}</th>
                    <th colspan="3" align="center">
                        <div  style="border: 1px solid rgb(153, 153, 255); width: 400px;">
			<div  id="CaseBarre" style="background-color: {if (floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) * 4.0) > (100 * 4.0)}
                                                                        #C00000
                                                                      {elseif (floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) * 4.0) > (80 * 4.0)}
                                                                        #C0C000
                                                                      {else}
                                                                        #00C000
                                                                      {/if}; width: {floor($planetrow['field_current'] / CalculateMaxPlanetFields($planetrow) * 100) * 4.0}px;">
                            <font color="#CCF19F">{floor($planetrow['field_current'] / CalculateMaxPlanetFields($planetrow) * 100)} {$lang['o/o']}</font>
			</div>
                    </th>
                </tr>
                    <tr>
			<th>{$lang['ov_off_level']}</th>
			<th colspan="3" align="center">
                            <table border="0" width="100%">
                                <tbody>
                                    <tr>
					<td align="center" width="50%" style="background-color: transparent;">
                                            <b>{$lang['ov_off_mines']} : {$user['lvl_minier']}</b>
                                        </td>
					<td align="center" width="50%" style="background-color: transparent;">
                                            <b>{$lang['ov_off_raids']} : {$user['lvl_raid']}</b>
                                        </td>
                                    </tr>
				</tbody>
                            </table>
			</th>
                    </tr>
                    <tr>
                        <th>{$lang['ov_off_expe']}</th>
			<th colspan="3" align="center">
                            <table border="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td align="center" width="50%" style="background-color: transparent;">
                                            <b>{$lang['ov_off_mines']} : {$user['xpminier']} / {$lvl_up_minier}</b>
                                        </td>
					<td align="center" width="50%" style="background-color: transparent;">
                                            <b>{$lang['ov_off_raids']} : {$user['xpraid']} / {$lvl_up_raid}</b>
                                        </td>
                                    </tr>
				</tbody>
                            </table>
			</th>
                    </tr>
                    <tr>
			<th>{$lang['ov_local_cdr']}</th>
			<th colspan="3">
                            {$lang['Metal']} : {pretty_number($galaxyrow['metal'])} / {$lang['Crystal']} : {pretty_number($galaxyrow['crystal'])}
                            {if ($galaxyrow['metal'] != 0 || $galaxyrow['crystal'] != 0) && $planetrow[$resource[209]] != 0}
                                (<a href="quickfleet.php?mode=8&g={$galaxyrow['galaxy']}&s={$galaxyrow['system']}&p={$galaxyrow['planet']}&t=2">
                                    {$lang['type_mission'][8]}
                                </a>)
                            {/if}
                        </th>
                    </tr>
                    {if $game_config['ForumBannerFrame'] == '1'}
                        <tr>
                            <th colspan="4">
                                <img src="scripts/createbanner.php?id={$user['id']}">
                                <br>{$lang['InfoBanner']}<br>
                                <input name="bannerlink" type="text" id="bannerlink" value="[img]/scripts/createbanner.php?id={$user['id']}[/img]" size="62">
                            </th>
                        </tr>
                    {/if}
                    {if $game_config['OverviewExternChat'] == '1'}
                        <tr>
                            <th colspan="4">{stripslashes($game_config['OverviewExternChatCmd'])}</th>
                        </tr>
                    {/if}
		</table>
		<br>
		{if $game_config['OverviewClickBanner'] != ''}
                    {stripslashes($game_config['OverviewClickBanner'])}
                {/if}
		<br>
        </center>
{/block}