<?php

namespace App\Backend\Model;

use PDO;

class Lugar {

    private $id;
    private $idInstLugar;
    private $insertDateTime;
    private $apelido;
    private $endereco;
    private $numero;
    private $arranjo;

    //Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdInstLugar() {
        return $this->idInstLugar;
    }

    public function setIdInstLugar($idInstLugar) {
        $this->idInstLugar = $idInstLugar;
    }

    public function getInsertDateTime() {
        return $this->insertDateTime;
    }

    public function setInsertDateTime($insertDateTime) {
        $this->insertDateTime = $insertDateTime;
    }

    public function getApelido() {
        return $this->apelido;
    }

    public function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getArranjo() {
        return $this->arranjo;
    }

    public function setArranjo($arranjo) {
        $this->arranjo = $arranjo;
    }
}