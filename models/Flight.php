<?php

class Flight extends DB
{


    public function getAll()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM flight');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOne($data)
    {
        $id = $data;

        try {
            $stmt = $this->connect()->prepare('SELECT * FROM flight WHERE id=:id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $flight = $stmt->fetch(PDO::FETCH_OBJ);
            return $flight;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    public function add($data)
    {
        $stmt = $this->connect()->prepare('INSERT INTO flight (depart,land,origin,destination,maxSeats) VALUES (:depart,:land,:origin,:destination,:maxSeats)');
        $stmt->bindParam(':depart', $data['depart']);
        $stmt->bindParam(':land', $data['land']);
        $stmt->bindParam(':origin', $data['origin']);
        $stmt->bindParam(':destination', $data['destination']);
        $stmt->bindParam(':maxSeats', $data['maxSeats']);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function update($data)
    {
        $stmt = $this->connect()->prepare('UPDATE flight SET depart=:depart,land=:land,origin=:origin,destination=:destination,maxSeats=:maxSeats WHERE id=:id');
        $stmt->bindParam(':depart', $data['depart']);
        $stmt->bindParam(':land', $data['land']);
        $stmt->bindParam(':origin', $data['origin']);
        $stmt->bindParam(':destination', $data['destination']);
        $stmt->bindParam(':maxSeats', $data['maxSeats']);
        $stmt->bindParam(':id', $data['id']);
        var_dump($data);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function delete($data)
    {
        $id = $data;

        try {
            $stmt = $this->connect()->prepare('DELETE FROM flight WHERE id=:id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function getSearch($origin, $destination, $depart, $land)
    {

        try {
            $stmt = $this->connect()->prepare('SELECT * FROM `flight` WHERE `origin` LIKE :origin AND `destination` LIKE :destination AND `depart` LIKE :depart AND `land` LIKE :land');
            $stmt->bindValue(':origin', '%' . $origin . '%');
            $stmt->bindValue(':destination', '%' . $destination . '%');
            $stmt->bindValue(':depart', '%' . $depart . '%');
            $stmt->bindValue(':land', '%' . $land . '%');
            $stmt->execute();
            $flight = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = [
                'aller' => $flight
            ];

            if ($land) {
                $stmt = $this->connect()->prepare('SELECT * FROM `flight` WHERE `origin` LIKE :destination AND `destination` LIKE :origin AND `depart` LIKE :land');
                $stmt->bindValue(':destination', '%' . $destination . '%');
                $stmt->bindValue(':origin', '%' . $origin . '%');
                $stmt->bindValue(':land', '%' . $land . '%');
                $stmt->execute();
                $flightReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $data = [
                    'aller' => $flight,
                    'retour' => $flightReturn
                ];
            }
            return $data;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }


    public function reserve($data)
    {
        if ($data['round'] == false) {

            $stmt = $this->connect()->prepare('INSERT INTO reserve (idClient,idFlight,cName,cEmail) VALUES (:idClient,:idFlight,:cName,:cEmail)');
            $stmt->bindParam(':idClient', $data['clientID']);
            $stmt->bindParam(':idFlight', $data['flightID']);
            $stmt->bindParam(':cName', $data['cName']);
            $stmt->bindParam(':cEmail', $data['cEmail']);

            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'error';
            }
        }
        if ($data['round'] == true) {

            $stmt = $this->connect()->prepare('INSERT INTO reserve (idClient,idFlight,cName,cEmail) VALUES (:idClient,:idFlight,:cName,:cEmail),(:idClient,:idReturn,:cName,:cEmail)');
            $stmt->bindParam(':idClient', $data['clientID']);
            $stmt->bindParam(':idFlight', $data['flightID']);
            $stmt->bindParam(':idReturn', $data['retourID']);
            $stmt->bindParam(':cName', $data['cName']);
            $stmt->bindParam(':cEmail', $data['cEmail']);

            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'error';
            }
        }
    }
}
