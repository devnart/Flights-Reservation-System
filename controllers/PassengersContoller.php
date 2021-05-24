<?php
class PassengersContoller extends Passengers

{

    public function passegners()
    {

        if (isset($_POST['pname'])) {
            $count = count($_POST['pname']);
            // echo $count;

            if($_POST['reserved'] + $count > $_POST['maxSeats']) {
                Session::set('error', 'Max Reached');
                header('location:home');
            }else {

                for ($i = 0; $i < $count; $i++) {
                    $name = $_POST['pname'][$i];
                    $dob = $_POST['pdob'][$i];
    
                    $resultp = $this->addPassenger($name, $dob);
                    if ($resultp == 'ok') {
                        Session::set('success', 'Reserved Successfully');
    
                        // var_dump($result);
                        header('location:home');
                    } elseif ($resultp == 'error') {
                        Session::set('error', 'Something went wrong');
                        header('location:home');
                    }
                }
                $num = $_POST['reserved'] + $count;
                $updateReserved = $this->updateReserved($num,$_POST['flightID']);
            }
        }
    }

    public function allPassengers()
    {
        $passengers = $this->getPassengers();
        return $passengers;
    }

    public function userPassengers($id)
    {
        $passengers = $this->getUserPassengers($id);
        return $passengers;
    }

    public function updateUserPassenger(){
        
        if (isset($_POST['pname'])) {
            $count = count($_POST['pname']);
            // echo $count;
            
            for ($i = 0; $i < $count; $i++) {
                $name = $_POST['pname'][$i];
                $dob = $_POST['pdob'][$i];
                $pid = $_POST['pid'][$i];

                $resultp = $this->updatePassenger($name, $dob,$pid);
                if ($resultp == 'ok') {
                    Session::set('success', 'Updated Successfully');
                    header('location:userFlights');
                } elseif ($resultp == 'error') {
                    Session::set('error', 'Something went wrong');
                    header('location:userFlights');
                }
            }
        }
    }
}
