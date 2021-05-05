<?php

class User extends DB
{

    public function check_login($email, $password)
    {
  
      $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
      $query = $this->connect()->query($sql);
  
      if ($query->rowCount() > 0) {
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
      } else {
        return false;
      }
    }
    public function userRegister($data){

      $stmt = $this->connect()->prepare('INSERT INTO users (name,email,password,dob) VALUES (:name,:email,:password,:dob)');
      $stmt->bindParam(':name', $data['name']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':password', $data['password']);
      $stmt->bindParam(':dob', $data['dob']);

      if ($stmt->execute()) {
          return 'ok';
      } else {
          return 'error';
      }
    }
}