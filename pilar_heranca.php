<?php

class Veiculo {
    private $placa;
    private $cor;

    function acelerar() {
        echo "Acelerando...";
    }
}


class Carro extends Veiculo {
    private $teto_solar = true;

    function abrirTetoSolar() {
        echo "Abrindo teto solar...";
    }

    function alterarPosicaoVolante() {
        echo "Alterando posição do volante...";
    }
}

class Moto extends Veiculo {
    private $contra_peso_guidao = true;

    function empinar() {
        echo "Empinando...";
    } 
}

$carro = new Carro();
$moto = new Moto();

echo '<pre>';
$moto->acelerar();
echo '<br>';
$carro->acelerar();
echo '<br>';

print_r($carro);
echo '<br>';
echo '<br>';
print_r($moto);

?>