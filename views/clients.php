<?php

if (isset($_SESSION['logged'])) {
    if ($_SESSION['role'] == 'client') {
        header('location:' . BASE_URL . 'index.php');
    }
} else {
    header('location:login');
}

$clients = new UserController();
$allClients = $clients->getAllClients();

?>

<div class="container">
<div class="my-4 d-flex">
    <a class="btn btn-primary me-1" href="dashboard"><i class="fas fa-angle-left" ></i></a>
    <a class="btn btn-primary" href="logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
    <h4 class="ms-auto">Hello, <?php echo $_SESSION['username']?></h4>
</div>
<table class="table table-light">
    <tbody>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date Of Birth</th>
        </tr>
        <?php foreach ($allClients as $client): ?>
        <tr>
            <td><?php echo $client['id']?></td>
            <td><?php echo $client['name']?></td>
            <td><?php echo $client['email']?></td>
            <td><?php echo $client['dob']?></td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>