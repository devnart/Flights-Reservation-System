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


    <?php if (isset($r['retour'])) : ?>
        <div class="table-responsive">
            <table class="table">
                <h2>Flights</h2>
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
                    <form action="reserve" method="POST">
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
                            <tr>
                                <input type="hidden" name="clientID" value="<?php echo $_SESSION['clientID'] ?>">
                                <td><input type="submit" class="btn btn-primary" value="Reserve" name="reserveRound"></td>
                            </tr>

                </form>
                        <?php endfor; ?>

                </tbody>
            </table>

        <?php endif; ?>

        <?php if (!isset($r['retour'])) : ?>
            <div class="table-responsive">
                <table class="table">
                    <h2>Flights</h2>
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
                            <form action="reserve" method="POST">
                                <input type="hidden" name="clientID" value="<?php echo $_SESSION['clientID'] ?>">
                                <input type="hidden" name="cName" value="<?php echo $_SESSION['username'] ?>">
                                <input type="hidden" name="cEmail" value="<?php echo $_SESSION['email'] ?>">
                                <tr>
                                    <td><?php echo $flight['depart'] ?></td>
                                    <td><?php echo $flight['land'] ?></td>
                                    <td><?php echo $flight['origin'] ?></td>
                                    <td><?php echo $flight['destination'] ?></td>
                                    <input type="hidden" name="flightID" value="<?php echo $flight['id'] ?>">

                                    <td>
                                        <input type="submit" class="btn btn-primary" value="reserve" name="reserveOne">

                                    </td>
                                </tr>
                            </form>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        </div>