<?php 

if(isset($_POST['id'])) {
    $deleteFlight = new FlightsController;
    $deleteFlight->deleteFlight();

}

?>