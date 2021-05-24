<?php 
require_once './views/includes/header.php';
require_once './autoload.php';
$home = new HomeController();

$pages = ['home','addFlight','deleteFlight','dashboard','updateFlight','login','register','logout','search','reserve','reservedFlights','clients','userFlights','updateReservation'];

if(isset($_GET['page'])) {
    if(in_array($_GET['page'],$pages)) {
        $page = $_GET['page'];

        $home->index($page);
    }else {
        include('views/includes/404.php');
    }
}else {
    $home->index('home');
}

require_once './views/includes/footer.php';