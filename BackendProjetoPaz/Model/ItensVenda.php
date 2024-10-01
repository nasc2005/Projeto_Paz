<?php

namespace App\Backend\Model;

use PDO;

class ItensVenda {
    private $id;
    private $idProduto;
    private $idVenda;
    private $quantidade;
    private $precoUnitario;
    private $subtotal;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function getIdVenda() {
        return $this->idVenda;
    }

    public function setIdVenda($idVenda) {
        $this->idVenda = $idVenda;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getPrecoUnitario() {
        return $this->precoUnitario;
    }

    public function setPrecoUnitario($precoUnitario) {
        $this->precoUnitario = $precoUnitario;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }
}