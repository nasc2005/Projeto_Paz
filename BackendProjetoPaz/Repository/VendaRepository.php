<?php
namespace App\Backend\Repository;

use App\Backend\Model\Venda;
use App\Backend\Config\Database;
use PDO;

class VendaRepository {
    private $conn;
    private $table = "vendas";

    public function __construct() {
        $this->conn = Database::getInstance(); 
    }

    public function insertVenda(Venda $venda) {
        $idUserVenda = $venda->getIdUserVenda();
        $idLugarVenda = $venda->getIdLugarVenda();
        $idImgsVenda = $venda->getIdImgsVenda();
        $insertDateTime = $venda->getInsertDateTime();
        $total = $venda->getTotal();
        $status = $venda->getStatus();
        $formaPagamento = $venda->getFormaPagamento();

        $query = "INSERT INTO $this->table 
                    (idUserVenda, idLugarVenda, idImgsVenda, insertDateTime, total, status, formaPagamento)
                  VALUES 
                    (:idUserVenda, :idLugarVenda, :idImgsVenda, :insertDateTime, :total, :status, :formaPagamento)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idUserVenda", $idUserVenda);
        $stmt->bindParam(":idLugarVenda", $idLugarVenda);
        $stmt->bindParam(":idImgsVenda", $idImgsVenda);
        $stmt->bindParam(":insertDateTime", $insertDateTime);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":formaPagamento", $formaPagamento);

        return $stmt->execute();
    }

    public function getAllVendas() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVendaById($venda_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $venda_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateVenda(Venda $venda) {
        $venda_id = $venda->getId();
        $idUserVenda = $venda->getIdUserVenda();
        $idLugarVenda = $venda->getIdLugarVenda();
        $idImgsVenda = $venda->getIdImgsVenda();
        $insertDateTime = $venda->getInsertDateTime();
        $total = $venda->getTotal();
        $status = $venda->getStatus();
        $formaPagamento = $venda->getFormaPagamento();

        $query = "UPDATE $this->table SET 
                    idUserVenda = :idUserVenda, 
                    idLugarVenda = :idLugarVenda, 
                    idImgsVenda = :idImgsVenda, 
                    insertDateTime = :insertDateTime, 
                    total = :total, 
                    status = :status, 
                    formaPagamento = :formaPagamento
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idUserVenda", $idUserVenda);
        $stmt->bindParam(":idLugarVenda", $idLugarVenda);
        $stmt->bindParam(":idImgsVenda", $idImgsVenda);
        $stmt->bindParam(":insertDateTime", $insertDateTime);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":formaPagamento", $formaPagamento);
        $stmt->bindParam(":id", $venda_id);

        return $stmt->execute();
    }

    public function deleteVenda($venda_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $venda_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}