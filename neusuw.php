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

includeLang('usuw');

$lang['PHP_SELF'] = 'neusuw.php';

if($post && $mode == "change"){ //Array ( [db_character]

	$iduser = $user["id"];
	$avatar = $post["avatar"];
	$dpath = $post["dpath"];
	//Mostrar skin
	if(isset($post["design"])&& $post["design"] == 'on'){
		$design = "1";
	}else{
		$design = "0";
	}
	//Desactivar comprobaci? de IP
	if(isset($post["noipcheck"])&& $post["noipcheck"] == 'on'){
		$noipcheck = "1";
	}else{
		$noipcheck = "0";
	}
	//Nombre de usuario
	if(isset($post["db_character"])&& $post["db_character"] != ''){
		$username = $post['db_character'];
	}else{
		$username = $user['username'];
	}
	//Cantidad de sondas de espionaje
	if(isset($post["spio_anz"])&&is_numeric($post["spio_anz"])){
		$spio_anz = $post["spio_anz"];
	}else{
		$spio_anz = "1";
	}
	//Mostrar tooltip durante
	if(isset($post["settings_tooltiptime"]) && is_numeric($post["settings_tooltiptime"])){
		$settings_tooltiptime = $post["settings_tooltiptime"];
	}else{
		$settings_tooltiptime = "1";
	}
	//Maximo mensajes de flotas
	if(isset($post["settings_fleetactions"]) && is_numeric($post["settings_fleetactions"])){
		$settings_fleetactions = $post["settings_fleetactions"];
	}else{
		$settings_fleetactions = "1";
	}//
	//Mostrar logos de los aliados
	if(isset($post["settings_allylogo"]) && $post["settings_allylogo"] == 'on'){
		$settings_allylogo = "1";
	}else{
		$settings_allylogo = "0";
	}
	//Espionaje
	if(isset($post["settings_esp"]) && $post["settings_esp"] == 'on'){
		$settings_esp = "1";
	}else{
		$settings_esp = "0";
	}
	//Escribir mensaje
	if(isset($post["settings_wri"]) && $post["settings_wri"] == 'on'){
		$settings_wri = "1";
	}else{
		$settings_wri = "0";
	}
	//A?dir a lista de amigos
	if(isset($post["settings_bud"]) && $post["settings_bud"] == 'on'){
		$settings_bud = "1";
	}else{
		$settings_bud = "0";
	}
	//Ataque con misiles
	if(isset($post["settings_mis"]) && $post["settings_mis"] == 'on'){
		$settings_mis = "1";
	}else{
		$settings_mis = "0";
	}
	//Ver reporte
	if(isset($post["settings_rep"]) && $post["settings_rep"] == 'on'){
		$settings_rep = "1";
	}else{
		$settings_rep = "0";
	}
	//Modo vacaciones
	if(isset($post["urlaubs_modus"]) && $post["urlaubs_modus"] == 'on'){
		$urlaubs_modus = "1";
	}else{
		$urlaubs_modus = "0";
	}
	//Borrar cuenta
	if(isset($post["db_deaktjava"]) && $post["db_deaktjava"] == 'on'){
		$db_deaktjava = "1";
	}else{
		$db_deaktjava = "0";
	}
	doquery("UPDATE {{table}} SET
	`email` = '$db_email',
	`avatar` = '$avatar',
	`dpath` = '$dpath',
	`design` = '$design',
	`noipcheck` = '$noipcheck',
	`spio_anz` = '$spio_anz',
	`settings_tooltiptime` = '$settings_tooltiptime',
	`settings_fleetactions` = '$settings_fleetactions',
	`settings_allylogo` = '$settings_allylogo',
	`settings_esp` = '$settings_esp',
	`settings_wri` = '$settings_wri',
	`settings_bud` = '$settings_bud',
	`settings_mis` = '$settings_mis',
	`settings_rep` = '$settings_rep',
	`urlaubs_modus` = '$urlaubs_modus',
	`db_deaktjava` = '$db_deaktjava',
	`kolorminus` = '$kolorminus',
	`kolorplus` = '$kolorplus',
	`kolorpoziom` = '$kolorpoziom'
	WHERE `id` = '$iduser' LIMIT 1","users");


	if(isset($post["db_password"]) && md5($post["db_password"]) == $user["password"]){

		if($post["newpass1"] == $post["newpass2"]){
			$newpass = md5($post["newpass1"]);
			doquery("UPDATE {{table}} SET `password` = '{$newpass}' WHERE `id` = '{$user['id']}' LIMIT 1","users");
			setcookie(COOKIE_NAME, "", time()-100000, "/", "", 0);//le da el expire
			message($lang['succeful_changepass'],$lang['changue_pass']);
		}

	}
	if($user['username']!=$post["db_character"]){

		$query = doquery("SELECT id FROM {{table}} WHERE username='{$post["db_character"]}'",'users',true);
		if(!$query){
			doquery("UPDATE {{table}} SET username='{$username}' WHERE id='{$user['id']}' LIMIT 1","users");
			setcookie(COOKIE_NAME, "", time()-100000, "/", "", 0);//le da el expire
			message($lang['succeful_changename'],$lang['changue_name']);
		}
	}
	message($lang['succeful_save'],$lang['Options']);
}
else
{

	$parse = $lang;

	$parse['dpath'] = $dpath;
	$parse['user_username'] = $user['username'];
	$parse['user_email'] = $user['email'];
	$parse['user_email_2'] = $user['email_2'];
	$parse['user_dpath'] = $user['dpath'];
	$parse['user_avatar'] = $user['avatar'];
	$parse['user_spio_anz'] = $user['spio_anz'];
	$parse['user_settings_tooltiptime'] = $user['settings_tooltiptime'];
	$parse['user_settings_fleetactions'] = $user['settings_fleetactions'];
	$parse['user_design'] = ($user['design'] == 1) ? " checked='checked'":'';
	$parse['user_noipcheck'] = ($user['noipcheck'] == 1) ? " checked='checked'":'';
	$parse['user_settings_allylogo'] = ($user['settings_allylogo'] == 1) ? " checked='checked'/":'';
	$parse['user_db_deaktjava'] = ($user['db_deaktjava'] == 1) ? " checked='checked'/":'';
	$parse['user_urlaubs_modus'] = ($user['urlaubs_modus'] == 1)?" checked='checked'/":'';
	$parse['user_settings_rep'] = ($user['settings_rep'] == 1) ? " checked='checked'/":'';
	$parse['user_settings_esp'] = ($user['settings_esp'] == 1) ? " checked='checked'/":'';
	$parse['user_settings_wri'] = ($user['settings_wri'] == 1) ? " checked='checked'/":'';
	$parse['user_settings_mis'] = ($user['settings_mis'] == 1) ? " checked='checked'/":'';
	$parse['user_settings_bud'] = ($user['settings_bud'] == 1) ? " checked='checked'/":'';
	$parse['kolorminus'] = $user['kolorminus'];
	$parse['kolorplus'] = $user['kolorplus'];
	$parse['kolorpoziom'] = $user['kolorpoziom'];
	$page .= parsetemplate(gettemplate('usuw_body'), $parse);

	display($page,$lang['Usuw']);

	die();
}

// Created by Perberos. All rights reversed (C) 2006
?>