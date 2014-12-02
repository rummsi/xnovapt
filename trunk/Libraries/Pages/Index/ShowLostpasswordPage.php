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
 * @ShowLostpasswordPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  2/Dez/2014 22:40:51
 */

/**
 * Description of ShowLostpasswordPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowLostpasswordPage extends AbstractIndexPage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'lostpass';
    }

    function show() {
        global $lang, $game_config;

        includeLang('lostpassword');
        $mailData = array(
            'recipient' => NULL,
            'sender' => 'no-reply',
            'subject' => 'XNova:Legacies - Changement de mot de passe'
        );
        $username = NULL;
        if (filter_input_array(INPUT_POST)) {
            if (filter_input(INPUT_POST, 'pseudo') !== FALSE && filter_input(INPUT_POST, 'pseudo')) {
                $username = mysql_real_escape_string(filter_input(INPUT_POST, 'pseudo'));
                $sql = <<<EOF
                    SELECT users.email, users.username
                      FROM {{table}} AS users
                      WHERE users.username="{$username}"
                      LIMIT 1
EOF;
                if (!($result = doquery($sql, 'users', true))) {
                    ShowErrorPage::message("Cet utilisateur n'existe pas");
                    die();
                }
                list($mailData['recipient'], $username) = $result;
            } else if (filter_input(INPUT_POST, 'email') && filter_input(INPUT_POST, 'email') !== FALSE) {
                $email = mysql_real_escape_string(filter_input(INPUT_POST, 'email'));
                $sql = <<<EOF
                    SELECT users.email, users.username
                      FROM {{table}} AS users
                      WHERE users.email="{$email}"
                      LIMIT 1
EOF;
                if (!($result = doquery($sql, 'users', true))) {
                    ShowErrorPage::message("Cet email n'est utilisé par aucun joueur");
                    die();
                }
                list($mailData['recipient'], $username) = $result;
            } else {
                ShowErrorPage::message("Veuillez entrer votre login ou votre email.");
                die();
            }
            if (!is_null($mailData['recipient'])) {
                $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $randomPass = '';
                $size = rand(8, 10);
                for ($i = 0; $i < $size; $i++) {
                    $randomPass .= $characters[rand(0, strlen($characters) - 1)];
                }
                $message = <<<EOF
                    Votre mot de passe a été modifié, veuillez trouver ci-dessous vos informations de connexion :
                    login : $username
                    mot de passe : $randomPass

                    A bientôt sur XNova:Legacies
EOF;
                $version = VERSION;
                $headers = <<<EOF
                    From: {$mailData['sender']}
                    X-Sender: Legacies/{$version}
EOF;
                mail($mailData['recipient'], $mailData['subject'], $message, $headers);
                $sql = <<<EOF
                    UPDATE {{table}} AS users
                      SET users.password="{$randomPass}"
                      WHERE users.username="$username"
EOF;
                doquery($sql, 'users');
                $this->tplObj->assign('Nouveau mot de passe');
                ShowErrorPage::message('Mot de passe envoyé ! Veuillez regarder votre boite e-mail ou dans vos spam.');
                die();
            }
        }

        $this->tplObj->assign(array(
            'title' => $lang['ResetPass'],
            'lang' => $lang,
            'servername' => $game_config['game_name'],
        ));

        $this->render('default.lostpassword.tpl');
    }

}
