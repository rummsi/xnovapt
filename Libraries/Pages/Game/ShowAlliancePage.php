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
 * @ShowAlliancePage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 17:28:42
 */

/**
 * Description of ShowAlliancePage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowAlliancePage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'alliance';


        includeLang('alliance');
        includeLang('leftmenu');
    }

    function show() {
        global $user;

        if (empty($user['id'])) {
            echo '<script language="javascript">';
            echo 'parent.location="../";';
            echo '</script>';
        }
        if ($user['ally_id'] == 0) {
            $this->no_ally();
        } elseif ($user['ally_id'] != 0 && $user['ally_request'] == 0) {
            $this->ally();
        }
    }

    function no_ally() {
        global $user, $lang, $ally_tag;
        if ($user['ally_id'] == 0) { // Sin alianza
            if ($user['ally_request'] != 0) { // Esperando una respuesta
                // preguntamos por el ally_tag
                $allyquery = doquery("SELECT ally_tag FROM {{table}} WHERE id='" . intval($user['ally_request']) . "' ORDER BY `id`", "alliance", true);
                extract($allyquery);

                if (filter_input(INPUT_POST, 'bcancel')) {
                    doquery("UPDATE {{table}} SET `ally_request`=0 WHERE `id`=" . $user['id'], "users");
                    $this->tplObj->assign(array(
                        'title' => $lang['alliance'],
                        'request_text' => str_replace('%s', $ally_tag, $lang['Canceled_a_request_text']),
                        'button_text' => $lang['Ok'],
                    ));

                    $this->render('alliance.apply_waitform.tpl');
                } else {

                    $this->tplObj->assign(array(
                        'title' => $lang['alliance'],
                        'request_text' => str_replace('%s', $ally_tag, $lang['Waiting_a_request_text']),
                        'button_text' => $lang['Delete_apply'],
                    ));

                    $this->render('alliance.apply_waitform.tpl');
                }
            } else {

                $this->tplObj->assign('title', $lang['alliance']);

                $this->render('alliance.default.tpl');
            }
        }
    }

    function make() {
        global $user, $lang;

        $mode = HTTP::_GP('mode', 'make');
        $yes = HTTP::_GP('yes', '');
        if ($user['ally_id'] == 0) {
            if ($mode == 'make' && $user['ally_request'] == 0) { // Make alliance
                /*
                  Aca se crean las alianzas...
                 */
                if ($yes == 1 && $_POST) {
                    /*
                      Por el momento solo estoy improvisando, luego se perfeccionara el sistema :)
                      Creo que aqui se realiza una query para comprovar el nombre, y luego le pregunta si es el tag correcto...
                     */
                    if (!$_POST['atag']) {
                        ShowErrorPage::message($lang['have_not_tag'], $lang['make_alliance']);
                    }
                    if (!$_POST['aname']) {
                        ShowErrorPage::message($lang['have_not_name'], $lang['make_alliance']);
                    }
                    $_POST['aname'] = addslashes($_POST['aname']);
                    $_POST['atag'] = addslashes($_POST['atag']);
                    $tagquery = doquery("SELECT * FROM {{table}} WHERE ally_tag='{$_POST['atag']}'", 'alliance', true);
                    if ($tagquery) {
                        ShowErrorPage::message(str_replace('%s', $_POST['atag'], $lang['always_exist']), $lang['make_alliance']);
                    }
                    doquery("INSERT INTO {{table}} SET
                            `ally_name`='{$_POST['aname']}',
                            `ally_tag`='{$_POST['atag']}' ,
                            `ally_owner`='{$user['id']}',
                            `ally_owner_range`='Leader',
                            `ally_members`='1',
                            `ally_register_time`=" . time(), "alliance");
                    $allyquery = doquery("SELECT * FROM {{table}} WHERE ally_tag='{$_POST['atag']}'", 'alliance', true);
                    doquery("UPDATE {{table}} SET
                            `ally_id`='{$allyquery['id']}',
                            `ally_name`='{$allyquery['ally_name']}',
                            `ally_register_time`='" . time() . "'
                            WHERE `id`='{$user['id']}'", "users");
                    $lang['ally_marked'] = str_replace('%s', $_POST['atag'], $lang['ally_maked']);
                    $this->tplObj->assign(array(
                        'title' => $lang['make_alliance'],
                        'Goto' => '?page=alliance',
                        'Ally_Message' => str_replace('%s', $_POST['atag'], $lang['alliance_has_been_maked']),
                        'Title' => str_replace('%s', $_POST['atag'], $lang['ally_maked']),
                        'Button' => $lang['Ok'],
                        'yes' => 1,
                    ));

                    $this->render('Message.Form.tpl');
                } else {
                    $this->tplObj->assign(array(
                        'title' => $lang['make_alliance'],
                        'make_alliance' => $lang['make_alliance'],
                        'alliance_tag' => $lang['alliance_tag'],
                        'characters' => $lang['characters'],
                        'allyance_name' => $lang['allyance_name'],
                        'Make' => $lang['Make'],
                    ));

                    $this->render('alliance.make.tpl');
                }
            }
        }
    }

    function search() {
        global $lang; // Sin alianza

        $lang['searchtext'] = filter_input(INPUT_POST, 'searchtext');
        $search = doquery("SELECT * FROM {{table}} WHERE ally_name LIKE '%{$lang['searchtext']}%' or ally_tag LIKE '%{$lang['searchtext']}%' LIMIT 30", "alliance");

        $this->tplObj->assign(array(
            'title' => $lang['search_alliance'],
            'INPUT_POST' => filter_input_array(INPUT_POST),
            'Search' => $lang['Search'],
            'searchtext' => $lang['searchtext'],
            'search' => $search,
            'searched_alliance_availables' => $lang['searched_alliance_availables'],
        ));

        $this->render('alliance.searchform.tpl');
    }

    function apply() {
        global $lang, $user, $ally_request, $ally_tag;

        $mode = filter_input(INPUT_GET, 'mode');
        $allyid = intval(filter_input(INPUT_GET, 'allyid'));
        if ($mode == 'apply' && $user['ally_request'] == 0) {
            // solicitudes
            if (!is_numeric(filter_input(INPUT_GET, 'allyid')) || !filter_input(INPUT_GET, 'allyid') || $user['ally_request'] != 0 || $user['ally_id'] != 0) {
                ShowErrorPage::message($lang['it_is_not_posible_to_apply'], $lang['it_is_not_posible_to_apply']);
            }
            // pedimos la info de la alianza
            $allyrow = doquery("SELECT ally_tag,ally_request FROM {{table}} WHERE id='" . intval(filter_input(INPUT_GET, 'allyid')) . "'", "alliance", true);
            if (!$allyrow) {
                ShowErrorPage::message($lang['it_is_not_posible_to_apply'], $lang['it_is_not_posible_to_apply']);
            }
            extract($allyrow);
            if (filter_input(INPUT_POST, 'further') == $lang['Send']) {
                // esta parte es igual que el buscador de search.php...
                doquery("UPDATE {{table}} SET `ally_request`='" . intval($allyid) . "', ally_request_text='" . mysqli_real_escape_string(Database::$dbHandle, strip_tags(filter_input(INPUT_POST, 'text'))) . "', ally_register_time='" . time() . "' WHERE `id`='" . $user['id'] . "'", "users");
                // mensaje de cuando se envia correctamente el mensaje
                ShowErrorPage::message($lang['apply_registered'], $lang['your_apply']);
                // mensaje de cuando falla el envio
                ShowErrorPage::message($lang['apply_cantbeadded'], $lang['your_apply']);
            } else {
                $text_apply = ($ally_request) ? $ally_request : $lang['There_is_no_a_text_apply'];
            }

            $this->tplObj->assign(array(
                'title' => $lang['Write_to_alliance'],
                'lang' => $lang,
                'allyid' => intval(filter_input(INPUT_GET, 'allyid')),
                'ally_tag' => $ally_tag,
                'text_apply' => $text_apply,
                'ally_request' => $ally_request,
            ));

            $this->render('alliance.applyform.tpl');
        }
    }

    function ally() {
        global $lang, $mode, $user;

        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        if ($mode == 'exit') {
            $this->quit();
        }
        if ($mode == 'memberslist') {
            $this->memberslist();
        }
        if ($mode == 'circular') {
            $this->circular();
        } {
            //          global $lang, $user, $ally;
            //          $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
            $ally_ranks = unserialize($ally['ally_ranks']);
            if (!$ally) {
                doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
                ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
            }
            // Default *falta revisar...*
            if ($ally['ally_owner'] != $user['id']) {
                $ally_ranks = unserialize($ally['ally_ranks']);
            }
            // temporalmente...
            if ($ally['ally_owner'] == $user['id']) {
                $range = ($ally['ally_owner_range'] != '') ? $lang['Founder'] : $ally['ally_owner_range'];
            } elseif ($user['ally_rank_id'] != 0 && isset($ally_ranks[$user['ally_rank_id'] - 1]['name'])) {
                $range = $ally_ranks[$user['ally_rank_id'] - 1]['name'];
            } else {
                $range = $lang['member'];
            }
            // El link para ver las solicitudes
            $lang['requests'] = '';
            $request = doquery("SELECT id FROM {{table}} WHERE ally_request='{$ally['id']}'", 'users');
            $request_count = mysqli_num_rows($request);
            // La imagen de logotipo
            // codigo raro
            $patterns[] = "#\[fc\]([a-z0-9\#]+)\[/fc\](.*?)\[/f\]#Ssi";
            $replacements[] = '<font color="\1">\2</font>';
            $patterns[] = '#\[img\](.*?)\[/img\]#Smi';
            $replacements[] = '<img src="\1" alt="\1" style="border:0px;" />';
            $patterns[] = "#\[fc\]([a-z0-9\#\ \[\]]+)\[/fc\]#Ssi";
            $replacements[] = '<font color="\1">';
            $patterns[] = "#\[/f\]#Ssi";
            $replacements[] = '</font>';
            $ally['ally_description'] = preg_replace($patterns, $replacements, $ally['ally_description']);
            $ally['ally_text'] = preg_replace($patterns, $replacements, $ally['ally_text']);

            $this->tplObj->assign(array(
                'title' => $lang['your_alliance'],
                'ally_image' => ($ally['ally_image'] != '') ? "<tr><th colspan=2><img src=\"{$ally['ally_image']}\"></td></tr>" : '',
                'range' => $range,
                'ally_owner' => MessageForm($lang['Exit_of_this_alliance'], "", "?page=alliance&mode=quit", $lang['Continue']),
                'ally' => $ally,
                'user' => $user,
                'request_count' => $request_count,
                'ally_ranks' => $ally_ranks,
            ));

            $this->render('alliance.frontpage.tpl');
        }
    }

    function memberslist() {
        global $lang, $user;

        if ($user['ally_id'] != 0 && $user['ally_request'] == 0) {
            $sort1 = intval(HTTP::_GP('sort1', '1'));
            if (empty($sort1)) {
                unset($sort1);
            }
            $sort2 = intval(HTTP::_GP('sort2', '2'));
            if (empty($sort2)) {
                unset($sort2);
            }
            $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
            $allianz_raenge = unserialize($ally['ally_ranks']);
            if ($allianz_raenge[$user['ally_rank_id']]['memberlist'] == 1 || $ally['ally_owner'] == $user['id']) {
                $user_can_watch_memberlist = true;
            } else {
                $user_can_watch_memberlist = false;
            }
            if ($allianz_raenge[$user['ally_rank_id']]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id']) {
                $user_can_watch_memberlist_status = true;
            } else {
                $user_can_watch_memberlist_status = false;
            }
            if (!$ally) {
                doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
                ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
            }
            /*
              Lista de miembros.
              Por lo que parece solo se hace una query fijandose los usuarios con el mismo ally_id.
              seguido del query del planeta principal de cada uno para sacarle la posicion, pero
              voy a ver si tambien agrego las cordenadas en el id user...
             */
            // $user_can_watch_memberlist
            // comprobamos el permiso
            if ($ally['ally_owner'] != $user['id'] && !$user_can_watch_memberlist) {
                ShowErrorPage::message($lang['Denied_access'], $lang['Members_list']);
            }
            // El orden de aparicion
            if ($sort2) {
                $sort1 = intval(HTTP::_GP('sort1', '1'));
                $sort2 = intval(HTTP::_GP('sort2', '2'));
                if ($sort1 == 1) {
                    $sort = " ORDER BY `username`";
                } elseif ($sort1 == 2) {
                    $sort = " ORDER BY `username`";
                } elseif ($sort1 == 4) {
                    $sort = " ORDER BY `ally_register_time`";
                } elseif ($sort1 == 5) {
                    $sort = " ORDER BY `onlinetime`";
                } else {
                    $sort = " ORDER BY `id`";
                }
                if ($sort2 == 1) {
                    $sort .= " DESC;";
                } elseif ($sort2 == 2) {
                    $sort .= " ASC;";
                }
                $listuser = doquery("SELECT * FROM {{table}} WHERE ally_id='{$user['ally_id']}'{$sort}", 'users');
            } else {
                $listuser = doquery("SELECT * FROM {{table}} WHERE ally_id='{$user['ally_id']}'", 'users');
            }
            // contamos la cantidad de usuarios.
            $i = 0;

            $UserPoints = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $user['id'] . "';", 'statpoints', true);

            // para cambiar el link de ordenar.
            if ($sort2 == 1) {
                $s = 2;
            } elseif ($sort2 == 2) {
                $s = 1;
            } else {
                $s = 1;
            }
            if ($i != $ally['ally_members']) {
                doquery("UPDATE {{table}} SET `ally_members`='{$i}' WHERE `id`='{$ally['id']}'", 'alliance');
            }

            $this->tplObj->assign(array(
                'title' => $lang['Members_list'],
                'i' => $i,
                's' => $s,
                'listuser' => $listuser,
                'ally' => $ally,
                'allianz_raenge' => $allianz_raenge,
                'UserPoints' => $UserPoints,
                'user_can_watch_memberlist_status' => $user_can_watch_memberlist_status,
            ));

            $this->render('alliance.memberslist.tpl');
        }
    }

    function circular() {
        global $user, $lang;

        $sendmail = intval(HTTP::_GP('sendmail', ''));
        if ($user['ally_id'] != 0 && $user['ally_request'] == 0) { // Con alianza
            $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
            $allianz_raenge = unserialize($ally['ally_ranks']);
            if ($allianz_raenge[$user['ally_rank_id']]['mails'] == 1 || $ally['ally_owner'] == $user['id']) {
                $user_can_send_mails = true;
            } else {
                $user_can_send_mails = false;
            }
            if (!$ally) {
                doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
                ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
            }
            /*
              Mandar un correo circular.
              creo que aqui tendria que ver yo como crear el sistema de mensajes...
             */
            // comprobamos el permiso
            if ($ally['ally_owner'] != $user['id'] && !$user_can_send_mails) {
                ShowErrorPage::message($lang['Denied_access'], $lang['Send_circular_mail']);
            }
            if ($sendmail == 1) {
                $_POST['r'] = intval($_POST['r']);
                $_POST['text'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['text']));
                if ($_POST['r'] == 0) {
                    $sq = doquery("SELECT id,username FROM {{table}} WHERE ally_id='{$user['ally_id']}'", "users");
                } else {
                    $sq = doquery("SELECT id,username FROM {{table}} WHERE ally_id='{$user['ally_id']}' AND ally_rank_id='{$_POST['r']}'", "users");
                }
                // looooooop
                $list = '';
                while ($u = mysqli_fetch_array($sq)) {
                    doquery("INSERT INTO {{table}} SET
				`message_owner`='{$u['id']}',
				`message_sender`='{$user['id']}' ,
				`message_time`='" . time() . "',
				`message_type`='2',
				`message_from`='{$ally['ally_tag']}',
				`message_subject`='{$user['username']}',
				`message_text`='{$_POST['text']}'
				", "messages");
                    $list .= "<br>{$u['username']} ";
                }
                // doquery("SELECT id,username FROM {{table}} WHERE ally_id='{$user['ally_id']}' ORDER BY `id`","users");
                doquery("UPDATE {{table}} SET `new_message`=new_message+1 WHERE ally_id='{$user['ally_id']}' AND ally_rank_id='{$_POST['r']}'", "users");
                doquery("UPDATE {{table}} SET `mnl_alliance`=mnl_alliance+1 WHERE ally_id='{$user['ally_id']}' AND ally_rank_id='{$_POST['r']}'", "users");
                /*
                  Aca un mensajito diciendo que a quien se mando.
                 */
                $this->tplObj->assign(array(
                    'title' => $lang['Send_circular_mail'],
                    'Goto' => 'game.php?page=alliance',
                    'Title' => $lang['Circular_sended'],
                    'Ally_Message' => "Les membres suivants ont reçu un message:" . $list,
                    'Button' => $lang['Ok'],
                    'yes' => 1,
                ));
                $this->render('Message.Form.tpl');
            }
            $lang['r_list'] = "<option value=\"0\">{$lang['All_players']}</option>";
            if ($allianz_raenge) {
                foreach ($allianz_raenge as $id => $array) {
                    $lang['r_list'] .= "<option value=\"" . ($id + 1) . "\">" . $array['name'] . "</option>";
                }
            }

            $this->tplObj->assign(array(
                'title' => $lang['Send_circular_mail'],
                'Send_circular_mail' => $lang['Send_circular_mail'],
                'Destiny' => $lang['Destiny'],
                'r_list' => $lang['r_list'],
                'Text_mail' => $lang['Text_mail'],
                'characters' => $lang['characters'],
                'Back' => $lang['Back'],
                'Clear' => $lang['Clear'],
                'Send' => $lang['Send'],
            ));

            $this->render('alliance.circular.tpl');
        }
    }

    function quit() {
        global $ally_name, $ally, $user, $lang;
        if ($user['ally_id'] != 0 && $user['ally_request'] == 0) {
            if ($ally['ally_owner'] == $user['id']) {
                ShowErrorPage::message($lang['Owner_cant_go_out'], $lang['Alliance']);
            }
            $yes = HTTP::_GP('yes', '');
            // se sale de la alianza
            if ($yes == 1) {
                doquery("UPDATE {{table}} SET `ally_id`=0, `ally_name` = '' WHERE `id`='{$user['id']}'", "users");
                $lang['Go_out_welldone'] = str_replace("%s", $ally_name, $lang['Go_out_welldone']);
                $this->tplObj->assign(array(
                    'Goto' => '?page=alliance',
                    'Title' => $lang['Go_out_welldone'],
                    'Ally_Message' => $lang['Go_out_welldone'],
                    'Button' => $lang['Ok'],
                    'yes' => $_GET['yes'],
                ));
                $this->render('Message.Form.tpl');
                // Se quitan los puntos del user en la alianza
            } else {
                // se pregunta si se quiere salir
                $lang['Want_go_out'] = str_replace("%s", $ally_name, $lang['Want_go_out']);
                $this->tplObj->assign(array(
                    'Goto' => '?page=alliance&mode=quit&yes=1',
                    'Ally_Message' => $lang['Want_go_out'],
                    'Title' => $lang['Want_go_out'],
                    'Button' => $lang['Ok'],
                    'yes' => 1,
                ));
                $this->render('Message.Form.tpl');
            }
        }
    }

    function admin() {
        $mode = HTTP::_GP('mode', 'admin');
        if (empty($mode)) {
            unset($mode);
        }
        $edit = HTTP::_GP('edit', 'ally');
        if (empty($edit)) {
            unset($edit);
        }
        if ($mode == 'admin' && $edit == 'ally') {
            $this->admin_ally();
        }
        if ($mode == 'admin' && $edit == 'rights') {
            $this->admin_rights();
        }
        if ($mode == 'admin' && $edit == 'give') {
            $this->admin_give();
        }
        if ($mode == 'admin' && $edit == 'members') {
            $this->admin_members();
        }
        if ($mode == 'admin' && $edit == 'requests') {
            $this->admin_requests();
        }
        if ($mode == 'admin' && $edit == 'name') {
            $this->admin_name();
        }
        if ($mode == 'admin' && $edit == 'tag') {
            $this->admin_tag();
        }
        if ($mode == 'admin' && $edit == 'exit') {
            $this->admin_exit();
        }
    }

    function admin_ally() {
        global $lang, $ally, $user;
        // Administrar la alianza *pendiente urgente*
        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        $t = HTTP::_GP('t', '');
        if ($t != 1 && $t != 2 && $t != 3) {
            $t = 1;
        }
        // post!
        if ($_POST) {
            if (!get_magic_quotes_gpc()) {
                $_POST['owner_range'] = stripslashes($_POST['owner_range']);
                $_POST['web'] = stripslashes($_POST['web']);
                $_POST['image'] = stripslashes($_POST['image']);
                $_POST['text'] = stripslashes($_POST['text']);
            }
        }
        if (@$_POST['options']) {
            $ally['ally_owner_range'] = mysqli_real_escape_string(Database::$dbHandle, htmlspecialchars(strip_tags($_POST['owner_range'])));
            $ally['ally_web'] = mysqli_real_escape_string(Database::$dbHandle, htmlspecialchars(strip_tags($_POST['web'])));
            $ally['ally_image'] = mysqli_real_escape_string(Database::$dbHandle, htmlspecialchars(strip_tags($_POST['image'])));
            $ally['ally_request_notallow'] = intval($_POST['request_notallow']);
            if ($ally['ally_request_notallow'] != 0 && $ally['ally_request_notallow'] != 1) {
                ShowErrorPage::message("Aller ï¿½ \"Candidature\" et sur une option dans le formulaire!", "Erreur");
                exit;
            }
            doquery("UPDATE {{table}} SET
			`ally_owner_range`='{$ally['ally_owner_range']}',
			`ally_image`='{$ally['ally_image']}',
			`ally_web`='{$ally['ally_web']}',
			`ally_request_notallow`='{$ally['ally_request_notallow']}'
			WHERE `id`='{$ally['id']}'", "alliance");
        } elseif (@$_POST['t']) {
            if ($t == 3) {
                $ally['ally_request'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['text']));
                doquery("UPDATE {{table}} SET `ally_request`='{$ally['ally_request']}' WHERE `id`='{$ally['id']}'", "alliance");
            } elseif ($t == 2) {
                $ally['ally_text'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['text']));
                doquery("UPDATE {{table}} SET `ally_text`='" . $ally['ally_text'] . "' WHERE `id`='{$ally['id']}'", "alliance");
            } else {
                $ally['ally_description'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags(stripslashes($_POST['text'])));
                doquery("UPDATE {{table}} SET `ally_description`='" . $ally['ally_description'] . "' WHERE `id`='{$ally['id']}'", "alliance");
            }
        }
        /*
          Depende del $t, muestra el formulario para cada tipo de texto.
         */
        if ($t == 3) {
            $lang['request_type'] = $lang['Show_of_request_text'];
            $lang['text'] = $ally['ally_request'];
        } elseif ($t == 2) {
            $lang['request_type'] = $lang['Internal_text'];
            $lang['text'] = $ally['ally_text'];
        } else {
            $lang['request_type'] = $lang['External_text'];
            $lang['text'] = $ally['ally_description'];
        }

        $this->tplObj->assign(array(
            'title' => $lang['Alliance_admin'],
            'Alliance_admin' => $lang['Alliance_admin'],
            'Law_settings' => $lang['Law_settings'],
            'Members_administrate' => $lang['Members_administrate'],
            'Change_the_ally_tag' => $lang['Change_the_ally_tag'],
            'Change_the_ally_name' => $lang['Change_the_ally_name'],
            'Texts' => $lang['Texts'],
            'External_text' => $lang['External_text'],
            'Internal_text' => $lang['Internal_text'],
            'Show_of_request_text' => $lang['Show_of_request_text'],
            'characters' => $lang['characters'],
            'text' => $lang['text'],
            'request_type' => $lang['request_type'],
            't' => $t,
            'Reset' => $lang['Reset'],
            'Save' => $lang['Save'],
            'Options' => $lang['Options'],
            'Main_Page' => $lang['Main_Page'],
            'ally_web' => $ally['ally_web'],
            'Alliance_logo' => $lang['Alliance_logo'],
            'ally_image' => $ally['ally_image'],
            'Requests' => $lang['Requests'],
            'ally_request_notallow_0' => (($ally['ally_request_notallow'] == 1) ? ' SELECTED' : ''),
            'No_allow_request' => $lang['No_allow_request'],
            'ally_request_notallow_1' => (($ally['ally_request_notallow'] == 0) ? ' SELECTED' : ''),
            'Allow_request' => $lang['Allow_request'],
            'Founder_name' => $lang['Founder_name'],
            'ally_owner_range' => $ally['ally_owner_range'],
            'Disolve_alliance' => MessageForm("Dissoudre L'alliance", "", "?page=alliance&mode=admin&edit=exit", $lang['Continue']),
            'Transfer_alliance' => MessageForm("Abandonner / Transf&eacute;rer L'alliance", "", "?page=alliance&mode=admin&edit=give", $lang['Continue']),
            'AA' => $ally['ally_request'],
        ));

        $this->render('alliance.admin.tpl');
    }

    function admin_rights() {
        global $user, $lang;

        $d = HTTP::_GP('d', '');
        if ((!is_numeric($d)) || (empty($d) && $d != 0)) {
            unset($d);
        }
        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        $ally_ranks = unserialize($ally['ally_ranks']);
        $allianz_raenge = unserialize($ally['ally_ranks']);
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['rechtehand'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_edit_rights = true;
        } else {
            $user_can_edit_rights = false;
        }
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        // Administrar leyes
        if ($ally['ally_owner'] != $user['id'] && !$user_can_edit_rights) {
            ShowErrorPage::message($lang['Denied_access'], $lang['Members_list']);
        } elseif (!empty($_POST['newrangname'])) {
            $name = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['newrangname']));
            $allianz_raenge[] = array(
                'name' => $name,
                'mails' => 0,
                'delete' => 0,
                'kick' => 0,
                'bewerbungen' => 0,
                'administrieren' => 0,
                'bewerbungenbearbeiten' => 0,
                'memberlist' => 0,
                'onlinestatus' => 0,
                'rechtehand' => 0
            );
            $ranks = serialize($allianz_raenge);
            doquery("UPDATE {{table}} SET `ally_ranks`='" . $ranks . "' WHERE `id`=" . $ally['id'], "alliance");
            header("Location: game.php?page=alliance&mode=admin&edit=rights");
            exit();
        } elseif (@$_POST['id'] != '' && is_array($_POST['id'])) {
            $ally_ranks_new = array();
            foreach ($_POST['id'] as $id) {
                $name = $allianz_raenge[$id]['name'];
                $ally_ranks_new[$id]['name'] = $name;
                if (isset($_POST['u' . $id . 'r0'])) {
                    $ally_ranks_new[$id]['delete'] = 1;
                } else {
                    $ally_ranks_new[$id]['delete'] = 0;
                }
                if (isset($_POST['u' . $id . 'r1']) && $ally['ally_owner'] == $user['id']) {
                    $ally_ranks_new[$id]['kick'] = 1;
                } else {
                    $ally_ranks_new[$id]['kick'] = 0;
                }
                if (isset($_POST['u' . $id . 'r2'])) {
                    $ally_ranks_new[$id]['bewerbungen'] = 1;
                } else {
                    $ally_ranks_new[$id]['bewerbungen'] = 0;
                }
                if (isset($_POST['u' . $id . 'r3'])) {
                    $ally_ranks_new[$id]['memberlist'] = 1;
                } else {
                    $ally_ranks_new[$id]['memberlist'] = 0;
                }
                if (isset($_POST['u' . $id . 'r4'])) {
                    $ally_ranks_new[$id]['bewerbungenbearbeiten'] = 1;
                } else {
                    $ally_ranks_new[$id]['bewerbungenbearbeiten'] = 0;
                }
                if (isset($_POST['u' . $id . 'r5'])) {
                    $ally_ranks_new[$id]['administrieren'] = 1;
                } else {
                    $ally_ranks_new[$id]['administrieren'] = 0;
                }
                if (isset($_POST['u' . $id . 'r6'])) {
                    $ally_ranks_new[$id]['onlinestatus'] = 1;
                } else {
                    $ally_ranks_new[$id]['onlinestatus'] = 0;
                }
                if (isset($_POST['u' . $id . 'r7'])) {
                    $ally_ranks_new[$id]['mails'] = 1;
                } else {
                    $ally_ranks_new[$id]['mails'] = 0;
                }
                if (isset($_POST['u' . $id . 'r8'])) {
                    $ally_ranks_new[$id]['rechtehand'] = 1;
                } else {
                    $ally_ranks_new[$id]['rechtehand'] = 0;
                }
            }
            $ranks = serialize($ally_ranks_new);
            doquery("UPDATE {{table}} SET `ally_ranks`='" . $ranks . "' WHERE `id`=" . $ally['id'], "alliance");
            $goto = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
            header("Location: " . $goto);
            exit();
        }
        // borrar una entrada
        elseif (isset($d) && isset($ally_ranks[$d])) {
            unset($ally_ranks[$d]);
            $ally['ally_rank'] = serialize($ally_ranks);
            doquery("UPDATE {{table}} SET `ally_ranks`='{$ally['ally_rank']}' WHERE `id`={$ally['id']}", "alliance");
        }
        foreach ($ally_ranks as $a => $b) {
            $this->tplObj->assign(array(
                'a' => $a,
                'b' => $b,
            ));
        }

        $this->tplObj->assign(array(
            'title' => $lang['Law_settings'],
            'Configure_laws' => $lang['Configure_laws'],
            'Range_make' => $lang['Range_make'],
            'Range_name' => $lang['Range_name'],
            'Make' => $lang['Make'],
            'Law_leyends' => $lang['Law_leyends'],
            'Alliance_dissolve' => $lang['Alliance_dissolve'],
            'Expel_users' => $lang['Expel_users'],
            'See_the_requests' => $lang['See_the_requests'],
            'See_the_list_members' => $lang['See_the_list_members'],
            'Check_the_requests' => $lang['Check_the_requests'],
            'Alliance_admin' => $lang['Alliance_admin'],
            'See_the_online_list_member' => $lang['See_the_online_list_member'],
            'Make_a_circular_message' => $lang['Make_a_circular_message'],
            'Left_hand_text' => $lang['Left_hand_text'],
            'Return_to_overview' => $lang['Return_to_overview'],
            'ally_ranks' => $ally_ranks,
            'There_is_not_range' => $lang['There_is_not_range'],
            'Range_name' => $lang['Range_name'],
            'Save' => $lang['Save'],
            'Delete_range' => $lang['Delete_range'],
            'ally' => $ally,
            'user' => $user,
        ));

        $this->render('alliance.admin_laws.tpl');
    }

    function admin_members() {
        global $user, $lang, $rank;

        $sort1 = intval(HTTP::_GP('sort1', '1'));
        if (empty($sort1)) {
            unset($sort1);
        }
        $sort2 = intval(HTTP::_GP('sort2', '1'));
        if (empty($sort2)) {
            unset($sort2);
        }
        $kick = intval(HTTP::_GP('kick', ''));
        if (empty($kick)) {
            unset($kick);
        }
        $id = intval(HTTP::_GP('id', ''));
        if (empty($id)) {
            unset($id);
        }
        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        $ally_ranks = unserialize($ally['ally_ranks']);
        $allianz_raenge = unserialize($ally['ally_ranks']);
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_watch_memberlist_status = true;
        } else {
            $user_can_watch_memberlist_status = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['memberlist'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_watch_memberlist = true;
        } else {
            $user_can_watch_memberlist = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['mails'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_send_mails = true;
        } else {
            $user_can_send_mails = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['kick'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_kick = true;
        } else {
            $user_can_kick = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['rechtehand'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_edit_rights = true;
        } else {
            $user_can_edit_rights = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['delete'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_exit_alliance = true;
        } else {
            $user_can_exit_alliance = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['bewerbungen'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_bewerbungen_einsehen = true;
        } else {
            $user_bewerbungen_einsehen = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['bewerbungenbearbeiten'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_bewerbungen_bearbeiten = true;
        } else {
            $user_bewerbungen_bearbeiten = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['administrieren'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_admin = true;
        } else {
            $user_admin = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_onlinestatus = true;
        } else {
            $user_onlinestatus = false;
        }
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        // Administrar a los miembros
        /*
          En la administrar a los miembros se pueden establecer los rangos
          para dar los diferentes derechos "Leyes"
         */
        // comprobamos el permiso
        if ($ally['ally_owner'] != $user['id'] && !$user_can_kick) {
            ShowErrorPage::message($lang['Denied_access'], $lang['Members_list']);
        }
        /*
          Kickear usuarios requiere el permiso numero 1
         */
        if (isset($kick)) {
            if ($ally['ally_owner'] != $user['id'] && !$user_can_kick) {
                ShowErrorPage::message($lang['Denied_access'], $lang['Members_list']);
            }
            $u = doquery("SELECT * FROM {{table}} WHERE id='{$kick}' LIMIT 1", 'users', true);
            // kickeamos!
            if ($u['ally_id'] == $ally['id'] && $u['id'] != $ally['ally_owner']) {
                doquery("UPDATE {{table}} SET `ally_id`='0' ,`ally_name` = '' WHERE `id`='{$u['id']}'", 'users');
            }
        } elseif (isset($_POST['newrang'])) {
            $q = doquery("SELECT * FROM {{table}} WHERE id='{$u}' LIMIT 1", 'users', true);
            if ((isset($ally_ranks[$_POST['newrang'] - 1]) || $_POST['newrang'] == 0) && $q['id'] != $ally['ally_owner']) {
                doquery("UPDATE {{table}} SET `ally_rank_id`='" . mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['newrang'])) . "' WHERE `id`='" . intval($id) . "'", 'users');
            }
        }
        // obtenemos las template row
        // El orden de aparicion
        if ($sort2) {
            // agregar el =0 para las coordenadas...
            if ($sort1 == 1) {
                $sort = " ORDER BY `username`";
            } elseif ($sort1 == 2) {
                $sort = " ORDER BY `username`";
            } elseif ($sort1 == 4) {
                $sort = " ORDER BY `ally_register_time`";
            } elseif ($sort1 == 5) {
                $sort = " ORDER BY `onlinetime`";
            } else {
                $sort = " ORDER BY `id`";
            }
            if ($sort2 == 1) {
                $sort .= " DESC;";
            } elseif ($sort2 == 2) {
                $sort .= " ASC;";
            }
            $listuser = doquery("SELECT * FROM {{table}} WHERE ally_id='{$user['ally_id']}'{$sort}", 'users');
        } else {
            $listuser = doquery("SELECT * FROM {{table}} WHERE ally_id={$user['ally_id']}", 'users');
        }
        // contamos la cantidad de usuarios.
        $i = 0;
        // Como es costumbre. un row template
        $page_list = '';
        $lang['memberzahl'] = mysqli_num_rows($listuser);
        while ($u = mysqli_fetch_array($listuser)) {
            $UserPoints = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $u['id'] . "';", 'statpoints', true);
            $i++;
            $u['i'] = $i;
            // Dias de inactivos
            $u['points'] = "" . pretty_number($UserPoints['total_points']) . "";
            $days = floor(round(time() - $u["onlinetime"]) / 3600 % 24);
            $u["onlinetime"] = str_replace("%s", $days, "%s d");
            // Nombre de rango
            if ($ally['ally_owner'] == $u['id']) {
                $ally_range = ($ally['ally_owner_range'] == '') ? $lang['Founder'] : $ally['ally_owner_range'];
            } elseif ($u['ally_rank_id'] == 0 || !isset($ally_ranks[$u['ally_rank_id'] - 1]['name'])) {
                $ally_range = $lang['Novate'];
            } else {
                $ally_range = $ally_ranks[$u['ally_rank_id'] - 1]['name'];
            }
            /*
              Aca viene la parte jodida...
             */
            if ($ally['ally_owner'] == $u['id'] || $rank == $u['id']) {
                $u["functions"] = '';
            } elseif ($ally_ranks[$user['ally_rank_id'] - 1][5] == 1 || $ally['ally_owner'] == $user['id']) {
                $f['Expel_user'] = $lang['Expel_user'];
                $f['Set_range'] = $lang['Set_range'];
                $f['You_are_sure_want_kick_to'] = str_replace("%s", $u['username'], $lang['You_are_sure_want_kick_to']);
                $f['id'] = $u['id'];
                $u["functions"] = parsetemplate($this->getTemplate('alliance.admin_members_function.tpl'), $f);
            } else {
                $u["functions"] = '';
            }
            // por el formulario...
            if ($rank != $u['id']) {
                $u['ally_range'] = $ally_range;
            } else {
                $u['ally_range'] = '';
            }
            $u['ally_register_time'] = date("Y-m-d h:i:s", $u['ally_register_time']);
            $page_list .= parsetemplate($this->getTemplate('alliance.admin_members_row.tpl'), $u);
            if ($rank == $u['id']) {
                $r['Rank_for'] = str_replace("%s", $u['username'], $lang['Rank_for']);
                $r['options'] .= "<option value=\"0\">{$lang['Novate']}</option>";
                foreach ($ally_ranks as $a => $b) {
                    $r['options'] .= "<option value=\"" . ($a + 1) . "\"";
                    if ($u['ally_rank_id'] - 1 == $a) {
                        $r['options'] .= ' selected=selected';
                    }
                    $r['options'] .= ">{$b['name']}</option>";
                }
                $r['id'] = $u['id'];
                $r['Save'] = $lang['Save'];
                $page_list .= parsetemplate($this->getTemplate('alliance.admin_members_row_edit.tpl'), $r);
            }
        }
        // para cambiar el link de ordenar.
        if ($sort2 == 1) {
            $s = 2;
        } elseif ($sort2 == 2) {
            $s = 1;
        } else {
            $s = 1;
        }
        if ($i != $ally['ally_members']) {
            doquery("UPDATE {{table}} SET `ally_members`='{$i}' WHERE `id`='{$ally['id']}'", 'alliance');
        }
        // a=9 es para cambiar la etiqueta de la etiqueta.
        // a=10 es para cambiarle el nombre de la alianza

        $this->tplObj->assign(array(
            'title' => $lang['Members_administrate'],
            'Members_list' => $lang['Members_list'],
            'Ammount' => $lang['Ammount'],
            'memberzahl' => $lang['memberzahl'],
            'Number' => $lang['Number'],
            's' => $s,
            'Name' => $lang['Name'],
            'Position' => $lang['Position'],
            'Points' => $lang['Points'],
            'Coordinated' => $lang['Coordinated'],
            'Member_from' => $lang['Member_from'],
            'memberslist' => $page_list,
            'Return_to_overview' => $lang['Return_to_overview'],
        ));

        $this->render('alliance.admin_members.tpl');
    }

    function admin_tag() {
        global $user, $lang, $ally, $user_admin;

        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        // Changer le TAG l'alliance
        // Bon si on verifiait les autorisation ?
        if ($ally['ally_owner'] != $user['id'] && !$user_admin) {
            ShowErrorPage::message($lang['Denied_access'], $lang['Members_list']);
        }
        if (@$_POST['newtag']) {
            // Y a le nouveau TAG
            $ally['ally_tag'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['newtag']));
            doquery("UPDATE {{table}} SET `ally_tag` = '" . $ally['ally_tag'] . "' WHERE `id` = '" . $user['ally_id'] . "';", 'alliance');
        }

        $this->tplObj->assign(array(
            'title' => $lang['Alliance_admin'],
            'question' => str_replace('%s', "ally_tag", $lang['How_you_will_call_the_alliance_in_the_future']),
            'New_name' => $lang['New_tag'],
            'Change' => $lang['Change'],
            'Return_to_overview' => $lang['Return_to_overview'],
        ));

        $this->render('alliance.admin_rename_tag.tpl');
    }

    function admin_name() {
        global $user, $lang, $ally, $user_admin;

        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        // Changer le nom de l'alliance
        // comprobamos el permiso
        if ($ally['ally_owner'] != $user['id'] && !$user_admin) {
            ShowErrorPage::message($lang['Denied_access'], $lang['Members_list']);
        }
        if (@$_POST['newname']) {
            // Y a le nouveau Nom
            $ally['ally_name'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['newname']));
            doquery("UPDATE {{table}} SET `ally_name` = '" . $ally['ally_name'] . "' WHERE `id` = '" . $user['ally_id'] . "';", 'alliance');
            doquery("UPDATE {{table}} SET `ally_name` = '" . $ally['ally_name'] . "' WHERE `ally_id` = '" . $ally['id'] . "';", 'users');
        }

        $this->tplObj->assign(array(
            'title' => $lang['Alliance_admin'],
            'question' => str_replace('%s', $ally['ally_name'], $lang['How_you_will_call_the_alliance_in_the_future']),
            'New_name' => $lang['New_name'],
            'Change' => $lang['Change'],
            'Return_to_overview' => $lang['Return_to_overview'],
        ));

        $this->render('alliance.admin_rename_name.tpl');
    }

    function admin_give() {
        global $user, $lang;

        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        $allianz_raenge = unserialize($ally['ally_ranks']);
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_watch_memberlist_status = true;
        } else {
            $user_can_watch_memberlist_status = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['memberlist'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_watch_memberlist = true;
        } else {
            $user_can_watch_memberlist = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['mails'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_send_mails = true;
        } else {
            $user_can_send_mails = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['kick'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_kick = true;
        } else {
            $user_can_kick = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['rechtehand'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_edit_rights = true;
        } else {
            $user_can_edit_rights = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['delete'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_exit_alliance = true;
        } else {
            $user_can_exit_alliance = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['bewerbungen'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_bewerbungen_einsehen = true;
        } else {
            $user_bewerbungen_einsehen = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['bewerbungenbearbeiten'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_bewerbungen_bearbeiten = true;
        } else {
            $user_bewerbungen_bearbeiten = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['administrieren'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_admin = true;
        } else {
            $user_admin = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_onlinestatus = true;
        } else {
            $user_onlinestatus = false;
        }
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        if ($_POST["id"]) {
            doquery("update {{table}} set `ally_owner`='" . $_POST["id"] . "' where `id`='" . $user['ally_id'] . "'", 'alliance');
        } else {
            $selection = doquery("SELECT * FROM {{table}} where ally_id='" . $user['ally_id'] . "'", 'users');
            $select = '';
            while ($data = mysqli_fetch_array($selection)) {
                $select.='<OPTION VALUE="' . $data['id'] . '">' . $data['username'];
            }

            $this->tplObj->assign('select', $select);

            $this->render('alliance.give.tpl');
        }
    }

    function admin_requests() {
        global $user, $lang, $ally;

        $show = intval(HTTP::_GP('show', ''));
        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        $allianz_raenge = unserialize($ally['ally_ranks']);
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['bewerbungenbearbeiten'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_bewerbungen_bearbeiten = true;
        } else {
            $user_bewerbungen_bearbeiten = false;
        }
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        // Administrar solicitudes
        if ($ally['ally_owner'] != $user['id'] && !$user_bewerbungen_bearbeiten) {
            ShowErrorPage::message($lang['Denied_access'], $lang['Check_the_requests']);
        }
        if (@$_POST['action'] == "Accepter") {
            $_POST['text'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['text']));
            $u = doquery("SELECT * FROM {{table}} WHERE id=$show", 'users', true);
            // agrega los puntos al unirse el user a la alianza
            doquery("UPDATE {{table}} SET
                ally_members=ally_members+1
                WHERE id='{$ally['id']}'", 'alliance');
            doquery("UPDATE {{table}} SET
                ally_name='{$ally['ally_name']}',
                ally_request_text='',
                ally_request='0',
                ally_id='{$ally['id']}',
                new_message=new_message+1,
                mnl_alliance=mnl_alliance+1
                WHERE id='{$show}'", 'users');
            // Se envia un mensaje avizando...
            doquery("INSERT INTO {{table}} SET
                `message_owner`='{$show}',
                `message_sender`='{$user['id']}' ,
                `message_time`='" . time() . "',
                `message_type`='2',
                `message_from`='{$ally['ally_tag']}',
                `message_subject`='[" . $ally['ally_name'] . "] vous a acceptee!',
                `message_text`='Hi!<br>L\'Alliance <b>" . $ally['ally_name'] . "</b> a acceptee votre candidature!<br>Charte:<br>" . $_POST['text'] . "'", "messages");
            header('Location:game.php?page=alliance&mode=admin&edit=requests');
            die();
        } elseif (@$_POST['action'] == "Refuser" && $_POST['action'] != '') {
            $_POST['text'] = mysqli_real_escape_string(Database::$dbHandle, strip_tags($_POST['text']));
            doquery("UPDATE {{table}} SET ally_request_text='',ally_request='0',ally_id='0',new_message=new_message+1, mnl_alliance=mnl_alliance+1 WHERE id='{$show}'", 'users');
            // Se envia un mensaje avizando...
            doquery("INSERT INTO {{table}} SET
                `message_owner`='{$show}',
                `message_sender`='{$user['id']}' ,
                `message_time`='" . time() . "',
                `message_type`='2',
                `message_from`='{$ally['ally_tag']}',
                `message_subject`='[" . $ally['ally_name'] . "] vous as refuse!',
                `message_text`='Hi!<br>L\'Alliance <b>" . $ally['ally_name'] . "</b> a refusee votre candidature!<br>Begr&uuml;ndung/Text:<br>" . $_POST['text'] . "'", "messages");
            header('Location:game.php?page=alliance&mode=admin&edit=requests');
            die();
        }
        $i = 0;
        $parse = $lang;
        $query = doquery("SELECT id,username,ally_request_text,ally_register_time FROM {{table}} WHERE ally_request='{$ally['id']}'", 'users');
        while ($r = mysqli_fetch_array($query)) {
            // recolectamos los datos del que se eligio.
            if (isset($show) && $r['id'] == $show) {
                $s['username'] = $r['username'];
                $s['ally_request_text'] = nl2br($r['ally_request_text']);
                $s['id'] = $r['id'];
            }
            // la fecha de cuando se envio la solicitud
            $r['time'] = date("Y-m-d h:i:s", $r['ally_register_time']);
            @$parse['list'] .= parsetemplate($this->getTemplate('alliance.admin_request_row.tpl'), $r);
            $i++;
        }
        if ($parse['list'] == '') {
            $parse['list'] = '<tr><th colspan=2>Il ne reste plus aucune candidature</th></tr>';
        }
        // Con $show
        if (isset($show) && $show != 0 && $parse['list'] != '') {
            // Los datos de la solicitud
            @$s['Request_from'] = str_replace('%s', $s['username'], $lang['Request_from']);
            // el formulario
            $parse['request'] = parsetemplate($this->getTemplate('alliance.admin_request_form.tpl'), $s);
            $parse['request'] = parsetemplate($parse['request'], $lang);
        } else {
            $parse['request'] = '';
        }
        $parse['There_is_hanging_request'] = str_replace('%n', $i, @$lang['There_is_hanging_request']);
        // $parse['list'] = $lang['Return_to_overview'];
//	$page = parsetemplate(gettemplate('alliance_admin_request_table'), $parse);
//	display($page, $lang['Check_the_requests']);
        $this->tplObj->assign(array(
            'title' => $lang['Check_the_requests'],
            'Apply_ally_overview' => $lang['Apply_ally_overview'],
            'ally_tag' => $ally['ally_tag'],
            'request' => $parse['request'],
            'There_is_hanging_request' => $parse['There_is_hanging_request'],
            'Candidate' => $lang['Candidate'],
            'Date_of_the_request' => $lang['Date_of_the_request'],
            'list' => $parse['list'],
            'Back' => $lang['Back'],
        ));

        $this->render('alliance.admin_request.tpl');
    }

    function admin_exit() {
        global $user, $lang;

        $ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
        $allianz_raenge = unserialize($ally['ally_ranks']);
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_watch_memberlist_status = true;
        } else {
            $user_can_watch_memberlist_status = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['memberlist'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_watch_memberlist = true;
        } else {
            $user_can_watch_memberlist = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['mails'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_send_mails = true;
        } else {
            $user_can_send_mails = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['kick'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_kick = true;
        } else {
            $user_can_kick = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['rechtehand'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_edit_rights = true;
        } else {
            $user_can_edit_rights = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['delete'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_can_exit_alliance = true;
        } else {
            $user_can_exit_alliance = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['bewerbungen'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_bewerbungen_einsehen = true;
        } else {
            $user_bewerbungen_einsehen = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['bewerbungenbearbeiten'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_bewerbungen_bearbeiten = true;
        } else {
            $user_bewerbungen_bearbeiten = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['administrieren'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_admin = true;
        } else {
            $user_admin = false;
        }
        if (@$allianz_raenge[$user['ally_rank_id'] - 1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id']) {
            $user_onlinestatus = true;
        } else {
            $user_onlinestatus = false;
        }
        if (!$ally) {
            doquery("UPDATE {{table}} SET `ally_name`='',`ally_id`=0 WHERE `id`='{$user['id']}'", "users");
            ShowErrorPage::message($lang['ally_notexist'], $lang['your_alliance'], 'game.php?page=alliance');
        }
        // disolver una alianza
        // obtenemos el array de los rangos
        // comprobamos el permiso
        if ($ally['ally_owner'] != $user['id'] && !$user_can_exit_alliance) {
            ShowErrorPage::message($lang['Denied_access'], $lang['Members_list']);
        }
        /*
          Si bien, se tendria que confirmar, no tengo animos para hacerlo mas detallado...
          sorry :(
         */
        doquery("UPDATE {{table}} SET `ally_id`='0', `ally_name` = '' WHERE `id`='{$user['id']}'", 'users');
        doquery("DELETE FROM {{table}} WHERE id='{$ally['id']}'", "alliance");
        header('Location: game.php?page=alliance');
        exit;
    }

}
