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

    public function getAllVendas() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVendaById($venda_id) {
        $query = "SELECT * FROM $this->table WHERE id_venda = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $venda_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllItensVenda($id_instituicao) {
        $query = "SELECT v*, iv.* FROM vendas v
                  JOIN itens_venda iv ON iv.id_venda = v.id_venda";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertVenda(Venda $venda) {
        $idUsuario = $venda->getIdUsuario();
        $idLugar = $venda->getIdLugar();
        $idImgsVenda = $venda->getIdImgsVenda();
        $total = $venda->getTotal();
        $statusVenda = $venda->getStatusVenda();
        $formaPagamento = $venda->getFormaPagamento();

        $query = "INSERT INTO $this->table (
                    id_usuarioVenda, id_lugarVenda, id_imgsVenda,
                    total, status_venda, formaPagamento
                    )
                  VALUES (
                    :idUsuario, :idLugar, :idImgsVenda, 
                    :total, :statusVenda, :formaPagamento
                    )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->bindParam(":idLugar", $idLugar);
        $stmt->bindParam(":idImgsVenda", $idImgsVenda);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":statusVenda", $statusVenda);
        $stmt->bindParam(":formaPagamento", $formaPagamento);

        return $stmt->execute();
    }

    public function updateVenda(Venda $venda) {
        $venda_id = $venda->getId();
        $idUsuario = $venda->getIdUsuario();
        $idLugar = $venda->getIdLugar();
        $idImgsVenda = $venda->getIdImgsVenda();
        $total = $venda->getTotal();
        $statusVenda = $venda->getStatusVenda();
        $formaPagamento = $venda->getFormaPagamento();

        $query = "UPDATE $this->table SET 
                    id_usuarioVenda = :idUsuario, 
                    id_lugarVenda = :idLugar, 
                    id_imgsVenda = :idImgsVenda,
                    total = :total, 
                    status_venda = :statusVenda, 
                    formaPagamento = :formaPagamento
                  WHERE id_venda = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->bindParam(":idLugar", $idLugar);
        $stmt->bindParam(":idImgsVenda", $idImgsVenda);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":statusVenda", $statusVenda);
        $stmt->bindParam(":formaPagamento", $formaPagamento);
        $stmt->bindParam(":id", $venda_id);

        return $stmt->execute();
    }

    public function deleteVenda($venda_id) {
        $query = "DELETE FROM $this->table WHERE id_venda = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $venda_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}