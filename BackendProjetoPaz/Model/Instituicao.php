<?php

namespace App\Backend\Model;

use PDO;

class Instituicao {
    private $id;
    private $insertDateTime;
    private $nome;
    private $descricao;
    private $logo;
    private $saldo;
    
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
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    public function getLogo() {
        return $this->logo;
    }
    
    public function setLogo($logo) {
        $this->logo = $logo;
    }
    
    public function getSaldo() {
        return $this->saldo;
    }
    
    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

}