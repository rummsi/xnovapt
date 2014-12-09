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
 * @ShowBuildingsPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  3/Dez/2014 13:50:31
 */

/**
 * Description of ShowBuildingsPage
 *
 * @author author XNovaPT Team <xnovaptteam@gmail.com>
 */
class ShowBuildingsPage extends AbstractGamePage {

    function __construct() {
        parent::__construct();
        $this->tplObj->compile_id = 'buildings';
    }

    function show() {
        global $lang, $resource, $reslist, $dpath, $game_config, $planetrow, $user;

        includeLang('buildings');

        // Mise a jour de la liste de construction si necessaire
        UpdatePlanetBatimentQueueList($planetrow, $user);
        $IsWorking = HandleTechnologieBuild($planetrow, $user);
        CheckPlanetUsedFields($planetrow);
        // Tables des batiments possibles par type de planete
        $Allowed['1'] = array(1, 2, 3, 4, 12, 14, 15, 21, 22, 23, 24, 31, 33, 34, 44);
        $Allowed['3'] = array(12, 14, 21, 22, 23, 24, 34, 41, 42, 43);
        // Boucle d'interpretation des eventuelles commandes
        if (isset($_GET['cmd'])) {
            // On passe une commande
            $bThisIsCheated = false;
            $bDoItNow = false;
            if (isset($_GET['cmd'])) {
                $TheCommand = $_GET['cmd'];
            }
            if (isset($_GET['building'])) {
                $Element = $_GET['building'];
            }
            if (isset($_GET['listid'])) {
                $ListID = $_GET['listid'];
            }
            if (isset($Element)) {
                if (!strchr($Element, " ")) {
                    if (!strchr($Element, ",")) {
                        if (!strchr($Element, ";")) {
                            if (in_array(trim($Element), $Allowed[$planetrow['planet_type']])) {
                                $bDoItNow = true;
                            } else {
                                $bThisIsCheated = true;
                            }
                        } else {
                            $bThisIsCheated = true;
                        }
                    } else {
                        $bThisIsCheated = true;
                    }
                } else {
                    $bThisIsCheated = true;
                }
            } elseif (isset($ListID)) {
                $bDoItNow = true;
            }
            if ($bDoItNow == true) {
                switch ($TheCommand) {
                    case 'cancel':
                        // Interrompre le premier batiment de la queue
                        CancelBuildingFromQueue($planetrow, $user);
                        break;
                    case 'remove':
                        // Supprimer un element de la queue (mais pas le premier)
                        // $RemID -> element de la liste a supprimer
                        RemoveBuildingFromQueue($planetrow, $user, $ListID);
                        break;
                    case 'insert':
                        // Insere un element dans la queue
                        AddBuildingToQueue($planetrow, $user, $Element, true);
                        break;
                    case 'destroy':
                        // Detruit un batiment deja construit sur la planete !
                        AddBuildingToQueue($planetrow, $user, $Element, false);
                        break;
                    default:
                        break;
                } // switch
            } elseif ($bThisIsCheated == true) {
                ResetThisFuckingCheater($user['id']);
            }
        }
        SetNextQueueElementOnTop($planetrow, $user);
        $Queue = ShowBuildingQueue($planetrow, $user);
        // On enregistre ce que l'on a modifi� dans planet !
        BuildingSavePlanetRecord($planetrow);
        // On enregistre ce que l'on a eventuellement modifi� dans users
        BuildingSaveUserRecord($user);
        if ($Queue['lenght'] < MAX_BUILDING_QUEUE_SIZE) {
            $CanBuildElement = true;
        } else {
            $CanBuildElement = false;
        }

        $this->tplObj->assign(array(
            'title' => $lang['Buildings'],
            'Queue_lenght' => $Queue['lenght'],
            'Allowed' => $Allowed,
            'resource' => $resource,
            'CanBuildElement' => $CanBuildElement,
            'Queue' => ShowBuildingQueue($planetrow, $user),
        ));
        $this->render('buildings.default.tpl');
    }

}
