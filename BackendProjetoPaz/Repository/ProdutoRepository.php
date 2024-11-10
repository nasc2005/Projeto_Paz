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
        $valor_custo = $produto->getValorCusto();
        $imagem = $produto->getImagem();
        $categoria = $produto->getCategoria();
        $valor_venda = $produto->getValorVenda();
        $descricao = $produto->getDescricao();
        $estoque = $produto->getEstoque();

        $query = "INSERT INTO $this->table (
                    nome, valor_custo, imagem, categoria, valor_venda, descricao, estoque
                    )
                  VALUES (
                    :nome, :valor_custo, :imagem, :categoria, :valor_venda, :descricao, :estoque
                    )";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor_custo", $valor_custo);
        $stmt->bindParam(":imagem", $imagem);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":valor_Venda", $valor_venda);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":estoque", $estoque);
        
        return $stmt->execute();
    }

    public function getAllProdutos() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutoById($id_produto) {
        $query = "SELECT * FROM $this->table WHERE id_produto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_produto", $id_produto, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getCategoria($categoria){
        $query = "SELECT * FROM $this->table WHERE categoria = :categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduto(Produto $produto) {
        $id_produto = $produto->getId();
        $nome = $produto->getNome();
        $valor_custo = $produto->getValorCusto();
        $imagem = $produto->getImagem();
        $categoria = $produto->getCategoria();
        $valor_venda = $produto->getValorVenda();
        $descricao = $produto->getDescricao();
        $estoque = $produto->getEstoque();

        $query = "UPDATE $this->table SET 
                    nome = :nome, 
                    valor_custo = :valor_custo, 
                    imagem = :imagem, 
                    categoria = :categoria, 
                    valor_venda = :valor_venda, 
                    descricao = :descricao, 
                    estoque = :estoque
                  WHERE id_produto = :id_produto";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor_custo", $valor_custo);
        $stmt->bindParam(":imagem", $imagem);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":valor_venda", $valor_venda);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":id_produto", $id_produto);

        return $stmt->execute();
    }

    public function deleteProduto($id_produto) {
        $query = "DELETE FROM $this->table WHERE id_produto = :id_produto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_produto", $id_produto, PDO::PARAM_INT);

        return $stmt->execute();
    }
}