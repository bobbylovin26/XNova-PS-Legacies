<?php

require_once ROOT_PATH . 'includes/classes/Legacies/Empire/Shipyard.php';

function PlanetResourceUpdate ( $CurrentUser, &$CurrentPlanet, $UpdateTime, $Simul = false ) {
    global $ProdGrid, $resource, $reslist, $game_config;

    if ($Simul == false) {
        $shipyard = Legacies_Empire_Shipyard::factory($CurrentPlanet, $CurrentUser);
        $shipyard->updateQueue();
        $CurrentPlanet = $shipyard->save();
    }
}