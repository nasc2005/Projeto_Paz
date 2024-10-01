<?php

namespace App\Backend\Model;

use PDO;

class Meta {
    private $id;
    private $idLugarMeta;
    private $usuarioCriador;
    private $insertDateTime;
    private $nome;
    private $valor;
    private $marca;
    private $imgUrl;
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdLugarMeta() {
        return $this->idLugarMeta;
    }

    public function setIdLugarMeta($idLugarMeta) {
        $this->idLugarMeta = $idLugarMeta;
    }

    public function getUsuarioCriador() {
        return $this->usuarioCriador;
    }

    public function setUsuarioCriador($usuarioCriador) {
        $this->usuarioCriador = $usuarioCriador;
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

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function getImgUrl() {
        return $this->imgUrl;
    }

    public function setImgUrl($imgUrl) {
        $this->imgUrl = $imgUrl;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}