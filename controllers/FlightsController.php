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
                header('location:' . BASE_URL);
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
                $sessionn->set('success','Updated Successfuly');
                header('location:' . BASE_URL);
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

    public function searchFlight(){
        if(isset($_POST['search'])){
            $land ="";
            $origin = $_POST['from'];
            $destination = $_POST['to'];
            $depart = $_POST['depart'];
            if(isset($_POST['land'])) {

                $land = $_POST['land'];
            }
            $search = $this->getSearch($origin,$destination,$depart,$land);
            return $search;
            header('location:'.BASE_URL);
        }
    }

}