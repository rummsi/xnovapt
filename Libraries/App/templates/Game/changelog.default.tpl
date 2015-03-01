{block name="title" prepend}{/block}
{block name="content"}
                        <div id="inhalt">
                            <dl id="changelog" class="major">{foreach $changelog as $main_version => $update_version}
                                <dt class="header {cycle values="even,odd"} open">{$Version} {$main_version}</dt>
                                <dd style="display: block;">
                                    <dl class="minor">{foreach $update_version as $version_number => $description}
                                        <dt class="version {cycle values="odd,even"} open">Update {$version_number}</dt>
                                        <dd style="display: block;" class="{cycle values="odd,even"}">
                                            <ul>
                                                {$description|nl2br}
                                            </ul>
                                        </dd>{/foreach}
                                    </dl>
                                </dd>{/foreach}
                            </dl>
                        </div>
{/block}