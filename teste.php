<?php

include 'conexao.php';

class Teste {
    public $conexao;
    public $conn;

    function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conectar();
    }

    function getTeste() {
        $sql = "SELECT * FROM Bonsai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            echo "<br>";
            echo $row['teste'] . " " . $row['testee'] . " " . $row['testeee'] . " " . $row['testeeee'];
        }
        $this->conexao->fecharConexao($this->conn);
    }
}

$teste = new Teste();
$teste->getTeste();
$teste->getTeste();