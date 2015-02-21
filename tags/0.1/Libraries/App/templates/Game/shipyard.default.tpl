{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br />
            <table align="top">
                <tr>
                    <td>
                        <form action="game.php?page=shipyard" method="post">
                            <table width=530>
                                {$tableIndex = 0}
                                {foreach $types[Legacies_Empire::TYPE_SHIP] as $shipId}
                                    {if $shipyard->checkAvailability($shipId)}
                                        {$CanBuildOne         = IsElementBuyable($user, $planetrow, $shipId, false)}
                                        {$BuildOneElementTime = $shipyard->getBuildTime($shipId, 1)}
                                <tr>
                                    <th class=l>
                                        <a href=game.php?page=infos&gid={$shipId}>
                                            <img border=0 src="{$dpath}gebaeude/{$shipId}.gif" align=top width=120 height=120>
                                        </a>
                                    </th>
                                    <td class=l>
                                        <a href=game.php?page=infos&gid={$shipId}>{$lang['info'][$shipId]['name']}</a>
                                        {if $planetrow[$resource[$shipId]] > 0}
                                            ({$lang['dispo']}: {pretty_number($planetrow[$resource[$shipId]])})
                                        {/if}<br />
                                        {$lang['res']['descriptions'][$shipId]}<br />
                                        {GetElementPrice($user, $planetrow, $shipId, false)}
                                        {ShowBuildTime($BuildOneElementTime)}
                                    </td>
                                    <th class=k>
                                        {if $CanBuildOne}
                                            <input type=text id="fmenge:{$shipId}" name=fmenge[{$shipId}] alt='{$lang['tech'][$shipId]}' value=0 tabindex={$tableIndex}>
                                        {/if}
                                        {$maxElements = $shipyard->getMaximumBuildableElementsCount($shipId)}
                                        {if (MAX_FLEET_OR_DEFS_PER_ROW > 0 && $maxElements > MAX_FLEET_OR_DEFS_PER_ROW)}
                                            {$maxElements = MAX_FLEET_OR_DEFS_PER_ROW}
                                        {/if}
                                        {if ($CanBuildOne)}
                                            <br />
                                            <a onclick="document.getElementById('fmenge:{$shipId}').value='{strval($maxElements)}';" style="cursor:pointer;">Nombre max ({number_format($maxElements, 0, ',', '.')})</a>
                                        {/if}
                                    </th>
                                </tr>
                                    {/if}
                                {/foreach}
                                <tr>
                                    <td class="c" colspan=2 align="center">
                                        <input type="submit" value="{$lang['Construire']}">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                    <td valign="top"></td>
                </tr>
            </table>
            {if (!empty($planetrow['b_hangar_id']))}
                <div>Production Actuelle:
                    <select id="buildList" size="10"></select>
                </div>
                <script type="text/javascript">
                //<![CDATA[
                var date = new Date();
                var data = {$data};
                var select = document.getElementById('buildList');

                setInterval(function(){
                  var now = new Date();
                  var datediff = (now.getTime() - date.getTime()) / 1000;

                  var option = null;
                  var index = 0;
                  if (data.length == 0) {
                    select.parentNode.style.display = 'none';
                    return;
                  }
                  select.length = 0;
                  for (i in data) {
                    if (datediff > 0) {
                      data[i]['actual_qty'] = data[i]['qty'] - Math.floor(datediff / data[i]['speed']);
                    } else {
                      data[i]['actual_qty'] = data[i]['qty'];
                    }
                    if (data[i]['actual_qty'] <= 0) {
                      datediff = datediff - (data[i]['speed'] * data[i]['qty']);
                      delete data[i];
                      continue;
                    } else {
                      datediff = 0;
                    }
                    option = new Option(data[i]['label'] + ' (' + data[i]['actual_qty'] + ')', data[i]['speed'], false, true);
                    select.options[index++] = option;
                  }
                  }, 1000);
                //]]>
                </script>
            {/if}
        </center>
{/block}