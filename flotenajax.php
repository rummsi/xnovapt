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

define('INSIDE' , true);
define('INSTALL' , false);
require_once dirname(__FILE__) .'/common.php';

	includeLang('galaxy');
	includeLang('fleet');

	$UserSpyProbes  = $planetrow['spy_sonde'];
	$UserRecycles   = $planetrow['recycler'];
	$UserDeuterium  = $planetrow['deuterium'];
	$UserMissiles   = $planetrow['interplanetary_misil'];

	$fleet          = array();
	$speedalls      = array();
	$PartialFleet   = false; // 610
	$PartialCount   = 0;

	foreach ($reslist['fleet'] as $Node => $ShipID) {
		$TName = "ship".$ShipID;
		if ($ShipID > 200 && $ShipID < 300 && $post[$TName] > 0) {
			if ($post[$TName] > $planetrow[$resource[$ShipID]]) {
				$fleet['fleetarray'][$ShipID]   = $planetrow[$resource[$ShipID]];
				$fleet['fleetlist']            .= $ShipID .",". $planetrow[$resource[$ShipID]] .";";
				$fleet['amount']               += $planetrow[$resource[$ShipID]];
				$PartialCount                  += $planetrow[$resource[$ShipID]];
				$PartialFleet                   = true;
			} else {
				$fleet['fleetarray'][$ShipID]   = $post[$TName];
				$fleet['fleetlist']            .= $ShipID .",". $post[$TName] .";";
				$fleet['amount']               += $post[$TName];
				$speedalls[$ShipID]             = $post[$TName];
			}
		}
	}

	if ($PartialFleet == true) {
		if ( $PartialCount < 1 ) {
			$ResultMessage = "610;".$lang['gs_c610a']. $PartialCount .$lang['gs_c610b']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
			die ( $ResultMessage );
		}
	}

	$PrNoob      = $game_config['noobprotection'];
	$PrNoobTime  = $game_config['noobprotectiontime'];
	$PrNoobMulti = $game_config['noobprotectionmulti'];

	// Petit Test de coherance
	$galaxy          = intval($post['galaxy']);
	if ($galaxy > 9 || $galaxy < 1) {
		$ResultMessage = "602;".$lang['gs_c602']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	$system = intval($post['system']);
	if ($system > 499 || $system < 1) {
		$ResultMessage = "602;".$lang['gs_c602']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	$planet = intval($post['planet']);
	if ($planet > 15 || $planet < 1) {
		$ResultMessage = "602;".$lang['gs_c602']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	$FleetArray = $fleet['fleetarray'];

	$CurrentFlyingFleets = doquery("SELECT COUNT(fleet_id) AS `Nbre` FROM {{table}} WHERE `fleet_owner` = '".$user['id']."';", 'fleets', true);
	$CurrentFlyingFleets = $CurrentFlyingFleets["Nbre"];

	$QrySelectEnemy  = "SELECT * FROM {{table}} ";
	$QrySelectEnemy .= "WHERE ";
	$QrySelectEnemy .= "`galaxy` = '". $post['galaxy'] ."' AND ";
	$QrySelectEnemy .= "`system` = '". $post['system'] ."' AND ";
	$QrySelectEnemy .= "`planet` = '". $post['planet'] ."' AND ";
	$QrySelectEnemy .= "`planet_type` = '". $post['planettype'] ."';";
	$TargetRow = doquery( $QrySelectEnemy, 'planets', true);

	if       ($TargetRow['id_owner'] == '') {
		$TargetUser = $user;
	} elseif ($TargetRow['id_owner'] != '') {
		$TargetUser = doquery("SELECT * FROM {{table}} WHERE `id` = '". $TargetRow['id_owner'] ."';", 'users', true);
	}
	$UserPoints    = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $user['id'] ."';", 'statpoints', true);
	$User2Points   = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TargetUser['id'] ."';", 'statpoints', true);

	$CurrentPoints = $UserPoints['total_points'];
	$TargetPoints  = $User2Points['total_points'];
	$TargetVacat   = $TargetUser['urlaubs_modus'];

	// Test s'il y a un slot de libre au moins !
	if (($user[$resource[108]] + 1) <= $CurrentFlyingFleets) {
		$ResultMessage = "612;".$lang['gs_c612']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	// Y a une flotte dans la variable ??
	if (!is_array($FleetArray)) {
		$ResultMessage = "618;".$lang['gs_c618']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	// Faut pas deconner non plus ... c'est Espionnage OU Recyclage .... Pour le café vous repasserez !!
	if (! (($post["mission"] == 6) OR
		   ($post["mission"] == 8)) ) {
		$ResultMessage = "618;".$lang['gs_c618']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	// On teste une derniere fois s'il nous reste des billes ...
	foreach ($FleetArray as $Ships => $Count) {
		if ($Count > $planetrow[$resource[$Ships]]) {
			$ResultMessage = "611;".$lang['gs_c611']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
			die ( $ResultMessage );
		}
	}

	if ($PrNoobTime < 1) {
		$PrNoobTime = 9999999999999999;
	}

	if ($TargetVacat && $post['mission'] != 8) {
		$ResultMessage = "605;".$lang['gs_c605']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	if ($CurrentPoints          > ($TargetPoints * $PrNoobMulti) AND
		$TargetRow['id_owner'] != '' AND
		$post['mission']      == 6  AND
		$PrNoob                == 1  AND
		$TargetPoints           < ($PrNoobTime * 1000)) {
		$ResultMessage = "603;".$lang['gs_c603']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	if ($TargetPoints           > ($CurrentPoints * $PrNoobMulti) AND
		$TargetRow['id_owner'] != '' AND
		$post['mission']      == 6  AND
		$PrNoob                == 1  AND
		$CurrentPoints          < ($PrNoobTime * 1000)) {
		$ResultMessage = "604;".$lang['gs_c604']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	if ($TargetRow['id_owner'] == '' AND
		$post['mission']      != 8 ) {
		$ResultMessage = "601;".$lang['gs_c601']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	if (($TargetRow["id_owner"] == $planetrow["id_owner"]) AND
		($post["mission"] == 6)) {
		$ResultMessage = "618;".$lang['gs_c618']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	if ($post['thisgalaxy'] != $planetrow['galaxy'] |
		$post['thissystem'] != $planetrow['system'] |
		$post['thisplanet'] != $planetrow['planet'] |
		$post['thisplanettype'] != $planetrow['planet_type']) {
		$ResultMessage = "618;".$lang['gs_c618']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
		die ( $ResultMessage );
	}

	$Distance    = GetTargetDistance ($post['thisgalaxy'], $post['galaxy'], $post['thissystem'], $post['system'], $post['thisplanet'], $post['planet']);
	$speedall    = GetFleetMaxSpeed ($FleetArray, 0, $user);
	$SpeedAllMin = min($speedall);
	$Duration    = GetMissionDuration ( 10, $SpeedAllMin, $Distance, GetGameSpeedFactor ());

	$fleet['fly_time']   = $Duration;
	$fleet['start_time'] = $Duration + time();
	$fleet['end_time']   = ($Duration * 2) + time();

	$FleetShipCount      = 0;
	$FleetDBArray        = "";
	$FleetSubQRY         = "";
	$consumption         = 0;
	$SpeedFactor         = GetGameSpeedFactor ();
	foreach ($FleetArray as $Ship => $Count) {
		$ShipSpeed        = $pricelist[$Ship]["speed"];
		$spd              = 35000 / ($Duration * $SpeedFactor - 10) * sqrt($Distance * 10 / $ShipSpeed);
		$basicConsumption = $pricelist[$Ship]["consumption"] * $Count ;
		$consumption     += $basicConsumption * $Distance / 35000 * (($spd / 10) + 1) * (($spd / 10) + 1);
		$FleetShipCount  += $Count;
		$FleetDBArray    .= $Ship .",". $Count .";";
		$FleetSubQRY     .= "`".$resource[$Ship] . "` = `" . $resource[$Ship] . "` - " . $Count . " , ";
	}
	$consumption = round($consumption) + 1;

	if ($TargetRow['id_level'] > $user['authlevel']) {
		$Allowed = true;
		switch ($post['mission']){
			case 1:
			case 2:
			case 6:
			case 9:
				$Allowed = false;
				break;
			case 3:
			case 4:
			case 5:
			case 7:
			case 8:
			case 15:
				break;
			default:
		}
		if ($Allowed == false) {
			$ResultMessage = "619;".$lang['gs_c619']."|".$CurrentFlyingFleets." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;
			die ( $ResultMessage );
		}
	}

	$QryInsertFleet  = "INSERT INTO {{table}} SET ";
	$QryInsertFleet .= "`fleet_owner` = '". $user['id'] ."', ";
	$QryInsertFleet .= "`fleet_mission` = '". intval($post['mission']) ."', ";
	$QryInsertFleet .= "`fleet_amount` = '". $FleetShipCount ."', ";
	$QryInsertFleet .= "`fleet_array` = '". $FleetDBArray ."', ";
	$QryInsertFleet .= "`fleet_start_time` = '". $fleet['start_time']. "', ";
	$QryInsertFleet .= "`fleet_start_galaxy` = '". intval($post['thisgalaxy']) ."', ";
	$QryInsertFleet .= "`fleet_start_system` = '". intval($post['thissystem']) ."', ";
	$QryInsertFleet .= "`fleet_start_planet` = '". intval($post['thisplanet']) ."', ";
	$QryInsertFleet .= "`fleet_start_type` = '". intval($post['thisplanettype']) ."', ";
	$QryInsertFleet .= "`fleet_end_time` = '". $fleet['end_time'] ."', ";
	$QryInsertFleet .= "`fleet_end_galaxy` = '". intval($post['galaxy']) ."', ";
	$QryInsertFleet .= "`fleet_end_system` = '". intval($post['system']) ."', ";
	$QryInsertFleet .= "`fleet_end_planet` = '". intval($post['planet']) ."', ";
	$QryInsertFleet .= "`fleet_end_type` = '". intval($post['planettype']) ."', ";
	$QryInsertFleet .= "`fleet_target_owner` = '". $TargetRow['id_owner'] ."', ";
	$QryInsertFleet .= "`start_time` = '" . time() . "';";
	doquery( $QryInsertFleet, 'fleets');

	$UserDeuterium   -= $consumption;
	$QryUpdatePlanet  = "UPDATE {{table}} SET ";
	$QryUpdatePlanet .= $FleetSubQRY;
	$QryUpdatePlanet .= "`deuterium` = '".$UserDeuterium."' " ;
	$QryUpdatePlanet .= "WHERE ";
	$QryUpdatePlanet .= "`id` = '". $planetrow['id'] ."';";
	doquery( $QryUpdatePlanet, 'planets');

	$CurrentFlyingFleets++;

	$planetrow = doquery("SELECT * FROM {{table}} WHERE `id` = '". $user['current_planet'] ."';", 'planets', true);
	$ResultMessage  = "600;". $lang['gs_sending'] ." ". $FleetShipCount  ." ". $lang['tech'][$Ship] ." ". $lang['gs_to'] ." ". $post['galaxy'] .":". $post['system'] .":". $post['planet'] ."...|";
	$ResultMessage .= $CurrentFlyingFleets ." ".$UserSpyProbes." ".$UserRecycles." ".$UserMissiles;

	die ( $ResultMessage );
?>