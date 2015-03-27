<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Language" content="{$user['lang']}">
        <meta name="ogame-session" content="{$smarty.session.user_id}">
        <meta name="ogame-version" content="{$XNovaRelease}">
        <meta name="ogame-timestamp" content="1426334306">
        <meta name="ogame-universe" content="{$game_config['game_name']}">
        <meta name="ogame-universe-speed" content="{$game_config['game_speed'] / 2500}">
        <meta name="ogame-universe-speed-fleet" content="{$game_config['fleet_speed'] / 2500}">
        <meta name="ogame-language" content="en">
        <meta name="ogame-donut-galaxy" content="1">
        <meta name="ogame-donut-system" content="1">
        <meta name="ogame-player-id" content="{$user['id']}">
        <meta name="ogame-player-name" content="{$user['username']}">
        <meta name="ogame-alliance-id" content="{$user['ally_id']}">
        <meta name="ogame-alliance-name" content="{$user['ally_name']}">
        <meta name="ogame-alliance-tag" content="{$user['id']}">
        <meta name="ogame-planet-id" content="{$planetrow['id']}">
        <meta name="ogame-planet-name" content="{$planetrow['name']}">
        <meta name="ogame-planet-coordinates" content="{$planetrow['galaxy']}:{$planetrow['system']}:{$planetrow['planet']}">
        <meta name="ogame-planet-type" content="{$planetrow['planet_type']}">
        <title>{block name="title"}{$title} - {$game_config['game_name']}{/block}</title>
        <link rel="stylesheet" type="text/css" href="{$dpath}/default.css" />
        <link rel="stylesheet" type="text/css" href="{$dpath}/formate.css" />
        
        <link rel="stylesheet" type="text/css" href="css/3644b63f8e3ea4a0e40c5d12732863.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/fd9255518ad7ce9f678d8e234cf11c.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/9a4260138df4adea89e672c0409aa5.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/4bb848aae84396bb383284869ccd67.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/444e8826d7c04f412fe29e8b0087c2.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/985696fadcc98efe07e58b5282dccc.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/8c9c72b23ec0078b203cdd7997ed07.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/78eb681ceaabefffffacc282668202.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/c8775693c0484697f9ecce4b0bf28f.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/b0bca48f9cb19f2350ed3fd5674656.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/32b054a20d0f9aa3578a28af00096d.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/d4782aed3c72b09ce3fcdc757242a9.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/26ac94d251189aac0bf63243fe6547.css" media="screen">
        
        <script type="text/javascript" src="scripts/overlib.js"></script>
    </head>
    <body id="{$smarty.get.page}" class="ogame lang-{$user['lang']} no-touch">
        <div class="contentBoxBody">
            <noscript>
                <div id="messagecenter">
                    <div id="javamessagebox">
                        <span class="overmark">
                            <strong>Please activate JavaScript to continue with the game.</strong>
                        </span>
                    </div>
                </div>
            </noscript>
            <div id="ie_message">
                <p>
                    <img src="images/e621aa80dbd4746a9f4f114c8d3853.gif" height="16" width="16">{$lang['tpn_update_browser']}
                    <a href="http://www.microsoft.com/upgrade/">{$lang['tpn_IE']}</a>{$lang['tpn_or']}
                    <a href="http://www.mozilla-europe.org/de/firefox/">{$lang['tpn_FF']}</a>.
                </p>
            </div>
            <script type="text/javascript">isIE = false;</script>
            <!--[IF IE]>
                <script type="text/javascript">
                    isIE = true;
                </script>
            <![endif]-->

            <!-- HEADER -->
            
            <!-- ONET 4 POLAND -->