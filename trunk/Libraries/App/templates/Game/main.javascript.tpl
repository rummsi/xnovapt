
                    <!-- JAVASCRIPT -->
                    <script type="text/javascript" src="scripts/overlib.js"></script>
                    <script type="text/javascript" src="REDESIGN/scripts/348dba681ef6dbaeef4ebed0fc0424.js"></script>
                    <script type="text/javascript">
                        var session = "{session_id()}";
                        var vacation = 0;
                        var timerHandler = new TimerHandler();
                        function redirectPremium()
                        {
                            location.href = "game.php?page=officier";
                        }
                        var playerId = "{$user['id']}";
                        var playerName = "{$user['username']}";
                        var session = "{session_id()}";
                        var isMobile = false;
                        var isMobileApp = false;
                        var isMobileOnly = false;
                        var isFacebookUser = false;
                        var overlayWidth = 770;
                        var overlayHeight = 600;
                        var isRTLEnabled = 0;
                        var activateToken = "f0e387bfd07ff3bc33b19b93c7032d53";
                        var miniFleetToken = "dbff9102dae1e2668a998c040dacd944";
                        var currentPage = "{ucfirst($smarty.get.page)}";
                        var bbcodePreviewUrl = "game.php?page=bbcodePreview";
                        var popupWindows = [];
                        var honorScore = 0;
                        var darkMatter = {$user['new_message']};
                        var serverTime = new Date();
                        var localTime = new Date();
                        var timeDiff = serverTime - localTime;
                        localTS = localTime.getTime();
                        var startServerTime = localTime.getTime() - (0) - localTime.getTimezoneOffset() * 60 * 1000;
                        var LocalizationStrings = {
                            "timeunits": {
                                "short": {
                                    "year": "y",
                                    "month": "m",
                                    "week": "w",
                                    "day": "d",
                                    "hour": "h",
                                    "minute": "m",
                                    "second": "s"
                                }
                            },
                            "status": {
                                "ready": "done"
                            },
                            "decimalPoint": ".",
                            "thousandSeperator": ".",
                            "unitMega": "M",
                            "unitKilo": "K",
                            "unitMilliard": "Bn",
                            "question": "Question",
                            "error": "Error",
                            "loading": "load...",
                            "yes": "yes",
                            "no": "No",
                            "ok": "Ok",
                            "attention": "Caution",
                            "outlawWarning": "You are about to attack a stronger player. If you do this, your attack defences will be shut down for 7 days and all players will be able to attack you without punishment. Are you sure you want to continue?",
                            "lastSlotWarningMoon": "This building will use the last available building slot. Expand your Lunar Base to receive more space. Are you sure you want to build this building?",
                            "lastSlotWarningPlanet": "This building will use the last available building slot. Expand your Terraformer or buy a Planet Field item to obtain more slots. Are you sure you want to build this building?",
                            "forcedVacationWarning": "Some game features are unavailable until your account is validated.",
                            "moreDetails": "More details",
                            "lessDetails": "Less detail",
                            "planetOrder": {
                                "lock": "Lock arrangement",
                                "unlock": "Unlock arrangement"
                            },
                            "darkMatter": "Dark Matter",
                            "activateItem": {
                                "upgradeItemQuestion": "Would you like to replace the existing item? The old bonus will be lost in the process.",
                                "upgradeItemQuestionHeader": "Replace item?"
                            }
                        };
                var constants = {
                            "espionage": 6,
                            "missleattack": 10,
                            "language": "{$user['lang']}",
                            "name": "{$game_config['game_name']}"
                        };
                        var userData = {
                            "id": "{$user['id']}"
                        };
                        var missleAttackLink = "game.php?page=missileattacklayer&width=669&height=250";
                        var showOutlawWarning = true;
                        var miniFleetLink = "game.php?page=minifleet&ajax=1";
                        var ogameUrl = "http:\/\/s671-en.ogame.gameforge.com";
                        var startpageUrl = "http:\/\/ogame.org";
                        var nodePort = 10077;
                        var nodeUrl = "REDESIGN\/script\/socket.io\/socket.io.js";
                        var chatUrl = "game.php?page=ajaxChat";
                        var chatLoca = {
                            "TEXT_EMPTY": "Where is the message?",
                            "TEXT_TOO_LONG": "The message is too long.",
                            "SAME_USER": "You cannot write to yourself.",
                            "IGNORED_USER": "You are ignoring this player.",
                            "NO_DATABASE_CONNECTION": "A previously unknown error has occurred. Unfortunately your last action couldn`t be executed!",
                            "INVALID_PARAMETERS": "A previously unknown error has occurred. Unfortunately your last action couldn`t be executed!",
                            "SEND_FAILED": "A previously unknown error has occurred. Unfortunately your last action couldn`t be executed!"
                        };
                        var eventboxLoca = {
                            "mission": "Mission",
                            "missions": "Missions",
                            "next misson": "DUMMY_KEY_N\u00e4chster_fertig",
                            "type": "DUMMY_KEY_Art",
                            "friendly": "own",
                            "neutral": "friendly",
                            "hostile": "hostile",
                            "nextEvent": "Next",
                            "nextEventText": "Type"
                        };

                        function redirectLogout() {
                            location.href = "index.php?page=logout";
                        }

                        function redirectOverview() {
                            location.href = "game.php?page=overview";
                        }

                        function initAjaxEventbox() {
                            reloadEventbox({
                                "hostile": 0,
                                "neutral": 0,
                                "friendly": 0
                            });
                        }

                        function initAjaxResourcebox() {
                            reloadResources({
                                "metal": {
                                    "resources": {
                                        "actualFormat": "{pretty_number($planetrow["metal"])}",
                                        "actual": {$planetrow["metal"]},
                                        "max": {$planetrow["metal_max"]},
                                        "production": 2500
                                    },
                                    "tooltip": "{$lang['Metal']}|<table class=\"resourceTooltip\">\n            <tr>\n                <th>Available:<\/th>\n                <td><span class=\"{if $planetrow["metal"] > $planetrow["metal_max"]}overmark{/if}\">{pretty_number($planetrow["metal"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Storage capacity:<\/th>\n                <td><span class=\"{if $planetrow["metal"] > $planetrow["metal_max"]}overmark{/if}\">{pretty_number($planetrow["metal_max"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Current production:<\/th>\n                <td><span class=\"undermark\">+590<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Den Capacity:<\/th>\n                <td><span class=\"overermark\">0<\/span><\/td>\n            <\/tr>\n        <\/table>",
                                    "class": "{if $planetrow["metal"] > $planetrow["metal_max"]}overmark{/if}"
                                },
                                "crystal": {
                                    "resources": {
                                        "actualFormat": "{pretty_number($planetrow["crystal"])}",
                                        "actual": {$planetrow["crystal"]},
                                        "max": {$planetrow["crystal_max"]},
                                        "production": 32
                                    },
                                    "tooltip": "{$lang['Crystal']}|<table class=\"resourceTooltip\">\n            <tr>\n                <th>Available:<\/th>\n                <td><span class=\"{if $planetrow["crystal"] > $planetrow["crystal_max"]}overmark{/if}\">{pretty_number($planetrow["crystal"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Storage capacity:<\/th>\n                <td><span class=\"{if $planetrow["crystal"] > $planetrow["crystal_max"]}overmark{/if}\">{pretty_number($planetrow["crystal_max"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Current production:<\/th>\n                <td><span class=\"undermark\">+590<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Den Capacity:<\/th>\n                <td><span class=\"overermark\">0<\/span><\/td>\n            <\/tr>\n        <\/table>",
                                    "class": "{if $planetrow["crystal"] > $planetrow["crystal_max"]}overmark{/if}"
                                },
                                "deuterium": {
                                    "resources": {
                                        "actualFormat": "{pretty_number($planetrow["deuterium"])}",
                                        "actual": {$planetrow["deuterium"]},
                                        "max": {$planetrow["deuterium_max"]},
                                        "production": 32
                                    },
                                    "tooltip": "{$lang['Deuterium']}|<table class=\"resourceTooltip\">\n            <tr>\n                <th>Available:<\/th>\n                <td><span class=\"{if $planetrow["deuterium"] > $planetrow["deuterium_max"]}overmark{/if}\">{pretty_number($planetrow["deuterium"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Storage capacity:<\/th>\n                <td><span class=\"{if $planetrow["deuterium"] > $planetrow["deuterium_max"]}overmark{/if}\">{pretty_number($planetrow["deuterium_max"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Current production:<\/th>\n                <td><span class=\"undermark\">+590<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Den Capacity:<\/th>\n                <td><span class=\"overermark\">0<\/span><\/td>\n            <\/tr>\n        <\/table>",
                                    "class": "{if $planetrow["deuterium"] > $planetrow["deuterium_max"]}overmark{/if}"
                                },
                                "energy": {
                                    "resources": {
                                        "actual": {$planetrow["energy_used"]},
                                        "actualFormat": "{pretty_number($planetrow["energy_used"])}"
                                    },
                                    "tooltip": "{$lang['Energy']}|<table class=\"resourceTooltip\">\n            <tr>\n                <th>Available:<\/th>\n                <td><span class=\"overmark\">{pretty_number($planetrow["energy_used"] + $planetrow["energy_max"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Current production:<\/th>\n                <td><span class=\"\">{pretty_number($planetrow["energy_max"])}<\/span><\/td>\n            <\/tr>\n            <tr>\n                <th>Consumption:<\/th>\n                <td><span class=\"overmark\">{pretty_number($planetrow["energy_used"])}<\/span><\/td>\n            <\/tr>\n        <\/table>",
                                    "class": "{if $planetrow["energy_max"] > $planetrow["energy_used"]}overmark{else}undermark{/if}"
                                },
                                "darkmatter": {
                                    "resources": {
                                        "actual": {$user['rpg_points']},
                                        "actualFormat": "{pretty_number($user['rpg_points'])}"
                                    },
                                    "string": "380.072 Dark Matter",
                                    "tooltip": "{$lang['Message']}|<table class=\"resourceTooltip\">\n                <tr>\n                    <th>Available:<\/th>\n                    <td><span class=\"\">{$user['rpg_points']}<\/span><\/td>\n                <\/tr>\n                <tr>\n                    <th>Purchased:<\/th>\n                    <td><span class=\"\">0<\/span><\/td>\n                <\/tr>\n                <tr>\n                    <th>Found:<\/th>\n                    <td><span class=\"\">380.072<\/span><\/td>\n                <\/tr>\n            <\/table>",
                                    "class": ""
                                },
                                "honorScore": 0
                            });
                        }

                        function getAjaxEventbox() {
                            $.get("game.php?page=fetchEventbox&ajax=1", reloadEventbox, "text");
                        }

                        function getAjaxResourcebox(callback) {
                            $.get("game.php?page=fetchResources&ajax=1", function(data) {
                                reloadResources(data, callback);
                            }, "text");
                        }
                        var changeSettingsLink = "game.php?page=changeSettings";
                        var changeSettingsToken = "be9cd58974f9d8f1f73a91b957310e06";
                        var eventlistLink = "game.php?page=eventList&ajax=1";

                        function openAnnouncement() {
                            openOverlay("game.php?page=announcement&ajax=1", {
                                'class': 'announcement',
                                zIndex: 4000
                            });
                        }
                        var timeDelta = 1424540048000 - (new Date()).getTime();
                        var LocalizationStrings = {
                            "timeunits": {
                                "short": {
                                    "year": "y",
                                    "month": "m",
                                    "week": "w",
                                    "day": "d",
                                    "hour": "h",
                                    "minute": "m",
                                    "second": "s"
                                }
                            },
                            "status": {
                                "ready": "done"
                            },
                            "decimalPoint": ".",
                            "thousandSeperator": ".",
                            "unitMega": "M",
                            "unitKilo": "K",
                            "unitMilliard": "Bn",
                            "question": "Question",
                            "error": "Error",
                            "loading": "load...",
                            "yes": "yes",
                            "no": "No",
                            "ok": "Ok",
                            "attention": "Caution",
                            "outlawWarning": "You are about to attack a stronger player. If you do this, your attack defences will be shut down for 7 days and all players will be able to attack you without punishment. Are you sure you want to continue?",
                            "lastSlotWarningMoon": "This building will use the last available building slot. Expand your Lunar Base to receive more space. Are you sure you want to build this building?",
                            "lastSlotWarningPlanet": "This building will use the last available building slot. Expand your Terraformer or buy a Planet Field item to obtain more slots. Are you sure you want to build this building?",
                            "forcedVacationWarning": "Some game features are unavailable until your account is validated.",
                            "moreDetails": "More details",
                            "lessDetails": "Less detail",
                            "planetOrder": {
                                "lock": "Lock arrangement",
                                "unlock": "Unlock arrangement"
                            },
                            "darkMatter": "Dark Matter",
                            "activateItem": {
                                "upgradeItemQuestion": "Would you like to replace the existing item? The old bonus will be lost in the process.",
                                "upgradeItemQuestionHeader": "Replace item?"
                            }
                        };
                        $(document).ready(function() {
                            initEventTable();
                        });
                        var player = {
                            hasCommander: true
                        };
                        var localizedBBCode = {
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
                            },
                            itemNames = {
                                "090a969b05d1b5dc458a6b1080da7ba08b84ec7f": "Bronze Crystal Booster",
                                "e254352ac599de4dd1f20f0719df0a070c623ca8": "Bronze Deuterium Booster",
                                "b956c46faa8e4e5d8775701c69dbfbf53309b279": "Bronze Metal Booster",
                                "3c9f85221807b8d593fa5276cdf7af9913c4a35d": "Bronze Crystal Booster",
                                "422db99aac4ec594d483d8ef7faadc5d40d6f7d3": "Silver Crystal Booster",
                                "118d34e685b5d1472267696d1010a393a59aed03": "Gold Crystal Booster",
                                "d3d541ecc23e4daa0c698e44c32f04afd2037d84": "DETROID Bronze",
                                "0968999df2fe956aa4a07aea74921f860af7d97f": "DETROID Gold",
                                "27cbcd52f16693023cb966e5026d8a1efbbfc0f9": "DETROID Silver",
                                "d9fa5f359e80ff4f4c97545d07c66dbadab1d1be": "Bronze Deuterium Booster",
                                "e4b78acddfa6fd0234bcb814b676271898b0dbb3": "Silver Deuterium Booster",
                                "5560a1580a0330e8aadf05cb5bfe6bc3200406e2": "Gold Deuterium Booster",
                                "40f6c78e11be01ad3389b7dccd6ab8efa9347f3c": "KRAKEN Bronze",
                                "929d5e15709cc51a4500de4499e19763c879f7f7": "KRAKEN Gold",
                                "4a58d4978bbe24e3efb3b0248e21b3b4b1bfbd8a": "KRAKEN Silver",
                                "de922af379061263a56d7204d1c395cefcfb7d75": "Bronze Metal Booster",
                                "ba85cc2b8a5d986bbfba6954e2164ef71af95d4a": "Silver Metal Booster",
                                "05294270032e5dc968672425ab5611998c409166": "Gold Metal Booster",
                                "be67e009a5894f19bbf3b0c9d9b072d49040a2cc": "Bronze Moon Fields",
                                "05ee9654bd11a261f1ff0e5d0e49121b5e7e4401": "Gold Moon Fields",
                                "c21ff33ba8f0a7eadb6b7d1135763366f0c4b8bf": "Silver Moon Fields",
                                "485a6d5624d9de836d3eb52b181b13423f795770": "Bronze M.O.O.N.S.",
                                "45d6660308689c65d97f3c27327b0b31f880ae75": "Gold M.O.O.N.S.",
                                "fd895a5c9fd978b9c5c7b65158099773ba0eccef": "Silver M.O.O.N.S.",
                                "da4a2a1bb9afd410be07bc9736d87f1c8059e66d": "NEWTRON Bronze",
                                "8a4f9e8309e1078f7f5ced47d558d30ae15b4a1b": "NEWTRON Gold",
                                "d26f4dab76fdc5296e3ebec11a1e1d2558c713ea": "NEWTRON Silver",
                                "16768164989dffd819a373613b5e1a52e226a5b0": "Bronze Planet Fields",
                                "04e58444d6d0beb57b3e998edc34c60f8318825a": "Gold Planet Fields",
                                "0e41524dc46225dca21c9119f2fb735fd7ea5cb3": "Silver Planet Fields"
                            };
                        $(document).ready(function() {
                            initIndex();
                            ogame.chat.initChatBar();
                            ogame.chat.initChat();
                            initAjaxEventbox();
                            initChangelog();
                        });
                    </script>
                    <!-- END JAVASCRIPT -->