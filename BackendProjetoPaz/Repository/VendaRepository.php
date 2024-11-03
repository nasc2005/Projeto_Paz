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

    /*
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
    */
    public function getAllResumoVendas() {
        $query = "SELECT v.id_venda, v.data_criacao, v.status_venda, v.formaPagamento, SUM(iv.quantidade * p.valor_venda) AS valor_total
                  FROM vendas v
                  JOIN itens_venda iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  GROUP BY v.id_venda, v.data_criacao";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResumoVendasByUsuario($usuario_id) {
        $query = "SELECT v.id_venda, v.data_criacao, v.status_venda, v.formaPagamento, SUM(iv.quantidade * p.valor_venda) AS valor_total
                  FROM vendas v
                  JOIN itens_venda iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  WHERE v.id_usuarioVenda = :id
                  GROUP BY v.id_venda, v.data_criacao";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResumoVendasByLugar($lugar_id) {
        $query = "SELECT v.id_venda, v.data_criacao, v.status_venda, v.formaPagamento, SUM(iv.quantidade * p.valor_venda) AS valor_total
                  FROM vendas v
                  JOIN itens_venda iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  WHERE v.id_lugarVenda = :id
                  GROUP BY v.id_venda, v.data_criacao";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $lugar_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDetalhesVenda($venda_id) {
        $query = "SELECT v.id_venda, v.data_criacao, v.status_venda, v.formaPagamento,
                         iv.quantidade,
                         p.nome, (iv.quantidade * p.preco) AS valor_item, p.valor_custo, p.valor_venda 
                         imgv.*
                  FROM vendas v
                  JOIN itens_venda iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  JOIN 
                  LEFT JOIN imagens_venda imgv ON imgv.id_imgsVenda = v.id_imgsVenda
                  WHERE v.id_venda = :venda_id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $venda_id, PDO::PARAM_INT);
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