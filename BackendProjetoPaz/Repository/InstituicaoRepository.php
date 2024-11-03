<?php
namespace App\Backend\Repository;

use App\Backend\Model\Instituicao;
use App\Backend\Config\Database;
use PDO;

class InstituicaoRepository{
    private $conn;
    private $table = "instituicoes";


    public function __construct()
    {
       $this->conn = Database::getInstance(); 
    }

    public function getAllInstituicaos() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInstituicaoById($instituicao_id) {
        $query = "SELECT * FROM $this->table WHERE id_instituicao = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $instituicao_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsuariosByInstituicao($instituicao_id) {
        $query = "SELECT i.nome AS instituicao_nome, u.* FROM instituicoes i
                  JOIN usuarios u ON u.id_instituicao = i.id_instituicao
                  WHERE i.id_instituicao = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $instituicao_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllLugaresByInstituicao($instituicao_id) {
        $query = "SELECT i.nome AS instituicao_nome, l.* FROM instituicoes i
                  JOIN lugares l ON l.id_instituicaoLugar = i.id_instituicao
                  WHERE i.id_instituicao = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $instituicao_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   
    
    public function insertInstituicao(Instituicao $instituicao) {
        $nome = $instituicao->getNome();
        $descricao = $instituicao->getDescricao();
        $logo = $instituicao->getLogo();
        $saldo = $instituicao->getSaldo();
        $query = "INSERT INTO $this->table (nome, descricao, logo, saldo) 
                  VALUES (:nome, :descricao, :logo, :saldo)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":logo", $logo);
        $stmt->bindParam(":saldo", $saldo);

        return $stmt->execute();
    }

    public function updateInstituicao(Instituicao $instituicao) {
        $instituicao_id = $instituicao->getId();
        $nome = $instituicao->getNome();
        $descricao = $instituicao->getDescricao();
        $logo = $instituicao->getLogo();
        $saldo = $instituicao->getSaldo();
        $query = "UPDATE $this->table 
                  SET 
                    nome = :nome, 
                    descricao = :descricao, 
                    logo = :logo, 
                    saldo = :saldo 
                  WHERE id_instituicao = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":logo", $logo);
        $stmt->bindParam(":saldo", $saldo);
        $stmt->bindParam(":id", $instituicao_id);
    
        return $stmt->execute();
    }
    
    public function deleteInstituicao($instituicao_id) {
        $query = "DELETE FROM $this->table WHERE id_instituicao = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $instituicao_id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
}