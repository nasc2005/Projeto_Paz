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
    

    public function getAllResumoVendas() {
        $query = "SELECT v.id_venda, v.status_venda, v.forma_pagamento, v.data_criacao, SUM(iv.quantidade * p.valor_venda) AS valor_total
                  FROM $this->table v
                  JOIN itens_vendas iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  GROUP BY v.id_venda, v.data_criacao";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResumoVendasByUsuario($usuario_id) {
        $query = "SELECT v.id_venda, v.data_criacao, v.status_venda, v.forma_pagamento, SUM(iv.quantidade * p.valor_venda) AS valor_total
                  FROM $this->table v
                  JOIN itens_vendas iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  WHERE v.id_usuario = :id
                  GROUP BY v.id_venda, v.data_criacao";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResumoVendasByLugar($lugar_id) {
        $query = "SELECT v.id_venda, v.data_criacao, v.status_venda, v.forma_pagamento, SUM(iv.quantidade * p.valor_venda) AS valor_total
                  FROM $this->table v
                  JOIN itens_vendas iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  WHERE v.id_lugar = :id
                  GROUP BY v.id_venda, v.data_criacao";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $lugar_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDetalhesVenda($venda_id) {
        $query = "SELECT v.id_venda, v.data_criacao, v.status_venda, v.forma_pagamento, iv.quantidade,
                         p.id_produto, p.nome, (iv.quantidade * p.valor_venda) AS valor_item, p.valor_custo, p.valor_venda,
                         imgv.*
                  FROM vendas v
                  JOIN itens_vendas iv ON iv.id_venda = v.id_venda
                  JOIN produtos p ON p.id_produto = iv.id_produto
                  LEFT JOIN imgs_vendas imgv ON imgv.id_imgsVenda = v.id_imgsVenda
                  WHERE v.id_venda = :id;";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $venda_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function insertVenda(Venda $venda) {
        $id_usuario = $venda->getIdUsuario();
        $id_lugar = $venda->getIdLugar();
        $id_imgsVenda = $venda->getIdImgsVenda();
        $total = $venda->getTotal();
        $forma_pagamento = $venda->getFormaPagamento();
        $status_venda = $venda->getStatusVenda();
    
        $query = "INSERT INTO $this->table (
                    id_usuario, id_lugar, id_imgsVenda,
                    total, forma_pagamento, status_venda 
                  )
                  VALUES (
                    :id_usuario, :id_lugar, :id_imgsVenda, 
                    :total, :forma_pagamento, :status_venda
                  )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":id_lugar", $id_lugar);
        $stmt->bindParam(":id_imgsVenda", $id_imgsVenda);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":forma_pagamento", $forma_pagamento);
        $stmt->bindParam(":status_venda", $status_venda);
    
        // Execute a query e retorna o ID gerado
        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Retorna o ID da venda inserida
        } else {
            return false;
        }
    }    

    public function updateVenda($venda) {
        $query = "UPDATE $this->table
                  SET total = :total,
                      forma_pagamento = :forma_pagamento,
                      status_venda = :status_venda
                  WHERE id_venda = :id_venda";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":total", $venda->getTotal());
        $stmt->bindParam(":forma_pagamento", $venda->getFormaPagamento());
        $stmt->bindParam(":status_venda", $venda->getStatusVenda());
        $stmt->bindParam(":id_venda", $venda->getId());
    
        return $stmt->execute();
    }    

    public function deleteVenda($venda_id) {
        $query = "DELETE FROM $this->table WHERE id_venda = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $venda_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}