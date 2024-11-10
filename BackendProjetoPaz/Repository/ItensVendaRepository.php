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
        $id_produto = $itensVenda->getIdProduto();
        $id_venda = $itensVenda->getIdVenda();
        $quantidade = $itensVenda->getQuantidade();
        $preco_unitario = $itensVenda->getPrecoUnitario();
        $subtotal = $itensVenda->getSubtotal();

        $query = "INSERT INTO $this->table 
                    (
                    id_produto, id_venda, 
                    quantidade, preco_unitario, subtotal
                    )
                  VALUES (:id_produto, :id_venda, :quantidade, :preco_unitario, :subtotal)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_produto", $id_produto);
        $stmt->bindParam(":id_venda", $id_venda);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":preco_unitario", $preco_unitario);
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
        $id_itensVenda = $itensVenda->getId();
        $id_produto = $itensVenda->getIdProduto();
        $id_venda = $itensVenda->getIdVenda();
        $quantidade = $itensVenda->getQuantidade();
        $preco_unitario = $itensVenda->getPrecoUnitario();
        $subtotal = $itensVenda->getSubtotal();

        $query = "UPDATE $this->table 
                  SET 
                    id_produto = :idProduto, 
                    id_venda = :idVenda, 
                    quantidade = :quantidade, 
                    precoUnitario = :precoUnitario, 
                    subtotal = :subtotal
                  WHERE id_itensVenda = :id_itensVenda";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_produto", $id_produto);
        $stmt->bindParam(":id_venda", $id_venda);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":preco_unitario", $preco_unitario);
        $stmt->bindParam(":subtotal", $subtotal);
        $stmt->bindParam(":id_itensVenda", $id_itensVenda);

        return $stmt->execute();
    }

    public function deleteItensVenda($id_itensVenda) {
        $query = "DELETE FROM $this->table WHERE id_itensVenda = :id_itensVenda";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_itensVenda", $id_itensVenda, PDO::PARAM_INT);

        return $stmt->execute();
    }
}