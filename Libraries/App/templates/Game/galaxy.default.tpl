{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <div style="top: 10px;" id="content">
{include file="galaxy.scripts.tpl"}
                <body style="overflow: auto;" onUnload="">
{include file="galaxy.selector.tpl"}
{if $action == 2}
{include file="galaxy.MIselector.tpl"}
{/if}
                    <table width=569>
                        <tbody>
{include file="galaxy.titles.tpl"}
                            {$ShowGalaxyRows}
{include file="galaxy.footer.tpl"}
                        </tbody>
                    </table>
                </body>
            </div>
        </center>
{/block}