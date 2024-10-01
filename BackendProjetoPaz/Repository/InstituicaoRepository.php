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
    
    
    
    public function insertInstituicao(Instituicao $instituicao) {
        $nome = $instituicao->getNome();
        $descricao = $instituicao->getDescricao();
        $logo = $instituicao->getLogo();
        $saldo = $instituicao->getSaldo();
        $insertdatetime = $instituicao->getInsertDateTime();
        $query = "INSERT INTO $this->table (nome, descricao, logo, saldo, insertDateTime) VALUES (:nome, :descricao, :logo, :Saldo, :insertDateTime)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":logo", $logo);
        $stmt->bindParam(":saldo", $saldo);
        $stmt->bindParam(":insertDateTime", $insertdatetime);

        return $stmt->execute();
    }

    public function getAllInstituicaos() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInstituicaoById($instituicao_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $instituicao_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateInstituicao(Instituicao $instituicao) {
        $instituicao_id = $instituicao->getId();
        $nome = $instituicao->getNome();
        $descricao = $instituicao->getDescricao();
        $logo = $instituicao->getLogo();
        $saldo = $instituicao->getSaldo();

        $query = "UPDATE $this->table SET nome = :nome, descricao = :descricao, logo = :logo, saldo = :saldo WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":logo", $logo);
        $stmt->bindParam(":saldo", $saldo);
        $stmt->bindParam(":id", $instituicao_id);
    
        return $stmt->execute();
    }
    
    public function deleteInstituicao($instituicao_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $instituicao_id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
}
