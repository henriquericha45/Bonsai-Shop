<?php
include "conexao.php";

// funcao para criar um bonsai

function criarBonsai($nome, $preco) {
    $conn = new Conexao();
    $conn = $conn->conectar();
    $sql = "INSERT INTO Bonsai (nome, preco) VALUES ('$nome', '$preco')";
    $conn->exec($sql);
    $conn = null;
    echo 'bonsai criado com sucesso';
}

function getTeste() {
    $conn = new Conexao();
    $sql = "SELECT * FROM bonsai";
    $stmt = $conn->conectar()->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
        echo "<br>";
        echo $row['nome'] . " | " . $row['preco'] . " | " . $row['id_bonsai'];
        ?>
        <img class="tamanhoFoto" src='<?php echo $row['image_dir'] ?> '>

        <?php
    }
    $conn->fecharConexao($conn);
}

//criarBonsai('Caliandra', 87.5);

getTeste();

?>

<style>
    .tamanhoFoto {
        width: 100px;
        height: 100px;
    }
</style>