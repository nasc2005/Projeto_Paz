<?php

namespace App\Backend\Model;

use PDO;

class Meta {
    private $id;
    private $idLugar;
    private $usuarioCriador;
    private $insertDateTime;
    private $nome;
    private $valor;
    private $marca;
    private $imagem;
    private $statusMeta;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdLugar() {
        return $this->idLugar;
    }

    public function setIdLugar($idLugar) {
        $this->idLugar = $idLugar;
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

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getStatusMeta() {
        return $this->statusMeta;
    }

    public function setStatusMeta($statusMeta) {
        $this->statusMeta = $statusMeta;
    }
}