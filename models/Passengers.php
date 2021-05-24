<?php

class Passengers extends DB
{

    public function addPassenger($name, $dob)
    {
        if (!isset($last_id)) {

            $sql = $this->connect()->query('SELECT id FROM reserve ORDER BY id DESC LIMIT 1');
            $last_id = $sql->fetch();
        }


        $stmt = $this->connect()->prepare('INSERT INTO passengers (ticketID,name,dob) VALUES (:ticketID,:name,:dob)');
        $stmt->bindParam(':ticketID', $last_id['id']);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':dob', $dob);

        if ($stmt->execute()) {

            return 'ok';
        } else {
            return 'error';
        }
    }

    public function getPassengers()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM passengers');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserPassengers($id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM passengers WHERE ticketID=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updatePassenger($name, $dob, $pid)
    {

        $stmt = $this->connect()->prepare('UPDATE passengers SET name=:name,dob=:dob WHERE id=:id');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':id', $pid);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }
    public function updateReserved($num,$id){

        try {
            $stmt = $this->connect()->prepare('UPDATE flight SET reserved=:reserved WHERE id=:id');
            $stmt->bindParam(':reserved', $num);
            $stmt->bindParam(':id', $id);
    
            $stmt->execute();
    
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
