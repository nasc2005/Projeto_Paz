<?php
namespace App\Backend\Repository;

use App\Backend\Model\ItensVenda;
use App\Backend\Config\Database;
use PDO;

class ItensVendaRepository {
    private $conn;
    private $table = "itens_vendas";

    public function __construct()
    {
        $this->conn = Database::getInstance(); 
    }

    public function insertItensVenda(ItensVenda $itensVenda) {
        $idProduto = $itensVenda->getIdProduto();
        $idVenda = $itensVenda->getIdVenda();
        $quantidade = $itensVenda->getQuantidade();
        $precoUnitario = $itensVenda->getPrecoUnitario();
        $subtotal = $itensVenda->getSubtotal();

        $query = "INSERT INTO $this->table 
                    (
                    id_produto, 
                    id_venda, 
                    quantidade, 
                    preco_unitario, 
                    subtotal
                    )
                  VALUES (:idProduto, :idVenda, :quantidade, :precoUnitario, :subtotal)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idProduto", $idProduto);
        $stmt->bindParam(":idVenda", $idVenda);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":precoUnitario", $precoUnitario);
        $stmt->bindParam(":subtotal", $subtotal);

        return $stmt->execute();
    }

    public function getAllItensVenda() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItensVendaById($itensVenda_id) {
        $query = "SELECT * FROM $this->table WHERE id_itensVenda = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $itensVenda_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateItensVenda(ItensVenda $itensVenda) {
        $itensVenda_id = $itensVenda->getId();
        $idProduto = $itensVenda->getIdProduto();
        $idVenda = $itensVenda->getIdVenda();
        $quantidade = $itensVenda->getQuantidade();
        $precoUnitario = $itensVenda->getPrecoUnitario();
        $subtotal = $itensVenda->getSubtotal();

        $query = "UPDATE $this->table 
                  SET 
                    id_produto = :idProduto, 
                    id_venda = :idVenda, 
                    quantidade = :quantidade, 
                    precoUnitario = :precoUnitario, 
                    subtotal = :subtotal
                  WHERE id_itensVenda = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idProduto", $idProduto);
        $stmt->bindParam(":idVenda", $idVenda);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":precoUnitario", $precoUnitario);
        $stmt->bindParam(":subtotal", $subtotal);
        $stmt->bindParam(":id", $itensVenda_id);

        return $stmt->execute();
    }

    public function deleteItensVenda($itensVenda_id) {
        $query = "DELETE FROM $this->table WHERE id_itensVenda = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $itensVenda_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}