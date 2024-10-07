<?php
namespace App\Backend\Repository;

use App\Backend\Model\Produto;
use App\Backend\Config\Database;
use PDO;

class ProdutoRepository {
    private $conn;
    private $table = "produtos";

    public function __construct()
    {
        $this->conn = Database::getInstance(); 
    }

    public function insertProduto(Produto $produto) {
        $nome = $produto->getNome();
        $valorCusto = $produto->getValorCusto();
        $imgUrl = $produto->getImgUrl();
        $categoria = $produto->getCategoria();
        $valorVenda = $produto->getValorVenda();
        $descricao = $produto->getDescricao();
        $estoque = $produto->getEstoque();
        $insertDateTime = $produto->getInsertDateTime();

        $query = "INSERT INTO $this->table (nome, valorCusto, imgUrl, categoria, valorVenda, descricao, estoque, insertDateTime)
                  VALUES (:nome, :valorCusto, :imgUrl, :categoria, :valorVenda, :descricao, :estoque, :insertDateTime)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valorCusto", $valorCusto);
        $stmt->bindParam(":imgUrl", $imgUrl);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":valorVenda", $valorVenda);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":insertDateTime", $insertDateTime);

        return $stmt->execute();
    }

    public function getAllProdutos() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutoById($produto_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $produto_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduto(Produto $produto) {
        $produto_id = $produto->getId();
        $nome = $produto->getNome();
        $valorCusto = $produto->getValorCusto();
        $imgUrl = $produto->getImgUrl();
        $categoria = $produto->getCategoria();
        $valorVenda = $produto->getValorVenda();
        $descricao = $produto->getDescricao();
        $estoque = $produto->getEstoque();

        $query = "UPDATE $this->table SET 
                    nome = :nome, 
                    valorCusto = :valorCusto, 
                    imgUrl = :imgUrl, 
                    categoria = :categoria, 
                    valorVenda = :valorVenda, 
                    descricao = :descricao, 
                    estoque = :estoque
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valorCusto", $valorCusto);
        $stmt->bindParam(":imgUrl", $imgUrl);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":valorVenda", $valorVenda);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":id", $produto_id);

        return $stmt->execute();
    }

    public function deleteProduto($produto_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $produto_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}