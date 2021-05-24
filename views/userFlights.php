<?php

if ($_SESSION['logged'] == false) {
    Session::set('error', 'You have to login first');

    header('location:login');
}
$id = $_SESSION['clientID'];


$all = new FlightsController();
$reserved = $all->getUserReservation($id);

$passengers = new PassengersContoller();

// var_dump($userPassengers);


if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        $deleteReserve = new FlightsController;
        $deleteReserve->deleteReservation();
    }
}

?>

<div class="container">
    <div class="my-5 d-flex">
        <h2 class="mb-0">Your <span class="text-primary fw-bold fst-italic">Reservation</span></h2>
    <a class="btn btn-primary me-1 ms-auto" href="home"><i class="fas fa-angle-left me-2" ></i>Back</a>
        
    </div>
    <table class="table table-light">
        <tbody>
            <tr>
                <th>Depart</th>
                <th>Land</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Reserved</th>
                <th>Passengers</th>
                <th>Options</th>
            </tr>
            <?php foreach ($reserved as $flight) : ?>
                <tr>
                    <td><?php echo $flight['depart'] ?></td>
                    <td><?php echo $flight['land'] ?></td>
                    <td><?php echo $flight['origin'] ?></td>
                    <td><?php echo $flight['destination'] ?></td>
                    <td><?php echo $flight['added'] ?></td>
                    <td><?php
                        $userPassengers = $passengers->getUserPassengers($flight['id']);
                        for ($i = 0; $i < count($userPassengers); $i++) {
                            echo $userPassengers[$i]['name'] . '<br>';
                        }
                        ?></td>
                    <td class="d-flex gap-1">
                        <form action="" method="POST"><input type="hidden" name="id" value="<?php echo $flight['id'] ?>"><button type="submit" name="delete"  class=" btn btn-danger" >Delete</button></form>
                        <?php if(count($userPassengers)>0 ) :?><form action="updateReservation" method="POST"><input type="hidden" name="id" value="<?php echo $flight['id'] ?>"><button  class="btn btn-secondary" type="submit" name="edit">Edit</button></form><?php endif;?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>