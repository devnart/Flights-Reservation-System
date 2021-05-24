<?php


if ($_SESSION['logged'] == false) {
    Session::set('error', 'You have to login first');

    header('location:login');
}
if (isset($_POST['id'])) {
    $passengers = new PassengersContoller;
    $userPassengers = $passengers->getUserPassengers($_POST['id']);
}

if (isset($_POST['edit'])) {
    $edit = new PassengersContoller;
    $edit->updateUserPassenger();
}


$i = 1;

?>
<div class="container">
    <div class="my-5 d-flex">
        <h2 class="mb-0">Edit <span class="text-primary fw-bold fst-italic">Reservation</span></h2>
        <a class="btn btn-primary me-1 ms-auto" href="home"><i class="fas fa-angle-left me-2"></i>Back</a>

    </div>
    <form action="" method="POST">
        <table class="w-100">
            <?php foreach ($userPassengers as $passenger) : ?>
                <tr>
                    <td class="fs-4">Passenger <span class="text-primary fst-italic fw-bold">#<?php echo $i;
                                                                                                $i++ ?></span></td>
                </tr>
                <tr class="passengers" id="">
                    <td colspan="">
                        <div class="input-group-lg d-flex mb-3 flex-column">
                            <label for="from" class="form-label">Full Name</label>
                            <input class="form-control" name="pname[]" type="text" id="pname" placeholder="Name" value="<?php echo $passenger['name'] ?>">
                        </div>
                    </td>
                    <td colspan="">
                        <div class="input-group-lg d-flex mb-3 flex-column">
                            <label for="from" class="form-label">Date of birth</label>
                            <input class="form-control" name="pdob[]" type="date" id="dob" placeholder="Date of Birth" value="<?php echo $passenger['dob'] ?>">
                            <input class="form-control" name="pid[]" type="hidden" id="dob" value="<?php echo $passenger['id'] ?>">
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="Edit" name="edit" class="btn btn-primary">
    </form>
</div>