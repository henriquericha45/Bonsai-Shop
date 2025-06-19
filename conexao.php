<?php
class Conexao {
    private $host = 'localhost';
    private $dbname = 'BonsaiShop';
    private $usuario = 'root';
    private $senha = '';

    public function conectar() {
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->usuario, $this->senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            // Nunca exiba erros diretamente em produção
            error_log("Erro na conexão: " . $e->getMessage());
            die("Erro interno ao conectar ao banco de dados.");
        }
    }

    public function fecharConexao(&$conn) {
        $conn = null;
    }
}
?>