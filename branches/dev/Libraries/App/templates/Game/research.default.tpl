{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <font color="#ff0000">{if !CheckLabSettingsInQueue ($planetrow)}{$lang['labo_on_update']}{/if}</font>
            <br />
            <table align=top>
                <tr>
                    <td>
                        <table width=530>
                            <tr>
                                {foreach $lang['tech'] as $Tech => $TechName}
                                    {if $Tech > 105 && $Tech <= 199}
                                        {if IsTechnologieAccessible($user, $planetrow, $Tech)}
                                            {$CanBeDone = IsElementBuyable($user, $planetrow, $Tech)}
                                            <tr>
                                                <th class="l">
                                                    <a href="game.php?page=infos&gid={$Tech}">
                                                        <img border=0 src="{$dpath}gebaeude/{$Tech}.gif" align="top" width=120 height=120>
                                                    </a>
                                                </th>
                                                <td class="l">
                                                    <a href="game.php?page=infos&gid={$Tech}">{$TechName}</a> ({$lang['level']} {$user[$resource[$Tech]]})<br>{$lang['res']['descriptions'][$Tech]}<br>
                                                    {GetElementPrice($user, $planetrow, $Tech)}
                                                    {ShowBuildTime(GetBuildingTime($user, $planetrow, $Tech))}
                                                    {$lang['Rest_ress']} {GetRestPrice ($user, $planetrow, $Tech, true)}
                                                </td>
                                                <th class="l">
                                                    {if !$InResearch}
                                                        {$LevelToDo = 1 + $user[$resource[$Tech]]}
                                                        {if $CanBeDone}
                                                            {if !CheckLabSettingsInQueue ($planetrow)}
                                                                {if $LevelToDo == 1}
                                                                    <font color=#FF0000>{$lang['Rechercher']}</font>
                                                                {else}
                                                                    <font color=#FF0000>{$lang['Rechercher']}<br>{$lang['level']} {1 + $user[$resource[$Tech]]}</font>
                                                                {/if}
                                                            {else}
                                                                <a href="game.php?page=research&cmd=search&tech={$Tech}">
                                                                    {if 1 + $user[$resource[$Tech]] == 1}
                                                                        <font color=#00FF00>{$lang['Rechercher']}</font>
                                                                    {else}
                                                                        <font color=#00FF00>{$lang['Rechercher']}<br>{$lang['level']} {1 + $user[$resource[$Tech]]}</font>
                                                                    {/if}
                                                                </a>
                                                            {/if}
                                                        {else}
                                                            {if $LevelToDo == 1}
                                                                <font color=#FF0000>{$lang['Rechercher']}</font>
                                                            {else}
                                                                <font color=#FF0000>{$lang['Rechercher']}<br>{$lang['level']} {1 + $user[$resource[$Tech]]}</font>
                                                            {/if}
                                                        {/if}
                                                    {else}
                                                        {if $ThePlanet["b_tech_id"] == $Tech}
                                                            {if $ThePlanet['id'] != $planetrow['id']}
                                                                <div id="brp" class="z"></div>
                                                                <script   type="text/javascript">
                                                                v = new Date();
                                                                var brp = document.getElementById('brp');
                                                                function t(){
                                                                        n  = new Date();
                                                                        ss = {$ThePlanet["b_tech"] - time()};
                                                                        s  = ss - Math.round( (n.getTime() - v.getTime()) / 1000.);
                                                                        m  = 0;
                                                                        h  = 0;
                                                                        if ( s < 0 ) {
                                                                                brp.innerHTML = '{$lang['ready']}<br><a href=game.php?page=research&cp={$ThePlanet["id"]}>{$lang['continue']}</a>';
                                                                        } else {
                                                                                if ( s > 59 ) { m = Math.floor( s / 60 ); s = s - m * 60; }
                                                                                if ( m > 59 ) { h = Math.floor( m / 60 ); m = m - h * 60; }
                                                                                if ( s < 10 ) { s = "0" + s }
                                                                                if ( m < 10 ) { m = "0" + m }
                                                                                brp.innerHTML = h + ':' + m + ':' + s + '<br><a href=game.php?page=research&cmd=cancel&tech={$ThePlanet["b_tech_id"]}>{$lang['cancel']}<br>{$lang['on']}<br>{$ThePlanet["name"]}</a>';
                                                                        }
                                                                        window.setTimeout("t();",999);
                                                                }
                                                                window.onload=t;
                                                                </script>
                                                            {else}
                                                                <div id="brp" class="z"></div>
                                                                <script   type="text/javascript">
                                                                v = new Date();
                                                                var brp = document.getElementById('brp');
                                                                function t(){
                                                                        n  = new Date();
                                                                        ss = {$planetrow["b_tech"] - time()};
                                                                        s  = ss - Math.round( (n.getTime() - v.getTime()) / 1000.);
                                                                        m  = 0;
                                                                        h  = 0;
                                                                        if ( s < 0 ) {
                                                                                brp.innerHTML = '{$lang['ready']}<br><a href=game.php?page=research&cp={$planetrow["id"]}>{$lang['continue']}</a>';
                                                                        } else {
                                                                                if ( s > 59 ) { m = Math.floor( s / 60 ); s = s - m * 60; }
                                                                                if ( m > 59 ) { h = Math.floor( m / 60 ); m = m - h * 60; }
                                                                                if ( s < 10 ) { s = "0" + s }
                                                                                if ( m < 10 ) { m = "0" + m }
                                                                                brp.innerHTML = h + ':' + m + ':' + s + '<br><a href=game.php?page=research&cmd=cancel&tech={$planetrow["b_tech_id"]}>{$lang['cancel']}<br></a>';
                                                                        }
                                                                        window.setTimeout("t();",999);
                                                                }
                                                                window.onload=t;
                                                                </script>
                                                            {/if}
                                                        {else}
                                                            <center>-</center>
                                                        {/if}
                                                    {/if}
                                                </th>
                                            </tr>
                                        {/if}
                                    {/if}
                                {/foreach}
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
{/block}