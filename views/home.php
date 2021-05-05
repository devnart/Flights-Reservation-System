<div class="container"><?php
                   if(isset($_SESSION['username'])){
                    echo
                    '<a class="btn btn-primary" href="logout">' . $_SESSION['username'] . '</a>';
                   }
                        ?>

    <div class="row">
        <div class="col-lg-6 mt-5 pt-5 ">
            <div class="banner-text pt-5 mt-5">
                <h2>Search For Your Next Flight!</h2>
                <h3 class="typed"></h3>
                <!-- from -->
                <form action="search" method="POST" class='form'>
                    <div class="input-group-lg d-flex mb-3">
                        <label for="from" class="form-label"></label>
                        <input class="form-control" name="from" type="text" id="from" placeholder="From">
                    </div>
                    <!-- to -->
                    <div class="input-group-lg d-flex mb-3">
                        <label for="to" class="form-label"></label>
                        <input class="form-control" type="text" name="to" id="to" placeholder="To">

                    </div>
                    <div class="form-group row d-flex mb-3">
                        <div class="col input-group-lg">
                            <h5 class="fw-bolder">Depart</h5>
                            <input class="form-control" type="date" value="" id="depart" name="depart">
                        </div>
                        <div class="col input-group-lg" style="display: block;">
                            <h5 class="fw-bolder">Return</h5>
                            <input class="form-control" type="date" name="land" value="" id="return" disabled>
                        </div>
                    </div>
                    <!-- date input end -->
                    <!-- radio button star -->
                    <div class="col-lg d-flex">
                        <div class="form-check me-5 ">
                            <input class="form-check-input" type="radio" name="trip" id="oneway" value="option2" checked onchange="check()">
                            <label class="form-check-label" for="oneway">
                                <h5>One Way</h5>
                            </label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="trip" id="roundtrip" value="option2" onchange="check()">
                            <label class="form-check-label" for="roundtrip">
                                <h5>Round Trip</h5>
                            </label>
                        </div>
                    </div>
                    <!-- radio button end -->
                    <!-- reservation button  -->
                    <input type="submit" class="btn btn-primary btn-lg" name="search" value="Search Flights">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var option1 = document.querySelector("#roundtrip")
    var option2 = document.querySelector("#oneway")
    var back = document.querySelector("#return")

    function check() {
        if (option1.checked) {
            console.log("Hi")
            back.removeAttribute('disabled')
        } else if (option2.checked) {
            back.setAttribute('disabled', 'disabled')

        }
    }
</script>