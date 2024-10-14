<?php
namespace App\Backend\Service;

use App\Backend\Model\Produto;
use App\Backend\Repository\ProdutoRepository;
use DateTime;

class ProdutoService {
    private $repository;

    public function __construct(ProdutoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->nome, $data->valorCusto, $data->imagem, $data->categoria, $data->valorVenda, $data->descricao, $data->estoque)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do produto."]);
            return;
        }
        
        $produto = new Produto();
        $produto->setNome($data->nome);
        $produto->setValorCusto($data->valorCusto);
        $produto->setImagem($data->imagem);
        $produto->setCategoria($data->categoria);
        $produto->setValorVenda($data->valorVenda);
        $produto->setDescricao($data->descricao);
        $produto->setEstoque($data->estoque);
        $produto->setInsertDateTime(new DateTime());

        if ($this->repository->insertproduto($produto)) {
            http_response_code(201);
            echo json_encode(["message" => "Produto criado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar produto."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getprodutoById($id);
           // unset($result['senha']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllprodutos();
            foreach ($result as &$produto) {
                //unset($produto['senha']);
            }
            unset($produto);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum produto encontrado."]);
    }

    public function update($data) {
        if (!isset($data->id, $data->nome, $data->valorCusto, $data->imagem, $data->categoria, $data->valorVenda, $data->descricao, $data->estoque)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do produto."]);
            return;
        }

        $produto = new Produto();
        $produto->setId($data->id);
        $produto->setNome($data->nome);
        $produto->setValorCusto($data->valorCusto);
        $produto->setImagem($data->imagem);
        $produto->setCategoria($data->categoria);
        $produto->setValorVenda($data->valorVenda);
        $produto->setDescricao($data->descricao);
        $produto->setEstoque($data->estoque);
        $produto->setInsertDateTime(new DateTime());

        if ($this->repository->updateproduto($produto)) {
            http_response_code(200);
            echo json_encode(["message" => "Produto atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar produto."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteproduto($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Produto excluído com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir produto."]);
        }
    }
}