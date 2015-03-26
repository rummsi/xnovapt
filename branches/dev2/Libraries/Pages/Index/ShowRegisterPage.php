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
 * @ShowRegisterPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  2/Dez/2014 21:30:59
 */

/**
 * Description of ShowRegisterPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowRegisterPage extends AbstractIndexPage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'register';
    }

    function show() {
        global $lang, $game_config, $newpos_checked, $Time;

        //on demarre la session qui ne sers ici que pour le code de secu
        includeLang('reg');
        if (filter_input_array(INPUT_POST)) {
            $errors = 0;
            $errorlist = "";

            //si la secu est active
            if ($game_config['secu'] == 1) {
                echo $_SESSION['secu'];
                if (!filter_input(INPUT_POST, 'secu') || filter_input(INPUT_POST, 'secu') != $_SESSION['secu']) {
                    $errorlist .= $lang['error_secu'];
                    $errors++;
                }
            }

            $post['email'] = strip_tags(filter_input(INPUT_POST, 'email'));
            if (!is_email($post['email'])) {
                $errorlist .= "\"" . $post['email'] . "\" " . $lang['error_mail'];
                $errors++;
            }
            if (!filter_input(INPUT_POST, 'planet')) {
                $errorlist .= $lang['error_planet'];
                $errors++;
            }
            if (preg_match("/[^A-z0-9_\-]/", filter_input(INPUT_POST, 'hplanet')) == 1) {
                $errorlist .= $lang['error_planetnum'];
                $errors++;
            }
            if (!filter_input(INPUT_POST, 'character')) {
                $errorlist .= $lang['error_character'];
                $errors++;
            }
            if (strlen(filter_input(INPUT_POST, 'passwrd')) < 4) {
                $errorlist .= $lang['error_password'];
                $errors++;
            }
            if (preg_match("/[^A-z0-9_\-]/", filter_input(INPUT_POST, 'character')) == 1) {
                $errorlist .= $lang['error_charalpha'];
                $errors++;
            }
            if (filter_input(INPUT_POST, 'rgt') != 'on') {
                $errorlist .= $lang['error_rgt'];
                $errors++;
            }
            // Le meilleur moyen de voir si un nom d'utilisateur est pris c'est d'essayer de l'appeler !!
            $ExistUser = doquery("SELECT `username` FROM {{table}} WHERE `username` = '" . mysqli_real_escape_string(Database::$dbHandle, filter_input(INPUT_POST, 'character')) . "' LIMIT 1;", 'users', true);
            if ($ExistUser) {
                $errorlist .= $lang['error_userexist'];
                $errors++;
            }
            // Si l'on verifiait que l'adresse email n'existe pas encore ???
            $ExistMail = doquery("SELECT `email` FROM {{table}} WHERE `email` = '" . mysqli_real_escape_string(Database::$dbHandle, filter_input(INPUT_POST, 'email')) . "' LIMIT 1;", 'users', true);
            if ($ExistMail) {
                $errorlist .= $lang['error_emailexist'];
                $errors++;
            }
            if (filter_input(INPUT_POST, 'sex') != '' && filter_input(INPUT_POST, 'sex') != 'F' && filter_input(INPUT_POST, 'sex') != 'M') {
                $errorlist .= $lang['error_sex'];
                $errors++;
            }
            if ($errors != 0) {
                ShowErrorPage::message($errorlist, $lang['Register']);
            } else {
                $newpass = filter_input(INPUT_POST, 'passwrd');
                $UserName = CheckInputStrings(filter_input(INPUT_POST, 'character'));
                $UserEmail = CheckInputStrings(filter_input(INPUT_POST, 'email'));
                $UserPlanet = CheckInputStrings(addslashes(filter_input(INPUT_POST, 'planet')));
                $md5newpass = md5($newpass);
                // Creation de l'utilisateur
                $QryInsertUser = "INSERT INTO {{table}} SET ";
                $QryInsertUser .= "`username` = '" . mysqli_real_escape_string(Database::$dbHandle, strip_tags($UserName)) . "', ";
                $QryInsertUser .= "`email` = '" . mysqli_real_escape_string(Database::$dbHandle, $UserEmail) . "', ";
                $QryInsertUser .= "`email_2` = '" . mysqli_real_escape_string(Database::$dbHandle, $UserEmail) . "', ";
                $QryInsertUser .= "`sex` = '" . mysqli_real_escape_string(Database::$dbHandle, filter_input(INPUT_POST, 'sex')) . "', ";
                $QryInsertUser .= "`ip_at_reg` = '" . filter_input(INPUT_SERVER, 'REMOTE_ADDR') . "', ";
                $QryInsertUser .= "`id_planet` = '0', ";
                $QryInsertUser .= "`register_time` = '" . time() . "', ";
                $QryInsertUser .= "`password`='" . $md5newpass . "';";
                doquery($QryInsertUser, 'users');
                // On cherche le numero d'enregistrement de l'utilisateur fraichement cree
                $NewUser = doquery("SELECT `id` FROM {{table}} WHERE `username` = '" . mysqli_real_escape_string(Database::$dbHandle, filter_input(INPUT_POST, 'character')) . "' LIMIT 1;", 'users', true);
                $iduser = $NewUser['id'];
                // Recherche d'une place libre !
                $LastSettedGalaxyPos = $game_config['LastSettedGalaxyPos'];
                $LastSettedSystemPos = $game_config['LastSettedSystemPos'];
                $LastSettedPlanetPos = $game_config['LastSettedPlanetPos'];
                while (!isset($newpos_checked)) {
                    for ($Galaxy = $LastSettedGalaxyPos; $Galaxy <= MAX_GALAXY_IN_WORLD; $Galaxy++) {
                        for ($System = $LastSettedSystemPos; $System <= MAX_SYSTEM_IN_GALAXY; $System++) {
                            for ($Posit = $LastSettedPlanetPos; $Posit <= 4; $Posit++) {
                                $Planet = round(rand(4, 12));
                                switch ($LastSettedPlanetPos) {
                                    case 1:
                                        $LastSettedPlanetPos += 1;
                                        break;
                                    case 2:
                                        $LastSettedPlanetPos += 1;
                                        break;
                                    case 3:
                                        if ($LastSettedSystemPos == MAX_SYSTEM_IN_GALAXY) {
                                            $LastSettedGalaxyPos += 1;
                                            $LastSettedSystemPos = 1;
                                            $LastSettedPlanetPos = 1;
                                            break;
                                        } else {
                                            $LastSettedPlanetPos = 1;
                                        }
                                        $LastSettedSystemPos += 1;
                                        break;
                                }
                                break;
                            }
                            break;
                        }
                        break;
                    }
                    $QrySelectGalaxy = "SELECT * ";
                    $QrySelectGalaxy .= "FROM {{table}} ";
                    $QrySelectGalaxy .= "WHERE ";
                    $QrySelectGalaxy .= "`galaxy` = '" . $Galaxy . "' AND ";
                    $QrySelectGalaxy .= "`system` = '" . $System . "' AND ";
                    $QrySelectGalaxy .= "`planet` = '" . $Planet . "' ";
                    $QrySelectGalaxy .= "LIMIT 1;";
                    $GalaxyRow = doquery($QrySelectGalaxy, 'galaxy', true);
                    if ($GalaxyRow["id_planet"] == "0") {
                        $newpos_checked = true;
                    }
                    if (!$GalaxyRow) {
                        CreateOnePlanetRecord($Galaxy, $System, $Planet, $NewUser['id'], $UserPlanet, true);
                        $newpos_checked = true;
                    }
                    if ($newpos_checked) {
                        doquery("UPDATE {{table}} SET `config_value` = '" . $LastSettedGalaxyPos . "' WHERE `config_name` = 'LastSettedGalaxyPos';", 'config');
                        doquery("UPDATE {{table}} SET `config_value` = '" . $LastSettedSystemPos . "' WHERE `config_name` = 'LastSettedSystemPos';", 'config');
                        doquery("UPDATE {{table}} SET `config_value` = '" . $LastSettedPlanetPos . "' WHERE `config_name` = 'LastSettedPlanetPos';", 'config');
                    }
                }
                // Recherche de la reference de la nouvelle planete (qui est unique normalement !
                $PlanetID = doquery("SELECT `id` FROM {{table}} WHERE `id_owner` = '" . $NewUser['id'] . "' LIMIT 1;", 'planets', true);
                // Mise a jour de l'enregistrement utilisateur avec les infos de sa planete mere
                $QryUpdateUser = "UPDATE {{table}} SET ";
                $QryUpdateUser .= "`id_planet` = '" . $PlanetID['id'] . "', ";
                $QryUpdateUser .= "`current_planet` = '" . $PlanetID['id'] . "', ";
                $QryUpdateUser .= "`galaxy` = '" . $Galaxy . "', ";
                $QryUpdateUser .= "`system` = '" . $System . "', ";
                $QryUpdateUser .= "`planet` = '" . $Planet . "' ";
                $QryUpdateUser .= "WHERE ";
                $QryUpdateUser .= "`id` = '" . $NewUser['id'] . "' ";
                $QryUpdateUser .= "LIMIT 1;";
                doquery($QryUpdateUser, 'users');
                // Envois d'un message in-game sympa ^^
                $from = $lang['sender_message_ig'];
                $sender = "Admin";
                $Subject = $lang['subject_message_ig'];
                $message = $lang['text_message_ig'];
                SendSimpleMessage($iduser, $sender, $Time, 1, $from, $Subject, $message);
                // Mise a jour du nombre de joueurs inscripts
                doquery("UPDATE {{table}} SET `config_value` = `config_value` + '1' WHERE `config_name` = 'users_amount' LIMIT 1;", 'config');
                $Message = $lang['thanksforregistry'];
                if ($this->sendpassemail(filter_input(INPUT_POST, 'email'), "$newpass")) {
                    $Message .= " (" . htmlentities(filter_input(INPUT_POST, 'email')) . ")";
                } else {
                    $Message .= " (" . htmlentities(filter_input(INPUT_POST, 'email')) . ")";
                    $Message .= "<br><br>" . $lang['error_mailsend'] . " <b>" . $newpass . "</b>";
                }
                message($Message, $lang['reg_welldone']);
            }
        } elseif ($game_config['secu'] == 1) {

            $_SESSION['nombre1'] = rand(0, 50);
            $_SESSION['nombre2'] = rand(0, 50);
            $_SESSION['secu'] = $_SESSION['nombre1'] + $_SESSION['nombre2'];

            $this->tplObj->assign(array(
                'code_secu' => "<th>" . $lang['code_secu'] . ": </th>",
                'affiche' => $_SESSION['nombre1'] . " + " . $_SESSION['nombre2'] . " = <input name='secu' size='3' maxlength='3' type='text'>",
            ));
        } else {

            // Afficher le formulaire d'enregistrement
            $this->tplObj->assign(array(
                'code_secu' => "",
                'affiche' => "",
            ));
        }

        $this->tplObj->assign(array(
            'title' => $lang['registry'],
            'lang' => $lang,
            'form' => $lang['form'],
            'GameName' => $lang['GameName'],
            'neededpass' => $lang['neededpass'],
            'EMail' => $lang['E-Mail'],
            'MainPlanet' => $lang['MainPlanet'],
            'Sex' => $lang['Sex'],
            'Undefined' => $lang['Undefined'],
            'Male' => $lang['Male'],
            'Female' => $lang['Female'],
            'accept' => $lang['accept'],
            'signup' => $lang['signup'],
            'servername' => '<img src="images/xnova.png" align="top" border="0" >',
        ));

        $this->render('default.register.tpl');
    }

    function sendpassemail($emailaddress, $password) {
        global $lang;

        $parse['gameurl'] = GAMEURL;
        $parse['password'] = $password;
        $email = parsetemplate($lang['mail_welcome'], $parse);
        $status = $this->mymail($emailaddress, $lang['mail_title'], $email);
        return $status;
    }

    function mymail($to, $title, $body, $from = '') {
        global $org, $body;
        $from = trim($from);
        if (!$from) {
            $from = ADMINEMAIL;
        }
        $rp = ADMINEMAIL;
        $head = '';
        $head .= "Content-Type: text/plain \r\n";
        $head .= "Date: " . date('r') . " \r\n";
        $head .= "Return-Path: $rp \r\n";
        $head .= "From: $from \r\n";
        $head .= "Sender: $from \r\n";
        $head .= "Reply-To: $from \r\n";
        $head .= "Organization: $org \r\n";
        $head .= "X-Sender: $from \r\n";
        $head .= "X-Priority: 3 \r\n";
        $body = str_replace("\r\n", "\n", $body);
        $body = str_replace("\n", "\r\n", $body);
        return mail($to, $title, $body, $head);
    }

}
