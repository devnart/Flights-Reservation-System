<?php

if (isset($_POST['submit'])) {
    $newFlight = new FlightsController();
    $newFlight->addFlight();
}
if (isset($_SESSION['logged'])) {
    if ($_SESSION['role'] == 'client') {
      header('location:' . BASE_URL . 'index.php');
    }
  }else {
    header('location:login');
  
  }
  
?>
<div class="container mt-5">
    <form action="" method="POST" class="form">

        <label for="" class="form-label">Depart</label>
        <input type="date" name="depart" class="form-control">
        <label for="" class="form-label">land</label>
        <input type="date" name="land" class="form-control">
        <label for="" class="form-label">Origin</label>
        <input type="text" name="origin" class="form-control">
        <label for="" class="form-label">Destin</label>
        <input type="text" name="destination" class="form-control">
        <label for="" class="form-label">max</label>
        <input type="number" name="maxSeats" class="form-control mb-3">
        <input type="submit" name="submit" value="submit" class="btn btn-primary">
    </form>

</div>