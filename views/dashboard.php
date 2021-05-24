<?php

$flights = new FlightsController();

$allFlights = $flights->getAllFlights();

if (isset($_SESSION['logged'])) {
  if ($_SESSION['role'] == 'client') {
    header('location:' . BASE_URL . 'index.php');
  }
} else {
  header('location:login');
}

?>

<div class="container">
  <div class="my-4 d-flex">

    <a class="btn btn-primary me-1" href="addFlight">+</a>
    <a class="btn btn-primary me-1" href="reservedFlights">Reservations</a>
    <a class="btn btn-primary me-1" href="clients">Clients</a>
    <a class="btn btn-primary" href="logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
    <h4 class="ms-auto">Hello, <?php echo $_SESSION['username']?></h4>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Depart</th>
        <th scope="col">Land</th>
        <th scope="col">Origin</th>
        <th scope="col">Destination</th>
        <th scope="col">Max Seats</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($allFlights as $flight) : ?>
        <tr>
          <th scope="row"><?php echo $flight['id'] ?></th>
          <td><?php echo $flight['depart'] ?></td>
          <td><?php echo $flight['land'] ?></td>
          <td><?php echo $flight['origin'] ?></td>
          <td><?php echo $flight['destination'] ?></td>
          <td><?php echo $flight['maxSeats'] ?></td>
          <td class="d-flex">
            <form action="updateFlight" method="POST" class="me-1"><input type="hidden" name="id" value="<?php echo $flight['id'] ?>"><button href="updateFlight" class="btn btn-secondary"><i class="fas fa-edit"></i></button></form>
            <form action="deleteFlight" method="POST"><input type="hidden" name="id" value="<?php echo $flight['id'] ?>"><button href="deleteFlight" class="btn btn-danger"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>