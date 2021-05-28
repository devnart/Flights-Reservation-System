<?php

if ($_SESSION['logged'] == false) {
    Session::set('error', 'You have to login first');

    header('location:login');
} else {
    $searchResult = new FlightsController;

    $r = $searchResult->searchFlight();

    if (!isset($_POST['search'])) {
        header('location:home');
    }

    if (empty($r['aller'])) {
        Session::set('info', 'No flights to be found');
        header('location:home');
    }
}

?>

<div class="container">

    <!-- Round Trip -->
    <div class="my-5 d-flex">
                        <h2 class="mb-0">Available <span class="text-primary fw-bold fst-italic">Flights</span></h2>
                        <a class="btn btn-primary me-1 ms-auto" href="home"><i class="fas fa-angle-left me-2"></i>Back</a>

                    </div>
    <?php if (isset($r['retour'])) : ?>
        <div class="table-responsive">
            <form action="reserve" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Origin</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Depart</th>
                            <th scope="col">Land</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php for ($i = 0; $i < count($r); $i++) : ?>
                            <input type="hidden" name="clientID" value="<?php echo $_SESSION['clientID'] ?>">
                            <input type="hidden" name="cEmail" value="<?php echo $_SESSION['email'] ?>">
                            <input type="hidden" name="cName" value="<?php echo $_SESSION['username'] ?>">
                            <tr>
                                <td><?php echo $r['aller'][$i]['depart']; ?></td>
                                <td><?php echo $r['aller'][$i]['land']; ?></td>
                                <td><?php echo $r['aller'][$i]['origin']; ?></td>
                                <td><?php echo $r['aller'][$i]['destination']; ?></td>
                                <input type="hidden" name="allerID" value="<?php echo $r['aller'][$i]['id'] ?>">

                            </tr>
                            <tr>
                                <td><?php echo $r['retour'][$i]['depart']; ?></td>
                                <td><?php echo $r['retour'][$i]['land']; ?></td>
                                <td><?php echo $r['retour'][$i]['origin']; ?></td>
                                <td><?php echo $r['retour'][$i]['destination']; ?></td>
                                <input type="hidden" name="retourID" value="<?php echo $r['retour'][$i]['id'] ?>">



                            </tr>
                            <tr class="passengers" id="<?php echo $r['aller'][$i]['id'] ?>">

                            </tr>
                            <tr>
                                <td class="d-flex align-items-center">
                                    <i class="fas fa-plus-square fs-2 me-2 addPassenger" style="cursor: pointer;" id="" value="<?php echo $r['aller'][$i]['id']  ?>"></i>
                                    <input type="submit" class="btn btn-primary" value="reserve" name="reserveRound">

                                </td>
                            </tr>


                        <?php endfor; ?>

                    </tbody>
                </table>
            </form>

        <?php endif; ?>
        <!-- One Way Trip -->
        <?php if (!isset($r['retour'])) : ?>
            <div class="table-responsive">
                <form action="reserve" method="POST" id="form1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Origin</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Depart</th>
                                <th scope="col">Land</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($r['aller'] as $flight) : ?>
                                <input type="hidden" name="clientID" value="<?php echo $_SESSION['clientID'] ?>">
                                <input type="hidden" name="cName" value="<?php echo $_SESSION['username'] ?>">
                                <input type="hidden" name="cEmail" value="<?php echo $_SESSION['email'] ?>">
                                <input type="hidden" name="maxSeats" value="<?php echo $flight['maxSeats'] ?>">
                                <input type="hidden" name="reserved" value="<?php echo $flight['reserved'] ?>">
                                <tr>
                                    <td><?php echo $flight['depart'] ?></td>
                                    <td><?php echo $flight['land'] ?></td>
                                    <td><?php echo $flight['origin'] ?></td>
                                    <td><?php echo $flight['destination'] ?></td>
                                    <input type="hidden" name="flightID" value="<?php echo $flight['id'] ?>">


                                </tr>
                                <tr class="passengers" id="<?php echo $flight['id'] ?>">

                                </tr>
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <i class="fas fa-plus-square fs-2 me-2 addPassenger" style="cursor: pointer;" id="" value="<?php echo $flight['id'] ?>"></i>
                                        <input type="submit" class="btn btn-primary" value="reserve" name="reserveOne">

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        <?php endif; ?>

        </div>
        <script>
            var addBtn = document.querySelectorAll('.addPassenger')
            var i = 0;
            addBtn.forEach((e) => {

                e.addEventListener('click', () => {

                    i++

                    var content = '<td>Passenger #' + i + '</td><td colspan=""><div class="input-group-lg d-flex mb-3 flex-column"><label for="from" class="form-label">Full Name</label><input class="form-control" name="pname[]" type="text" id="pname" placeholder="Name" required></div></td><td colspan=""><div class="input-group-lg d-flex mb-3 flex-column"><label for="from" class="form-label">Date of birth</label><input class="form-control" name="pdob[]" type="date" id="dob" placeholder="Date of Birth" required></div></td>'
                    var div = document.createElement('div')
                    div.classList.add('d-flex')
                    div.style.gap = '10px'

                    var id = document.getElementById(e)
                    var passengers = document.getElementById(e.attributes.value.value)

                    div.innerHTML = content
                    passengers.appendChild(div)



                })
            })
        </script>