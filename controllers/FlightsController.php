<?php
class FlightsController extends Flight

{



    public function getAllFlights()
    {
        $flights = $this->getAll();
        return $flights;
    }

    public function getOneFlight()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $flight = $this->getOne($id);
            return $flight;
        }
    }


    public function addFlight()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'depart' => $_POST['depart'],
                'land' => $_POST['land'],
                'origin' => $_POST['origin'],
                'destination' => $_POST['destination'],
                'maxSeats' => $_POST['maxSeats'],
            );
            $result = $this->add($data);
            if ($result === 'ok') {
                header('location:dashboard');
            } else {
                echo $result;
            }
        }
    }


    public function updateFlight()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'id' => $_POST['id'],
                'depart' => $_POST['depart'],
                'land' => $_POST['land'],
                'origin' => $_POST['origin'],
                'destination' => $_POST['destination'],
                'maxSeats' => $_POST['maxSeats'],
            );
            $result = $this->update($data);
            if ($result === 'ok') {
                $sessionn = new Session;
                $sessionn->set('success', 'Updated Successfuly');
                header('location:dashboard');
            } else {
                echo $result;
            }
        }
    }

    public function deleteFlight()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $this->delete($id);
            header('location:' . BASE_URL);
        }
    }

    public function searchFlight()
    {
        if (isset($_POST['search'])) {
            $land = "";
            $origin = $_POST['from'];
            $destination = $_POST['to'];
            $depart = $_POST['depart'];
            if (isset($_POST['land'])) {

                $land = $_POST['land'];
            }
            $search = $this->getSearch($origin, $destination, $depart, $land);
            return $search;


            // header('location:'.BASE_URL);
        }
    }

    public function getAllReserved()
    {
        $flights = $this->getReserved();
        return $flights;
    }

    public function getUserReservation($data)
    {

        $reservation = $this->getUserReserved($data);
        return $reservation;

    }


    public function reserveFlight()
    {
        if (isset($_POST['reserveOne'])) {

            $data = array(
                'flightID' => $_POST['flightID'],
                'clientID' => $_POST['clientID'],
                'cName' => $_POST['cName'],
                'cEmail' => $_POST['cEmail'],
                'round' => false,
            );
            if (!isset($_POST['pname'])) {
                $data = array(
                    'flightID' => $_POST['flightID'],
                    'clientID' => $_POST['clientID'],
                    'cName' => $_POST['cName'],
                    'cEmail' => $_POST['cEmail'],
                    'round' => false,
                );
            }
        }
        if (isset($_POST['reserveRound'])) {
            $data = array(
                'flightID' => $_POST['allerID'],
                'retourID' => $_POST['retourID'],
                'clientID' => $_POST['clientID'],
                'cName' => $_POST['cName'],
                'cEmail' => $_POST['cEmail'],
                'round' => true,
            );
        }

        $result = $this->reserve($data);
        if ($result == 'ok') {
            Session::set('success', 'Reserved');

            // var_dump($result);
            header('location:home');
        } elseif ($result == 'error') {
            Session::set('error', 'Something went wrong');
            header('location:home');
        }
    }

    public function deleteReservation(){
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $this->deleteReserve($id);
            header('location:reservedFlights');
        }
    }


    public function updateReservation()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'id' => $_POST['id'],
                'depart' => $_POST['depart'],
                'land' => $_POST['land'],
                'origin' => $_POST['origin'],
                'destination' => $_POST['destination'],
                'passengers' => $_POST['passengers'],
            );
            $result = $this->update($data);
            if ($result === 'ok') {
                Session::set('Success', 'Updated Successfully');
                header('location:userFlights');
            } else {
                echo $result;
            }
        }
    }

}
