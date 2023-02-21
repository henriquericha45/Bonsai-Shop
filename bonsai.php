<?php
class Bonsai {
    public $nome;
    public $preco;
    public $id;
    public $imagem_dir;
    public $descricao;
    public $quantidade;

    function setId($id) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function setName($nome) {
        $this->nome = $nome;
    }

    function getName() {
        return $this->nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setImagemDir($imagem_dir) {
        $this->imagem_dir = $imagem_dir;
    }

    function getImagemDir() {
        return $this->imagem_dir;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

    function getPreco() {
        return $this->preco;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function getQuantidade() {
        return $this->quantidade;
    }



    public function __construct($id, $nome, $descricao, $imagem_dir, $preco, $quantidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem_dir = $imagem_dir;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }   
}

$teste = new Bonsai(1, "Bonsai 1", "Descrição do Bonsai 1", "imagem", 10, 10);
echo "<h1>".$teste->getId()."</h1>";
echo '<hr>';
echo $teste->getName();
echo '<hr>';
echo $teste->getDescricao();
echo '<hr>';
echo $teste->getImagemDir();
echo '<hr>';
echo $teste->getPreco();
echo '<hr>';
echo $teste->getQuantidade();
?>