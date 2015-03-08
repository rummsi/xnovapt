<?php

/*
 * XNovaPT
 * Copyright (C) 2012
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should read the GNU General Public License, see <http://www.gnu.org/licenses/>.
 * 
 * XNovaPT
 * @author XNovaPT Team <xnovaptteam@gmail.com>
 * @ShowGalaxyPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 18:43:15
 */

/**
 * Description of ShowGalaxyPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowGalaxyPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'changelog';
    }

    function show() {
        global $lang, $user, $resource, $planetcount;
        includeLang('galaxy');

        $CurrentPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $user['current_planet'] . "';", 'planets', true);
        $lunarow = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $user['current_luna'] . "';", 'lunas', true);
        $galaxyrow = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '" . $CurrentPlanet['id'] . "';", 'galaxy', true);

        $dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
        $fleetmax = $user['computer_tech'] + 1;
        $CurrentPlID = $CurrentPlanet['id'];
        $CurrentMIP = $CurrentPlanet['interplanetary_misil'];
        $CurrentRC = $CurrentPlanet['recycler'];
        $CurrentSP = $CurrentPlanet['spy_sonde'];
        $HavePhalanx = $CurrentPlanet['phalanx'];
        $CurrentSystem = $CurrentPlanet['system'];
        $CurrentGalaxy = $CurrentPlanet['galaxy'];
        $CanDestroy = $CurrentPlanet[$resource[213]] + $CurrentPlanet[$resource[214]];

        $maxfleet = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "';", 'fleets');
        $maxfleet_count = mysqli_num_rows($maxfleet);

        CheckPlanetUsedFields($CurrentPlanet);
        CheckPlanetUsedFields($lunarow);

        if (!isset($action)) {
            if (isset($_GET['action'])) {
                $action = intval($_GET['action']);
            } else {
                $action = 0;
            }
        }

        $galaxy = 1;
        $system = 1;
        $planet = null;

        if ($action == 0) {
            $galaxy = $CurrentGalaxy;
            $system = $CurrentSystem;
        } elseif ($action == 1 || $action == 3) {
            if (isset($_POST["galaxyLeft"])) {
                if (!isset($_POST["galaxy"]) || $_POST["galaxy"] <= 1 || $_POST["galaxy"] > MAX_GALAXY_IN_WORLD) {
                    $galaxy = 1;
                } else {
                    $galaxy = intval($_POST["galaxy"]) - 1;
                }
            } elseif (isset($_POST["galaxyRight"])) {
                if (!isset($_POST["galaxy"]) || $_POST["galaxy"] >= MAX_GALAXY_IN_WORLD) {
                    $galaxy = MAX_GALAXY_IN_WORLD;
                } else {
                    $galaxy = intval($_POST["galaxy"]) + 1;
                }
            } else if (!isset($_POST["galaxy"]) || $_POST["galaxy"] <= 1 || $_POST["galaxy"] > MAX_GALAXY_IN_WORLD) {
                $galaxy = 1;
            } else {
                $galaxy = intval($_POST["galaxy"]);
            }

            if (isset($_POST["systemLeft"])) {
                if (!isset($_POST["system"]) || $_POST["system"] <= 1 || $_POST["system"] > MAX_SYSTEM_IN_GALAXY) {
                    $system = 1;
                } else {
                    $system = intval($_POST["system"]) - 1;
                }
            } elseif (isset($_POST["systemRight"])) {
                if (!isset($_POST["system"]) || $_POST["system"] >= MAX_SYSTEM_IN_GALAXY) {
                    $system = MAX_SYSTEM_IN_GALAXY;
                } else {
                    $system = intval($_POST["system"]) + 1;
                }
            } else if (!isset($_POST["system"]) || $_POST["system"] <= 1 || $_POST["system"] > MAX_SYSTEM_IN_GALAXY) {
                $system = 1;
            } else {
                $system = intval($_POST["system"]);
            }
        } elseif ($action == 2) {
            if (!isset($_POST["galaxy"]) || $_POST["galaxy"] <= 0) {
                $galaxy = 1;
            } else if ($_POST["galaxy"] >= MAX_GALAXY_IN_WORLD) {
                $galaxy = MAX_GALAXY_IN_WORLD;
            } else {
                $galaxy = intval($_POST["galaxy"]) + 1;
            }

            if (!isset($_POST["system"]) || $_POST["system"] <= 0) {
                $system = 1;
            } else if ($_POST["system"] >= MAX_SYSTEM_IN_GALAXY) {
                $system = MAX_SYSTEM_IN_GALAXY;
            } else {
                $system = intval($_POST["system"]) + 1;
            }

            if (!isset($_POST["planet"]) || $_POST["planet"] <= 0) {
                $planet = 1;
            } else if ($_POST["planet"] >= MAX_PLANET_IN_SYSTEM) {
                $planet = MAX_PLANET_IN_SYSTEM;
            } else {
                $planet = intval($_POST["planet"]) + 1;
            }
        }

        $planetcount = 0;
        $lunacount = 0;

        //Galaxy Selector
        if ($galaxy > MAX_GALAXY_IN_WORLD) {
            $galaxy = MAX_GALAXY_IN_WORLD;
        }
        if ($galaxy < 1) {
            $galaxy = 1;
        }
        if ($system > MAX_SYSTEM_IN_GALAXY) {
            $system = MAX_SYSTEM_IN_GALAXY;
        }
        if ($system < 1) {
            $system = 1;
        }
        //End of Galaxy Selector

        $Result = "";
        for ($Planet = 1; $Planet < 16; $Planet++) {
            unset($GalaxyRowPlanet);
            unset($GalaxyRowMoon);
            unset($GalaxyRowPlayer);
            unset($GalaxyRowAlly);
            $GalaxyRow = doquery("SELECT * FROM {{table}} WHERE `galaxy` = '" . $galaxy . "' AND `system` = '" . $system . "' AND `planet` = '" . $Planet . "';", 'galaxy', true);
            $Result .= "\n";
            $Result .= "<tr>"; // Depart de ligne
            if ($GalaxyRow) {
                // Il existe des choses sur cette ligne de planete
                if ($GalaxyRow["id_planet"] != 0) {
                    $GalaxyRowPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRow["id_planet"] . "';", 'planets', true);
                    if ($GalaxyRowPlanet['destruyed'] != 0 AND $GalaxyRowPlanet['id_owner'] != '' AND $GalaxyRow["id_planet"] != '') {
                        CheckAbandonPlanetState($GalaxyRowPlanet);
                    } else {
                        $planetcount++;
                        $GalaxyRowPlayer = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRowPlanet["id_owner"] . "';", 'users', true);
                    }
                    if ($GalaxyRow["id_luna"] != 0) {
                        $GalaxyRowMoon = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRow["id_luna"] . "';", 'lunas', true);
                        if ($GalaxyRowMoon["destruyed"] != 0) {
                            CheckAbandonMoonState($GalaxyRowMoon);
                        }
                    }
                    $GalaxyRowPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRow["id_planet"] . "';", 'planets', true);
                    if ($GalaxyRowPlanet['id_owner'] <> 0) {
                        $GalaxyRowUser = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRowPlanet['id_owner'] . "';", 'users', true);
                    } else {
                        $GalaxyRowUser = array();
                    }
                }
            }
            $Result .= "\n";
            $Result .= GalaxyRowPos($Planet, $GalaxyRow);
            $Result .= "\n";
            @$Result .= GalaxyRowPlanet($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $galaxy, $system, $Planet, 1);
            $Result .= "\n";
            @$Result .= GalaxyRowPlanetName($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $galaxy, $system, $Planet, 1);
            $Result .= "\n";
            @$Result .= GalaxyRowMoon($GalaxyRow, $GalaxyRowMoon, $GalaxyRowPlayer, $galaxy, $system, $Planet, 3);
            $Result .= "\n";
            @$Result .= GalaxyRowDebris($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $galaxy, $system, $Planet, 2);
            $Result .= "\n";
            @$Result .= GalaxyRowUser($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $galaxy, $system, $Planet, 0);
            $Result .= "\n";
            @$Result .= GalaxyRowAlly($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $galaxy, $system, $Planet, 0);
            $Result .= "\n";
            @$Result .= GalaxyRowActions($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $galaxy, $system, $Planet, 0);
            $Result .= "\n";
            @$Result .= "</tr>";
        }

        $this->tplObj->assign(array(
            'title' => $lang['Galaxy'],
            'CurrentPlanet' => $CurrentPlanet,
            'galaxy' => $galaxy,
            'system' => $system,
            'planet' => $planet,
            'action' => $action,
            'planetcount' => $planetcount,
            'ShowGalaxyRows' => $Result,
            'CurrentMIP' => $CurrentMIP,
            'maxfleet_count' => $maxfleet_count,
            'fleetmax' => $fleetmax,
            'LegendPopup' => self::GalaxyLegendPopup(),
        ));

        $this->render('galaxy.default.tpl');
    }

    function ShowGalaxyRows($Galaxy, $System) {
        global $lang, $planetcount, $CurrentRC, $dpath, $user;

        $Result = "";
        for ($Planet = 1; $Planet < 16; $Planet++) {
            unset($GalaxyRowPlanet);
            unset($GalaxyRowMoon);
            unset($GalaxyRowPlayer);
            unset($GalaxyRowAlly);
            $GalaxyRow = doquery("SELECT * FROM {{table}} WHERE `galaxy` = '" . $Galaxy . "' AND `system` = '" . $System . "' AND `planet` = '" . $Planet . "';", 'galaxy', true);
            $Result .= "\n";
            $Result .= "<tr>"; // Depart de ligne
            if ($GalaxyRow) {
                // Il existe des choses sur cette ligne de planete
                if ($GalaxyRow["id_planet"] != 0) {
                    $GalaxyRowPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRow["id_planet"] . "';", 'planets', true);
                    if ($GalaxyRowPlanet['destruyed'] != 0 AND $GalaxyRowPlanet['id_owner'] != '' AND $GalaxyRow["id_planet"] != '') {
                        CheckAbandonPlanetState($GalaxyRowPlanet);
                    } else {
                        $planetcount++;
                        $GalaxyRowPlayer = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRowPlanet["id_owner"] . "';", 'users', true);
                    }
                    if ($GalaxyRow["id_luna"] != 0) {
                        $GalaxyRowMoon = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRow["id_luna"] . "';", 'lunas', true);
                        if ($GalaxyRowMoon["destruyed"] != 0) {
                            CheckAbandonMoonState($GalaxyRowMoon);
                        }
                    }
                    $GalaxyRowPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRow["id_planet"] . "';", 'planets', true);
                    if ($GalaxyRowPlanet['id_owner'] <> 0) {
                        $GalaxyRowUser = doquery("SELECT * FROM {{table}} WHERE `id` = '" . $GalaxyRowPlanet['id_owner'] . "';", 'users', true);
                    } else {
                        $GalaxyRowUser = array();
                    }
                }
            }
            $Result .= "\n";
            $Result .= GalaxyRowPos($Planet, $GalaxyRow);
            $Result .= "\n";
            $Result .= GalaxyRowPlanet($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 1);
            $Result .= "\n";
            $Result .= GalaxyRowPlanetName($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 1);
            $Result .= "\n";
            $Result .= GalaxyRowMoon($GalaxyRow, $GalaxyRowMoon, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 3);
            $Result .= "\n";
            $Result .= GalaxyRowDebris($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 2);
            $Result .= "\n";
            $Result .= GalaxyRowUser($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0);
            $Result .= "\n";
            $Result .= GalaxyRowAlly($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0);
            $Result .= "\n";
            $Result .= GalaxyRowActions($GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0);
            $Result .= "\n";
            $Result .= "</tr>";
        }
        return $Result;
    }

    function GalaxyLegendPopup() {
        global $lang;

        $Result = "<a href=# style=\"cursor: pointer;\"";
        $Result .= " onmouseover='return overlib(\"";
        $Result .= "<table width=240>";
        $Result .= "<tr>";
        $Result .= "<td class=c colspan=2>" . $lang['Legend'] . "</td>";
        $Result .= "</tr><tr>";
        $Result .= "<td width=220>" . $lang['Strong_player'] . "</td><td><span class=strong>" . $lang['strong_player_shortcut'] . "</span></td>";
        $Result .= "</tr><tr>";
        $Result .= "<td width=220>" . $lang['Weak_player'] . "</td><td><span class=noob>" . $lang['weak_player_shortcut'] . "</span></td>";
        $Result .= "</tr><tr>";
        $Result .= "<td width=220>" . $lang['Way_vacation'] . "</td><td><span class=vacation>" . $lang['vacation_shortcut'] . "</span></td>";
        $Result .= "</tr><tr>";
        $Result .= "<td width=220>" . $lang['Pendent_user'] . "</td><td><span class=banned>" . $lang['banned_shortcut'] . "</span></td>";
        $Result .= "</tr><tr>";
        $Result .= "<td width=220>" . $lang['Inactive_7_days'] . "</td><td><span class=inactive>" . $lang['inactif_7_shortcut'] . "</span></td>";
        $Result .= "</tr><tr>";
        $Result .= "<td width=220>" . $lang['Inactive_28_days'] . "</td><td><span class=longinactive>" . $lang['inactif_28_shortcut'] . "</span></td>";
        $Result .= "</tr><tr>";
        $Result .= "<td width=220>Admin</td><td><font color=lime><blink>A</blink></font></td>";
        $Result .= "</tr>";
        $Result .= "</table>";
        $Result .= "\",STICKY, MOUSEOFF, OFFSETY, -100);' onmouseout='return nd();'>";
        $Result .= $lang['Legend'] . "</a>";

        return $Result;
    }

}
