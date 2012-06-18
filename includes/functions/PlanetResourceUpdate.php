<?php

require_once ROOT_PATH . 'includes/classes/Legacies/Empire/Shipyard.php';

function PlanetResourceUpdate ( $CurrentUser, &$CurrentPlanet, $UpdateTime, $Simul = false ) {
    global $ProdGrid, $resource, $reslist, $game_config;

    if ($Simul == false) {
        $shipyard = Legacies_Empire_Shipyard::factory($CurrentPlanet, $CurrentUser);
        $shipyard->updateQueue();
        $CurrentPlanet = $shipyard->save();
            $sql =<<<SQL_EOF
UPDATE {{table}} SET
    `metal` = '{$CurrentPlanet['metal']}',
    `crystal` = '{$CurrentPlanet['crystal']}',
    `deuterium` = '{$CurrentPlanet['deuterium']}',
    `last_update` = '{$CurrentPlanet['last_update']}',
    `metal_perhour` = '{$CurrentPlanet['metal_perhour']}',
    `crystal_perhour` = '{$CurrentPlanet['crystal_perhour']}',
    `deuterium_perhour` = '{$CurrentPlanet['deuterium_perhour']}',
    `energy_used` = '{$CurrentPlanet['energy_used']}',
    `energy_max` = '{$CurrentPlanet['energy_max']}'
  WHERE`id` = {$CurrentPlanet['id']}
SQL_EOF;

        doquery("LOCK TABLE {{table}} WRITE", 'planets');
        doquery($sql, 'planets');
        doquery("UNLOCK TABLES", '');
    }
}