<?php

namespace App\Backend\Model;

use PDO;

class Produto {
    private $id;
    private $insertDateTime;
    private $nome;
    private $valorCusto;
    private $imagem;
    private $categoria;
    private $valorVenda;
    private $descricao;
    private $estoque;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getInsertDateTime() {
        return $this->insertDateTime;
    }

    public function setInsertDateTime($insertDateTime) {
        $this->insertDateTime = $insertDateTime;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getValorCusto() {
        return $this->valorCusto;
    }

    public function setValorCusto($valorCusto) {
        $this->valorCusto = $valorCusto;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getValorVenda() {
        return $this->valorVenda;
    }

    public function setValorVenda($valorVenda) {
        $this->valorVenda = $valorVenda;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }
}
