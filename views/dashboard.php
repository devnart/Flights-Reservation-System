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

echo $_SESSION['username'];


?>

<div class="container">
  <table class="table">
    <a class="btn btn-primary" href="addFlight">+</a>
    <a class="btn btn-primary" href="logout"><?php echo $_SESSION['username'] ?></a>
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
            <form action="update" method="POST"><input type="hidden" name="id" value="<?php echo $flight['id'] ?>"><button href="update" class="btn btn-secondary"><i class="fas fa-edit"></i></button></form>
            <form action="delete" method="POST"><input type="hidden" name="id" value="<?php echo $flight['id'] ?>"><button href="delete" class="btn btn-danger"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>