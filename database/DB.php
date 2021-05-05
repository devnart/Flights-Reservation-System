<?php

class db
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'flight';

    public function connect()
    {


        $db = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        return $db;
    }
}
