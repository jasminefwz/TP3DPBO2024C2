<?php

class DB
{
    // deklarasi variabel
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $result;

    // constructor
    function __construct($hostname, $username, $password, $dbname)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // menghubungkan dengan database
    function open()
    {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    }

    // eksekusi query dari parameter
    function execute($query)
    {
        $this->result = mysqli_query($this->conn, $query);
    }

    // mengambil hasil eksekusi
    function getResult()
    {
        return mysqli_fetch_array($this->result);
    }

    // eksekusi query (insert update delete)
    function executeAffected($query = "")
    {
        // mengeksekusi query
        mysqli_query($this->conn, $query);
        //mengembalikan nilai query
        return mysqli_affected_rows($this->conn);
    }

    // close koneksi dengan db
    function close()
    {
        mysqli_close($this->conn);
    }

    // untuk mendapatkan data makanan dalam bentuk array asosiatif
    function getFoodArray()
    {
        $query = "SELECT id_food, name_food FROM food";
        $this->execute($query);
        $data = array();
        while ($row = mysqli_fetch_assoc($this->result)) {
            $data[] = $row;
        }
        return $data;
    }

    // untuk mendapatkan data restoran dalam bentuk array asosiatif
    function getRestoArray()
    {
        $query = "SELECT id_resto, name_resto FROM resto";
        $this->execute($query);
        $data = array();
        while ($row = mysqli_fetch_assoc($this->result)) {
            $data[] = $row;
        }
        return $data;
    }
}
