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

                                    <td class="d-flex align-items-center">
                                        <i class="fas fa-plus-square fs-2 me-2 addPassenger" style="cursor: pointer;" id=""  value="<?php echo $flight['id']?>"></i>
                                        <input type="submit" class="btn btn-primary" value="reserve" name="reserveOne">

                                    </td>
                                </tr>
                                <tr class="passengers" id="<?php echo $flight['id'] ?>">
                                  
                                </tr>
                            </form>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        </div>
        <script>
            var addBtn = document.querySelectorAll('.addPassenger')
            
            addBtn.forEach((e) => {
                var i = 0;
                e.addEventListener('click', ()=> {
                    i++
                    var content = '<td>Passenger #1</td><td colspan=""><div class="input-group-lg d-flex mb-3 flex-column"><label for="from" class="form-label">Full Name</label><input class="form-control" name="pname'+ i +'" type="text" id="pname" placeholder="Name" required></div></td><td colspan=""><div class="input-group-lg d-flex mb-3 flex-column"><label for="from" class="form-label">Date of birth</label><input class="form-control" name="pdob'+i+'" type="text" id="dob" placeholder="Name" required></div></td>'
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