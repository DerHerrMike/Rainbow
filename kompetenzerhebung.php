<?php
require_once ('inc/maininclude.inc.php');


// get parameter: kompetenzerhebungs_id, bereichs_id
// kompetenzerhebung=8&bereich=1 aus URL
$kompetenzerhebungs_id = $_GET['kompetenzerhebung'];
$bereich_id = $_GET['bereich'];

//durch iterieren, frage ausgeben, auf prozentwert checken.
$percentages = $kompetenzerhebungManager->getFragen($kompetenzerhebungs_id, $bereich_id);