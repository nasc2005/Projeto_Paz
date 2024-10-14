<?php

namespace App\Backend\Model;

use PDO;

class Usuario {
    private $id;
    private $idInstituicao;
    private $insertDateTime;
    private $nome;
    private $email;
    private $senha;
    private $perfil;
    private $cpf;
    private $telefone;
    private $dataNasc;
    private $imagem;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getIdInstituicao() {
        return $this->idInstituicao;
    }
    
    public function setIdInstituicao($idInstituicao) {
        $this->idInstituicao = $idInstituicao;
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
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function getPerfil() {
        return $this->perfil;
    }
    
    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function getCpf() {
        return $this->cpf;
    }
    
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getTelefone() {
        return $this->telefone;
    }
    
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getDataNasc() {
        return $this->dataNasc;
    }
    
    public function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }
    public function getImagem() {
        return $this->imagem;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
}