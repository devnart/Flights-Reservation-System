<?php 


$reserveFlight = new FlightsController;
$rserved = $reserveFlight->reserveFlight();

$passengers = new PassengersContoller;
$passenger = $passengers->passegners();

?>
