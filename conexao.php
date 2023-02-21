<?php

class Conexao {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";

    public function conectar() {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=BonsaiShop", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function fecharConexao($conn) {
        $conn = null;
    }
}