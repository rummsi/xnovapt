<?php
/**
 * This file is part of XNova:Legacies
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team <http://www.xnova-ng.org>
 * All rights reserved.
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
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

function MissionCaseSpy($FleetRow) {
    global $lang, $resource, $user, $planetrow;

    if ($FleetRow['fleet_start_time'] <= time() AND $FleetRow['fleet_mess'] != 1) {
        $QryGetTargetPlanet = <<<SQL
SELECT * 
FROM {{table}}
WHERE 
`galaxy` = '{$FleetRow['fleet_end_galaxy']}' AND 
`system` = '{$FleetRow['fleet_end_system']}' AND 
`planet` = '{$FleetRow['fleet_end_planet']}' AND 
`planet_type` = '{$FleetRow['fleet_end_type']}'
SQL;
        $TargetPlanet = doquery($QryGetTargetPlanet, 'planets', true);
        $TargetUserID = $TargetPlanet['id_owner'];
        $CurrentSpyLvl = $user['spy_tech'];
        $TargetUser = doquery("SELECT * FROM {{table}} WHERE `id` = '{$TargetUserID}'", 'users', true);
        $TargetSpyLvl = $TargetUser['spy_tech'];

        // Actualisation des ressources de la planete.
        PlanetResourceUpdate($TargetUser, $TargetPlanet, time());

        $fleet = explode(";", $FleetRow['fleet_array']);

        $Count = $fleet[Legacies_Empire::ID_SHIP_SPY_DRONE];

        $SpyToolDebris = $Count * 300;

        $MaterialsInfo = SpyTarget($TargetPlanet, 0, $lang['sys_spy_maretials']);
        $Materials = $MaterialsInfo['String'];

        $PlanetFleetInfo = SpyTarget($TargetPlanet, 1, $lang['sys_spy_fleet']);
        $PlanetFleet = $Materials;
        $PlanetFleet .= $PlanetFleetInfo['String'];

        $PlanetDefenInfo = SpyTarget($TargetPlanet, 2, $lang['sys_spy_defenses']);
        $PlanetDefense = $PlanetFleet;
        $PlanetDefense .= $PlanetDefenInfo['String'];

        $PlanetBuildInfo = SpyTarget($TargetPlanet, 3, $lang['tech'][0]);
        $PlanetBuildings = $PlanetDefense;
        $PlanetBuildings .= $PlanetBuildInfo['String'];

        $TargetTechnInfo = SpyTarget($TargetUser, 4, $lang['tech'][100]);
        $TargetTechnos = $PlanetBuildings;
        $TargetTechnos .= $TargetTechnInfo['String'];

        $TargetForce = ($PlanetFleetInfo['Count'] * $LS) / 4;
        $TargetForce = max(0, min(100, $TargetForce));

        $TargetChances = rand(0, $TargetForce);
        $SpyerChances = rand(0, 100);

        if ($TargetChances < $SpyerChances)
            $DestProba = sprintf($lang['sys_mess_spy_lostproba'], $TargetChances);
        else
            $DestProba = "<font color=\"red\">" . $lang['sys_mess_spy_destroyed'] . "</font>";

        $AttackLink = "<center>";
        $AttackLink .= "<a href=\"fleet.php?galaxy=" . $FleetRow['fleet_end_galaxy'] . "&system=" . $FleetRow['fleet_end_system'] . "";
        $AttackLink .= "&planet=" . $FleetRow['fleet_end_planet'] . "";
        $AttackLink .= "&target_mission=1";
        $AttackLink .= " \">" . $lang['type_mission'][1] . "";
        $AttackLink .= "</a></center>";
        $AttackLink .= "<center>" . $DestProba . "</center>";

        $pW = ($CurrentSpyLvl - $TargetSpyLvl);

        if ($TargetSpyLvl == $CurrentSpyLvl)
            $ST = $CurrentSpyLvl;
        else
            $ST = ($Count - abs(pow($pW, 2)));

        if ($ST <= 1)
            $SpyMessage = $Materials . "<br />" . $AttackLink;
        if ($ST == 2)
            $SpyMessage = $PlanetFleet . "<br />" . $AttackLink;
        if ($ST == 4 or $ST == 3)
            $SpyMessage = $PlanetDefense . "<br />" . $AttackLink;
        if ($ST == 5 or $ST == 6)
            $SpyMessage = $PlanetBuildings . "<br />" . $AttackLink;
        if ($ST >= 7)
            $SpyMessage = $TargetTechnos . "<br />" . $AttackLink;

        SendSimpleMessage($user['id'], '', $FleetRow['fleet_start_time'], 0, $lang['sys_mess_qg'], $lang['sys_mess_spy_report'], $SpyMessage);

        $TargetMessage = $lang['sys_mess_spy_ennemyfleet'] . " " . $planetrow['name'];
        $TargetMessage .= "<a href=\"galaxy.php?mode=3&galaxy=" . $planetrow["galaxy"] . "&system=" . $planetrow["system"] . "\">";
        $TargetMessage .= "[" . $planetrow["galaxy"] . ":" . $planetrow["system"] . ":" . $planetrow["planet"] . "]</a> ";
        $TargetMessage .= $lang['sys_mess_spy_seen_at'] . " " . $TargetPlanet['name'];
        $TargetMessage .= " [" . $TargetPlanet["galaxy"] . ":" . $TargetPlanet["system"] . ":" . $TargetPlanet["planet"] . "].";

        SendSimpleMessage($TargetUserID, '', $FleetRow['fleet_start_time'], 0, $lang['sys_mess_spy_control'], $lang['sys_mess_spy_activity'], $TargetMessage);

        if ($TargetChances >= $SpyerChances) {
            $QryUpdDebris = <<<SQL
UPDATE {{table}} 
SET `crystal` = `crystal` + '{$SpyToolDebris}' 
WHERE `id_planet` = '{$TargetPlanet['id']}'
SQL;
            doquery($QryUpdateGalaxy, 'galaxy');
            doquery("DELETE FROM {{table}} WHERE `fleet_id` = '{$FleetRow["fleet_id"]}'", 'fleets');
        } else
            doquery("UPDATE {{table}} SET `fleet_mess` = '1' WHERE `fleet_id` = '{$FleetRow["fleet_id"]}'", 'fleets');
    }
    elseif ($FleetRow['fleet_end_time'] <= time()) {
        // Retour de sondes
        RestoreFleetToPlanet($FleetRow, true);
        doquery("DELETE FROM {{table}} WHERE `fleet_id` = '{$FleetRow["fleet_id"]}'", 'fleets');
    }
}
