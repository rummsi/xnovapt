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

	$dpath     = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];

	includeLang('fleet');

	$CurrentPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '". $user['current_planet'] ."'", 'planets', true);
	$TargetPlanet  = doquery("SELECT * FROM {{table}} WHERE `galaxy` = '". $post['galaxy'] ."' AND `system` = '". $post['system'] ."' AND `planet` = '". $post['planet'] ."' AND `planet_type` = '". $post['planettype'] ."';", 'planets', true);
	$MyDBRec       = doquery("SELECT * FROM {{table}} WHERE `id` = '". $user['id']."';", 'users', true);

	$protection      = $game_config['noobprotection'];
	$protectiontime  = $game_config['noobprotectiontime'];
	$protectionmulti = $game_config['noobprotectionmulti'];
	if ($protectiontime < 1) {
		$protectiontime = 9999999999999999;
	}

	$fleetarray  = unserialize(base64_decode(str_rot13($post["usedfleet"])));

	if (!is_array($fleetarray)) {
		message ("<font color=\"red\"><b>". $lang['fl_fleet_err'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	// On verifie s'il y a assez de vaisseaux sur la planete !
	foreach ($fleetarray as $Ship => $Count) {
		if ($Count > $CurrentPlanet[$resource[$Ship]]) {
			message ("<font color=\"red\"><b>". $lang['fl_fleet_err'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
	}

	$error              = 0;
	$galaxy             = intval($post['galaxy']);
	$system             = intval($post['system']);
	$planet             = intval($post['planet']);
    $planettype         = intval($post['planettype']);
    $fleetmission       = $post['mission'];

	if ($planettype != 1 && $planettype != 2 && $planettype != 3) {
		message ("<font color=\"red\"><b>". $lang['fl_fleet_err_pl'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	if ($fleetmission == 8) {
		$YourPlanet = false;
		$UsedPlanet = false;
		$select     = doquery("SELECT * FROM {{table}} WHERE galaxy = '". $galaxy ."' AND system = '". $system ."' AND planet = '". $planet ."'", "planets");
	} else {
		$YourPlanet = false;
		$UsedPlanet = false;
		$select     = doquery("SELECT * FROM {{table}} WHERE galaxy = '". $galaxy ."' AND system = '". $system ."' AND planet = '". $planet ."' AND planet_type = '". $planettype ."'", "planets");
	}

	if ($CurrentPlanet['galaxy'] == $galaxy &&
		$CurrentPlanet['system'] == $system &&
		$CurrentPlanet['planet'] == $planet &&
		$CurrentPlanet['planet_type'] == $planettype) {
		message ("<font color=\"red\"><b>". $lang['fl_ownpl_err'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	// Test d'existance de l'enregistrement dans la gaalxie !
	if ($post['mission'] != 15) {
		if (mysql_num_rows($select) < 1 && $fleetmission != 7) {
			message ("<font color=\"red\"><b>". $lang['fl_unknow_target'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		} elseif ($fleetmission == 9 && mysql_num_rows($select) < 1) {
			message ("<font color=\"red\"><b>". $lang['fl_used_target'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
	} else {
	    $EnvoiMaxExpedition = $post['maxepedition'];
	    $Expedition         = $post['curepedition'];

	    if       ($EnvoiMaxExpedition == 0 ) {
			message ("<font color=\"red\"><b>". $lang['fl_expe_notech'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		} elseif ($Expedition >= $EnvoiMaxExpedition ) {
			message ("<font color=\"red\"><b>". $lang['fl_expe_max'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
	}

	$select = mysql_fetch_array($select);

	if ($select['id_owner'] == $user['id']) {
		$YourPlanet = true;
		$UsedPlanet = true;
	} elseif (!empty($select['id_owner'])) {
		$YourPlanet = false;
		$UsedPlanet = true;
	} else {
		$YourPlanet = false;
		$UsedPlanet = false;
	}

	// Determinons les type de missions possibles par rapport a la planete cible
	if ($fleetmission == 15) {
		// Gestion des Exp�ditions
		$missiontype = array(15 => $lang['type_mission'][15]);
	} else {
		if ($post['planettype'] == "2") {
			if ($post['ship209'] >= 1) {
				$missiontype = array(8 => $lang['type_mission'][8]);
			} else {
				$missiontype = array();
			}
		} elseif ($post['planettype'] == "1" || $post['planettype'] == "3") {
			if ($post['ship208'] >= 1 && !$UsedPlanet) {
				$missiontype = array(7 => $lang['type_mission'][7]);
			} elseif ($post['ship210'] >= 1 && !$YourPlanet) {
				$missiontype = array(6 => $lang['type_mission'][6]);
			}

			if ($post['ship202'] >= 1 ||
				$post['ship203'] >= 1 ||
				$post['ship204'] >= 1 ||
				$post['ship205'] >= 1 ||
				$post['ship206'] >= 1 ||
				$post['ship207'] >= 1 ||
				$post['ship210'] >= 1 ||
				$post['ship211'] >= 1 ||
				$post['ship213'] >= 1 ||
				$post['ship214'] >= 1 ||
				$post['ship215'] >= 1 ||
				$post['ship216'] >= 1) {
				if (!$YourPlanet) {
					$missiontype[1] = $lang['type_mission'][1];
					$missiontype[5] = $lang['type_mission'][5];
				}
				$missiontype[3] = $lang['type_mission'][3];
			}


		} elseif ($post['ship209'] >= 1 || $post['ship208'] >= 1) {
			$missiontype[3] = $lang['type_mission'][3];
		}
		if ($YourPlanet)
			$missiontype[4] = $lang['type_mission'][4];

		if ( $post['planettype'] == 3 &&
			($post['ship214']         ||
			 $post['ship213'])        &&
			 !$YourPlanet              &&
			 $UsedPlanet) {
			$missiontype[2] = $lang['type_mission'][2];
		}
        if ($post['planettype'] == 3 &&
	       ($post['ship214'] >= 1 || $post['ship216'] >= 1) &&
           !$YourPlanet && $UsedPlanet) {
           $missiontype[9] = $lang['type_mission'][9];
        }
	}

	if (empty($missiontype[$fleetmission])) {
		message ("<font color=\"red\"><b>". $lang['fl_bad_mission'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	CheckPlanetUsedFields($CurrentPlanet);

	if ($TargetPlanet['id_owner'] == '') {
		$HeDBRec = $MyDBRec;
	} elseif ($TargetPlanet['id_owner'] != '') {
		$HeDBRec = doquery("SELECT * FROM {{table}} WHERE `id` = '". $TargetPlanet['id_owner'] ."';", 'users', true);
	}

	$UserPoints    = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $MyDBRec['id'] ."';", 'statpoints', true);
	$User2Points   = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $HeDBRec['id'] ."';", 'statpoints', true);

	$MyGameLevel  = $UserPoints['total_points'];
	$HeGameLevel  = $User2Points['total_points'];
	$VacationMode = $HeDBRec['urlaubs_modus'];

	if ($MyGameLevel > ($HeGameLevel * $protectionmulti) AND
		$TargetPlanet['id_owner'] != '' AND
		$post['mission']     == 1  AND
		$protection           == 1  AND
		$HeGameLevel < ($protectiontime * 1000)) {
		message("<font color=\"lime\"><b>".$lang['fl_noob_mess_n']."</b></font>", $lang['fl_noob_title'], "fleet." . PHPEXT, 2);
	}

	if ($MyGameLevel > ($HeGameLevel * $protectionmulti) AND
		$TargetPlanet['id_owner'] != '' AND
		$post['mission']     == 5  AND
		$protection           == 1  AND
		$HeGameLevel < ($protectiontime * 1000)) {
		message("<font color=\"lime\"><b>".$lang['fl_noob_mess_n']."</b></font>", $lang['fl_noob_title'], "fleet." . PHPEXT, 2);
	}

	if ($MyGameLevel > ($HeGameLevel * $protectionmulti) AND
		$TargetPlanet['id_owner'] != '' AND
		$post['mission']     == 6  AND
		$protection           == 1  AND
		$HeGameLevel < ($protectiontime * 1000)) {
		message("<font color=\"lime\"><b>".$lang['fl_noob_mess_n']."</b></font>", $lang['fl_noob_title'], "fleet." . PHPEXT, 2);
	}

	if (($MyGameLevel * $protectionmulti) < $HeGameLevel AND
		$TargetPlanet['id_owner'] != '' AND
		$post['mission']     == 1  AND
		$protection           == 1  AND
		$MyGameLevel < ($protectiontime * 1000)) {
		message("<font color=\"lime\"><b>".$lang['fl_noob_mess_n']."</b></font>", $lang['fl_noob_title'], "fleet." . PHPEXT, 2);
	}

	if (($MyGameLevel * $protectionmulti) < $HeGameLevel AND
		$TargetPlanet['id_owner'] != '' AND
		$post['mission']     == 5  AND
		$protection           == 1  AND
		$MyGameLevel < ($protectiontime * 1000)) {
		message("<font color=\"lime\"><b>".$lang['fl_noob_mess_n']."</b></font>", $lang['fl_noob_title'], "fleet." . PHPEXT, 2);
	}

	if (($MyGameLevel * $protectionmulti) < $HeGameLevel AND
		$TargetPlanet['id_owner'] != '' AND
		$post['mission']     == 6  AND
		$protection           == 1  AND
		$MyGameLevel < ($protectiontime * 1000)) {
		message("<font color=\"lime\"><b>".$lang['fl_noob_mess_n']."</b></font>", $lang['fl_noob_title'], "fleet." . PHPEXT, 2);
	}

	if ($VacationMode AND $post['mission'] != 8) {
		message("<font color=\"lime\"><b>".$lang['fl_vacation_pla']."</b></font>", $lang['fl_vacation_ttl'], "fleet." . PHPEXT, 2);
	}

	$FlyingFleets = mysql_fetch_assoc(doquery("SELECT COUNT(fleet_id) as Number FROM {{table}} WHERE `fleet_owner`='{$user['id']}'", 'fleets'));
	$ActualFleets = $FlyingFleets["Number"];
	if (($user[$resource[108]] + 1) <= $ActualFleets) {
		message("Pas de slot disponible", "Erreur", "fleet." . PHPEXT, 1);
	}

	if ($post['resource1'] + $post['resource2'] + $post['resource3'] < 1 AND $post['mission'] == 3) {
		message("<font color=\"lime\"><b>".$lang['fl_noenoughtgoods']."</b></font>", $lang['type_mission'][3], "fleet." . PHPEXT, 1);
	}
	if ($post['mission'] != 15) {
		if ($TargetPlanet['id_owner'] == '' AND $post['mission'] < 7) {
			message ("<font color=\"red\"><b>". $lang['fl_bad_planet01'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
		if ($TargetPlanet['id_owner'] != '' AND $post['mission'] == 7) {
			message ("<font color=\"red\"><b>". $lang['fl_bad_planet02'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
		if ($HeDBRec['ally_id'] != $MyDBRec['ally_id'] AND $post['mission'] == 4) {
			message ("<font color=\"red\"><b>". $lang['fl_dont_stay_here'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
		if ($TargetPlanet['ally_deposit'] < 1 AND $HeDBRec != $MyDBRec AND $post['mission'] == 5) {
			message ("<font color=\"red\"><b>". $lang['fl_no_allydeposit'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
		if (($TargetPlanet["id_owner"] == $CurrentPlanet["id_owner"]) AND ($post["mission"] == 1)) {
			message ("<font color=\"red\"><b>". $lang['fl_no_self_attack'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
		if (($TargetPlanet["id_owner"] == $CurrentPlanet["id_owner"]) AND ($post["mission"] == 6)) {
			message ("<font color=\"red\"><b>". $lang['fl_no_self_spy'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
		if (($TargetPlanet["id_owner"] != $CurrentPlanet["id_owner"]) AND ($post["mission"] == 4)) {
			message ("<font color=\"red\"><b>". $lang['fl_only_stay_at_home'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
		}
	}

	$missiontype = array(
		1 => $lang['type_mission'][1],
		2 => $lang['type_mission'][2],
		3 => $lang['type_mission'][3],
		4 => $lang['type_mission'][4],
		5 => $lang['type_mission'][5],
		6 => $lang['type_mission'][6],
		7 => $lang['type_mission'][7],
		8 => $lang['type_mission'][8],
		9 => $lang['type_mission'][9],
		15 => $lang['type_mission'][15],
		);

	$speed_possible = array(10, 9, 8, 7, 6, 5, 4, 3, 2, 1);

	$AllFleetSpeed  = GetFleetMaxSpeed ($fleetarray, 0, $user);
	$GenFleetSpeed  = $post['speed'];
	$SpeedFactor    = $post['speedfactor'];
	$MaxFleetSpeed  = min($AllFleetSpeed);

	if (!in_array($GenFleetSpeed, $speed_possible)) {
		message ("<font color=\"red\"><b>". $lang['fl_cheat_speed'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	$CurrentPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '".$user['current_planet']."';", 'planets', true);

	if ($MaxFleetSpeed != $post['speedallsmin']) {
		message ("<font color=\"red\"><b>". $lang['fl_cheat_speed'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	if (!$post['planettype']) {
		message ("<font color=\"red\"><b>". $lang['fl_no_planet_type'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	// Test de coherance de la destination (voir si elle se trouve dans les limites de l'univers connu
	$error     = 0;
	$errorlist = "";
	if (!$post['galaxy'] || !is_numeric($post['galaxy']) || $post['galaxy'] > MAX_GALAXY_IN_WORLD || $post['galaxy'] < 1) {
		$error++;
		$errorlist .= $lang['fl_limit_galaxy'];
	}
	if (!$post['system'] || !is_numeric($post['system']) || $post['system'] > MAX_SYSTEM_IN_GALAXY || $post['system'] < 1) {
		$error++;
		$errorlist .= $lang['fl_limit_system'];
	}
	if (!$post['planet'] || !is_numeric($post['planet']) || $post['planet'] > MAX_PLANET_IN_SYSTEM+1 || $post['planet'] < 1) {
		$error++;
		$errorlist .= $lang['fl_limit_planet'];
	}

	if ($error > 0) {
		message ("<font color=\"red\"><ul>" . $errorlist . "</ul></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	// La flotte part bien de la planete courrante ??
	if ($post['thisgalaxy'] != $CurrentPlanet['galaxy'] |
		$post['thissystem'] != $CurrentPlanet['system'] |
		$post['thisplanet'] != $CurrentPlanet['planet'] |
		$post['thisplanettype'] != $CurrentPlanet['planet_type']) {
		message ("<font color=\"red\"><b>". $lang['fl_cheat_origine'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	if (!isset($fleetarray)) {
		message ("<font color=\"red\"><b>". $lang['fl_no_fleetarray'] ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	$distance      = GetTargetDistance ( $post['thisgalaxy'], $post['galaxy'], $post['thissystem'], $post['system'], $post['thisplanet'], $post['planet'] );
	$duration      = GetMissionDuration ( $GenFleetSpeed, $MaxFleetSpeed, $distance, $SpeedFactor );
	$consumption   = GetFleetConsumption ( $fleetarray, $SpeedFactor, $duration, $distance, $MaxFleetSpeed, $user );

	$fleet['start_time'] = $duration + time();
	if ($post['mission'] == 15) {
		$StayDuration    = $post['expeditiontime'] * 3600;
		$StayTime        = $fleet['start_time'] + $post['expeditiontime'] * 3600;
	} elseif ($post['mission'] == 5) {
		$StayDuration    = $post['holdingtime'] * 3600;
		$StayTime        = $fleet['start_time'] + $post['holdingtime'] * 3600;
	} else {
		$StayDuration    = 0;
		$StayTime        = 0;
	}
	$fleet['end_time']   = $StayDuration + (2 * $duration) + time();
	$FleetStorage        = 0;
	$FleetShipCount      = 0;
	$fleet_array         = "";
	$FleetSubQRY         = "";

	foreach ($fleetarray as $Ship => $Count) {
		$FleetStorage    += $pricelist[$Ship]["capacity"] * $Count;
		$FleetShipCount  += $Count;
		$fleet_array     .= $Ship .",". $Count .";";
		$FleetSubQRY     .= "`".$resource[$Ship] . "` = `" . $resource[$Ship] . "` - " . $Count . " , ";
	}

	$FleetStorage        -= $consumption;
	$StorageNeeded        = 0;
	if ($post['resource1'] < 1) {
		$TransMetal      = 0;
	} else {
		$TransMetal      = $post['resource1'];
		$StorageNeeded  += $TransMetal;
	}
	if ($post['resource2'] < 1) {
		$TransCrystal    = 0;
	} else {
		$TransCrystal    = $post['resource2'];
		$StorageNeeded  += $TransCrystal;
	}
	if ($post['resource3'] < 1) {
		$TransDeuterium  = 0;
	} else {
		$TransDeuterium  = $post['resource3'];
		$StorageNeeded  += $TransDeuterium;
	}

	$StockMetal      = $CurrentPlanet['metal'];
	$StockCrystal    = $CurrentPlanet['crystal'];
	$StockDeuterium  = $CurrentPlanet['deuterium'];
	$StockDeuterium -= $consumption;

	$StockOk         = false;
	if ($StockMetal >= $TransMetal) {
		if ($StockCrystal >= $TransCrystal) {
			if ($StockDeuterium >= $TransDeuterium) {
				$StockOk         = true;
			}
		}
	}
	if ( !$StockOk ) {
		message ("<font color=\"red\"><b>". $lang['fl_noressources'] . pretty_number($consumption) ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	if ( $StorageNeeded > $FleetStorage) {
		message ("<font color=\"red\"><b>". $lang['fl_nostoragespa'] . pretty_number($StorageNeeded - $FleetStorage) ."</b></font>", $lang['fl_error'], "fleet." . PHPEXT, 2);
	}

	if ($TargetPlanet['id_level'] > $user['authlevel']) {
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
			message ("<font color=\"red\"><b>". $lang['fl_adm_attak'] ."</b></font>", $lang['fl_warning'], "fleet." . PHPEXT, 2);
		}
	}

	// ecriture de l'enregistrement de flotte (a partir de l�, y a quelque chose qui vole et c'est toujours sur la planete d'origine)
	$QryInsertFleet  = "INSERT INTO {{table}} SET ";
	$QryInsertFleet .= "`fleet_owner` = '". $user['id'] ."', ";
	$QryInsertFleet .= "`fleet_mission` = '". $post['mission'] ."', ";
	$QryInsertFleet .= "`fleet_amount` = '". $FleetShipCount ."', ";
	$QryInsertFleet .= "`fleet_array` = '". $fleet_array ."', ";
	$QryInsertFleet .= "`fleet_start_time` = '". $fleet['start_time'] ."', ";
	$QryInsertFleet .= "`fleet_start_galaxy` = '". intval($post['thisgalaxy']) ."', ";
	$QryInsertFleet .= "`fleet_start_system` = '". intval($post['thissystem']) ."', ";
	$QryInsertFleet .= "`fleet_start_planet` = '". intval($post['thisplanet']) ."', ";
	$QryInsertFleet .= "`fleet_start_type` = '". intval($post['thisplanettype']) ."', ";
	$QryInsertFleet .= "`fleet_end_time` = '". $fleet['end_time'] ."', ";
	$QryInsertFleet .= "`fleet_end_stay` = '". $StayTime ."', ";
	$QryInsertFleet .= "`fleet_end_galaxy` = '". intval($post['galaxy']) ."', ";
	$QryInsertFleet .= "`fleet_end_system` = '". intval($post['system']) ."', ";
	$QryInsertFleet .= "`fleet_end_planet` = '". intval($post['planet']) ."', ";
	$QryInsertFleet .= "`fleet_end_type` = '". intval($post['planettype']) ."', ";
	$QryInsertFleet .= "`fleet_resource_metal` = '". intval($TransMetal) ."', ";
	$QryInsertFleet .= "`fleet_resource_crystal` = '". intval($TransCrystal) ."', ";
	$QryInsertFleet .= "`fleet_resource_deuterium` = '". intval($TransDeuterium) ."', ";
	$QryInsertFleet .= "`fleet_target_owner` = '". $TargetPlanet['id_owner'] ."', ";
	$QryInsertFleet .= "`start_time` = '". time() ."';";
	doquery( $QryInsertFleet, 'fleets');


	$CurrentPlanet["metal"]     = $CurrentPlanet["metal"] - $TransMetal;
	$CurrentPlanet["crystal"]   = $CurrentPlanet["crystal"] - $TransCrystal;
	$CurrentPlanet["deuterium"] = $CurrentPlanet["deuterium"] - $TransDeuterium;
	$CurrentPlanet["deuterium"] = $CurrentPlanet["deuterium"] - $consumption;

	$QryUpdatePlanet  = "UPDATE {{table}} SET ";
	$QryUpdatePlanet .= $FleetSubQRY;
	$QryUpdatePlanet .= "`metal` = '". $CurrentPlanet["metal"] ."', ";
	$QryUpdatePlanet .= "`crystal` = '". $CurrentPlanet["crystal"] ."', ";
	$QryUpdatePlanet .= "`deuterium` = '". $CurrentPlanet["deuterium"] ."' ";
	$QryUpdatePlanet .= "WHERE ";
	$QryUpdatePlanet .= "`id` = '". $CurrentPlanet['id'] ."'";

	// Mise a jours de l'enregistrement de la planete de depart (a partir de là, y a quelque chose qui vole et ce n'est plus sur la planete de depart)
	doquery("LOCK TABLE {{table}} WRITE", 'planets');
	doquery ($QryUpdatePlanet, "planets");
	doquery("UNLOCK TABLES", '');
//	doquery("FLUSH TABLES", '');

	// Un peu de blabla pour l'utilisateur, affichage d'un joli tableau de la flotte expedi�e
	$page  = "<br><div><center>";
	$page .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"519\">";
	$page .= "<tr height=\"20\">";
	$page .= "<td class=\"c\" colspan=\"2\"><span class=\"success\">". $lang['fl_fleet_send'] ."</span></td>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_mission'] ."</th>";
	$page .= "<th>". $missiontype[$post['mission']] ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_dist'] ."</th>";
	$page .= "<th>". pretty_number($distance) ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_speed'] ."</th>";
	$page .= "<th>". pretty_number($post['speedallsmin']) ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_deute_need'] ."</th>";
	$page .= "<th>". pretty_number($consumption) ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_from'] ."</th>";
	$page .= "<th>". $post['thisgalaxy'] .":". $post['thissystem']. ":". $post['thisplanet'] ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_dest'] ."</th>";
	$page .= "<th>". $post['galaxy'] .":". $post['system'] .":". $post['planet'] ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_time_go'] ."</th>";
	$page .= "<th>". date("M D d H:i:s", $fleet['start_time']) ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<th>". $lang['fl_time_back'] ."</th>";
	$page .= "<th>". date("M D d H:i:s", $fleet['end_time']) ."</th>";
	$page .= "</tr><tr height=\"20\">";
	$page .= "<td class=\"c\" colspan=\"2\">". $lang['fl_title'] ."</td>";

	foreach ($fleetarray as $Ship => $Count) {
		$page .= "</tr><tr height=\"20\">";
		$page .= "<th>". $lang['tech'][$Ship] ."</th>";
		$page .= "<th>". pretty_number($Count) ."</th>";
	}
	$page .= "</tr></table></div></center>";

	// Provisoire
	sleep (1);

	$planetrow = doquery ("SELECT * FROM {{table}} WHERE `id` = '". $CurrentPlanet['id'] ."';", 'planets', true);

	display($page, $lang['fl_title']);

// Updated by Chlorel. 16 Jan 2008 (String extraction, bug corrections, code uniformisation
// Updated by -= MoF =- for Deutsches Ugamela Forum
// 06.12.2007 - 08:39
// Open Source
// (c) by MoF

?>