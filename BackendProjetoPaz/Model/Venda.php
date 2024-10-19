<?php

namespace App\Backend\Model;

use PDO;

class Venda {
    
    private $id;
    private $idUsuario;
    private $idLugar;
    private $idImgsVenda;
    private $insertDateTime;
    private $total;
    private $statusVenda;
    private $formaPagamento;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getIdLugar() {
        return $this->idLugar;
    }

    public function setIdLugar($idLugar) {
        $this->idLugar = $idLugar;
    }

    public function getIdImgsVenda() {
        return $this->idImgsVenda;
    }

    public function setIdImgsVenda($idImgsVenda) {
        $this->idImgsVenda = $idImgsVenda;
    }

    public function getInsertDateTime() {
        return $this->insertDateTime;
    }

    public function setInsertDateTime($insertDateTime) {
        $this->insertDateTime = $insertDateTime;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getStatusVenda() {
        return $this->statusVenda;
    }

    public function setStatusVenda($statusVenda) {
        $this->statusVenda = $statusVenda;
    }

    public function getFormaPagamento() {
        return $this->formaPagamento;
    }

    public function setFormaPagamento($formaPagamento) {
        $this->formaPagamento = $formaPagamento;
    }
}