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
 * @ShowNotesPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  6/Dez/2014 12:43:24
 */

/**
 * Description of ShowNotesPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowNotesPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'notes';
    }

    function show() {
        global $lang, $user;

        $this->initTemplate();
        $this->setWindow('popup');

        includeLang('notes');

        $a = filter_input(INPUT_GET, 'a');
        $lang['Please_Wait'] = "Patientez...";

        if (filter_input(INPUT_POST, 's') == 1 || filter_input(INPUT_POST, 's') == 2) {//Edicion y agregar notas
            $time = time();
            $priority = filter_input(INPUT_POST, 'u');
            $title = (filter_input(INPUT_POST, 'title')) ? mysql_real_escape_string(strip_tags(filter_input(INPUT_POST, 'title'))) : $lang['NoTitle'];
            $text = (filter_input(INPUT_POST, 'text')) ? mysql_real_escape_string(strip_tags(filter_input(INPUT_POST, 'text'))) : $lang['NoText'];

            if (filter_input(INPUT_POST, 's') == 1) {
                doquery("INSERT INTO {{table}} SET owner={$user['id']}, time=$time, priority=$priority, title='$title', text='$text'", "notes");
                ShowErrorPage::message($lang['NoteAdded'], $lang['Please_Wait'], header("Refresh: 3;url=game.php?page=notes"));
            } elseif (filter_input(INPUT_POST, 's') == 2) {
                /*
                  pequeño query para averiguar si la nota que se edita es del propio jugador
                 */
                $id = intval(filter_input(INPUT_POST, 'n'));
                $note_query = doquery("SELECT * FROM {{table}} WHERE id=$id AND owner=" . $user["id"], "notes");

                if (!$note_query) {
                    error($lang['notpossiblethisway'], $lang['Notes']);
                }

                doquery("UPDATE {{table}} SET time=$time, priority=$priority, title='$title', text='$text' WHERE id=$id", "notes");
                ShowErrorPage::message($lang['NoteUpdated'], $lang['Please_Wait'], header("Refresh: 3;url=game.php?page=notes"));
            }
        } elseif (filter_input_array(INPUT_POST)) {//Borrar
            foreach (filter_input_array(INPUT_POST) as $a => $b) {
                /*
                  Los checkbox marcados tienen la palabra delmes seguido del id.
                  Y cada array contiene el valor "y" para compro
                 */
                if (preg_match("/delmes/i", $a) && $b == "y") {
                    $id = str_replace("delmes", "", $a);
                    $note_query = doquery("SELECT * FROM {{table}} WHERE id=$id AND owner={$user['id']}", "notes");
                    //comprobamos,
                    if ($note_query) {
                        @$deleted++;
                        doquery("DELETE FROM {{table}} WHERE `id`=$id;", "notes"); // y borramos
                    }
                }
            }
            if ($deleted) {
                $mes = ($deleted == 1) ? $lang['NoteDeleted'] : $lang['NoteDeleteds'];
                ShowErrorPage::message($mes, $lang['Please_Wait'], header("Refresh: 3;url=game.php?page=notes"));
            } else {
                header("Location: game.php?page=notes");
            }
        } else {//sin post...
            if (filter_input(INPUT_GET, 'a') == 1) {//crear una nueva nota.
                $this->makeNotes();
            } elseif (filter_input(INPUT_GET, 'a') == 2) {//editar
                $this->editNotes();
            } else {//default
                $this->tplObj->assign(array(
                    'title' => $lang['Notes'],
                    'notes_query' => doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} ORDER BY time DESC", 'notes'),
                    'count' => 0,
                ));

                $this->render('notes.default.tpl');
            }
        }
    }

    function editNotes() {
        global $user, $lang;
        $n = intval(filter_input(INPUT_GET, 'n'));
        /*
          Formulario donde se puestra la nota y se puede editar.
         */
        $note = doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} AND id=$n", 'notes', true);

        if (!$note) {
            ShowErrorPage::message($lang['notpossiblethisway'], $lang['Error']);
        }

        $SELECTED[$note['priority']] = ' selected="selected"';
        $parse = array_merge($note, $lang);
        @$parse['c_Options'] = "<option value=2{$SELECTED[2]}>{$lang['Important']}</option>
			  <option value=1{$SELECTED[1]}>{$lang['Normal']}</option>
			  <option value=0{$SELECTED[0]}>{$lang['Unimportant']}</option>";

        $this->tplObj->assign(array(
            'title' => $lang['Notes'],
            'note' => doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} AND id=$n", 'notes', true),
            'c_Options' => $parse['c_Options']
        ));

        $this->render('notes.edit.tpl');
    }

    function makeNotes() {
        global $lang, $user;
        $n = intval(filter_input(INPUT_GET, 'n'));
        /*
         * Formulario para crear una nueva nota.
         */
        $parse['c_Options'] = "<option value=2 selected=selected>{$lang['Important']}</option>
			  <option value=1>{$lang['Normal']}</option>
			  <option value=0>{$lang['Unimportant']}</option>";

        $this->tplObj->assign(array(
            'title' => $lang['Notes'],
            'note' => doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} AND id=$n", 'notes', true),
            'c_Options' => $parse['c_Options']
        ));

        $this->render('notes.make.tpl');
    }

}
