<?php
namespace App\Backend\Repository;

use App\Backend\Model\Produto;
use App\Backend\Config\Database;
use PDO;

class ProdutoRepository{
    private $conn;
    private $table = "produtos";


    public function __construct()
    {
       $this->conn = Database::getInstance(); 
    }
    
    public function insertproduto(Produto $produto) {
        $nome = $produto->getNome();
        $valorCusto = $produto->getValorCusto();
        $logo = $produto->getLogo();
        $saldo = $produto->getSaldo();
        $insertdatetime = $produto->getInsertDateTime();
        $query = "INSERT INTO $this->table (nome, valorCusto, logo, saldo, insertDateTime) VALUES (:nome, :valorCusto, :logo, :Saldo, :insertDateTime)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valorCusto", $valorCusto);
        $stmt->bindParam(":logo", $logo);
        $stmt->bindParam(":saldo", $saldo);
        $stmt->bindParam(":insertDateTime", $insertdatetime);

        return $stmt->execute();
    }

    public function getAllprodutos() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getprodutoById($produto_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $produto_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateproduto(Produto $produto) {
        $produto_id = $produto->getId();
        $nome = $produto->getNome();
        $valorCusto = $produto->getValorCusto();
        $logo = $produto->getLogo();
        $saldo = $produto->getSaldo();

        $query = "UPDATE $this->table SET nome = :nome, valorCusto = :valorCusto, logo = :logo, saldo = :saldo WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valorCusto", $valorCusto);
        $stmt->bindParam(":logo", $logo);
        $stmt->bindParam(":saldo", $saldo);
        $stmt->bindParam(":id", $produto_id);
    
        return $stmt->execute();
    }
    
    public function deleteproduto($produto_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $produto_id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
}