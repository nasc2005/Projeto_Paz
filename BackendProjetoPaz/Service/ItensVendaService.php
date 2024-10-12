<?php
namespace App\Backend\Service;

use App\Backend\Model\ItensVenda;
use App\Backend\Repository\ItensVendaRepository;

class ItensVendaService {
    private $repository;

    public function __construct(ItensVendaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->idProduto, $data->idVenda, $data->quantidade, $data->precoUnitario, $data->subtotal)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação dos itens venda."]);
            return;
        }
        
        $itensVenda = new ItensVenda();
        $itensVenda->setIdProduto($data->idProduto);
        $itensVenda->setIdVenda($data->idVenda);
        $itensVenda->setQuantidade($data->quantidade);
        $itensVenda->setPrecoUnitario($data->precoUnitario);
        $itensVenda->setSubtotal($data->subtotal);

        if ($this->repository->insertItensVenda($itensVenda)) {
            http_response_code(201);
            echo json_encode(["message" => "Itens da venda criados com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar itens da venda."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getItensVendaById($id);
           // unset($result['senha']);
           $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllItensVenda();
            foreach ($result as &$itensVenda) {
                //unset($itensVenda['senha']);
            }
            unset($itensVenda);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum itens da venda encontrados."]);
    }

    public function update($data) {
        if (!isset($data->id, $data->idProduto, $data->idVenda, $data->quantidade, $data->precoUnitario, $data->subtotal, $data->estoque)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização da itensVenda."]);
            return;
        }

        $itensVenda = new ItensVenda();
        $itensVenda->setId($data->id);
        $itensVenda->setidProduto($data->idProduto);
        $itensVenda->setIdVenda($data->idVenda);
        $itensVenda->setquantidade($data->quantidade);
        $itensVenda->setprecoUnitario($data->precoUnitario);
        $itensVenda->setSubtotal($data->quantidade * $data->precoUnitario);

        if ($this->repository->updateItensVenda($itensVenda)) {
            http_response_code(200);
            echo json_encode(["message" => "Itens da venda atualizados com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar itens da venda."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteItensVenda($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Itens da venda excluídos com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir itens da venda."]);
        }
    }
}