<?php

$flights = new FlightsController();
$allReserved = $flights->getReserved();

$passengers = new PassengersContoller();
$allPassengers = $passengers->allPassengers();

if (isset($_SESSION['logged'])) {
    if ($_SESSION['role'] == 'client') {
        header('location:' . BASE_URL . 'index.php');
    }
} else {
    header('location:login');
}

if (isset($_POST['delete'])) {
    if(isset($_POST['id'])) {
        $deleteReserve = new FlightsController;
        $deleteReserve->deleteReservation();
    
    }
    
}
?>
<div class="container">
<div class="my-4 d-flex">
    <a class="btn btn-primary me-1" href="dashboard"><i class="fas fa-angle-left" ></i></a>
    <a class="btn btn-primary" href="logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
    <h4 class="ms-auto">Hello, <?php echo $_SESSION['username']?></h4>
</div>
    <h3><?php echo 'Total Reservation : ' . count($allReserved); ?></h3>
    <table class="table table-light">
        <tbody>
            <tr>
                <td>Reservation ID</td>
                <td>Client ID</td>
                <td>Flight ID</td>
                <td>Passengers Name</td>
                <td>Date Of Birth</td>
                <td>Reserved</td>
                <td>Options</td>
            </tr>
            <?php foreach ($allReserved as $rsv) : ?>
                <tr>
                    <td><?php echo $rsv['id'] ?></td>
                    <td><?php echo $rsv['idClient'] ?></td>
                    <td><?php echo $rsv['idFlight'] ?></td>
                    <td><?php for ($i = 0; $i < count($allPassengers); $i++) {
                            if (in_array($rsv['id'], $allPassengers[$i])) {
                                echo $allPassengers[$i]['name'] . ' <hr>';
                            }
                        } ?></td>
                    <td><?php for ($i = 0; $i < count($allPassengers); $i++) {
                            if (in_array($rsv['id'], $allPassengers[$i])) {
                                echo $allPassengers[$i]['dob'] . '<hr>';
                            }
                        } ?></td>
                    <td><?php echo $rsv['added'] ?></td>
                    <td>
                        <form action="" method="POST"><input type="hidden" name="id" value="<?php echo $rsv['id'] ?>"><button type="submit" name="delete" class="btn btn-danger"><i class="fas fa-trash"></i></form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>