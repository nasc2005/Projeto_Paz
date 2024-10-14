<?php
namespace App\Backend\Service;

use App\Backend\Model\Venda;
use App\Backend\Repository\VendaRepository;
use DateTime;

class VendaService {
    private $repository;

    public function __construct(VendaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->idUserVenda, $data->idLugarVenda, $data->idImgsVenda, $data->total, $data->status, $data->formaPagamento)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do venda."]);
            return;
        }
        
        $venda = new Venda();
        $venda->setIdUserVenda($data->idUserVenda);
        $venda->setIdLugarVenda($data->idLugarVenda);
        $venda->setIdImgsVenda($data->idImgsVenda);
        $venda->setTotal($data->total);
        $venda->setStatus($data->status);
        $venda->setFormaPagamento($data->formaPagamento);
        $venda->setInsertDateTime(new DateTime());

        if ($this->repository->insertVenda($venda)) {
            http_response_code(201);
            echo json_encode(["message" => "Venda criada com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar venda."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getVendaById($id);
           // unset($result['senha']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllVendas();
            foreach ($result as &$venda) {
                //unset($venda['senha']);
            }
            unset($venda);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum venda encontrada."]);
    }

    public function update($data) {
        if (!isset($data->id, $data->idUserVenda, $data->idLugarVenda, $data->idImgsVenda, $data->total, $data->status, $data->formaPagamento, $data->estoque)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização da venda."]);
            return;
        }

        $venda = new Venda();
        $venda->setId($data->id);
        $venda->setIdUserVenda($data->idUserVenda);
        $venda->setIdLugarVenda($data->idLugarVenda);
        $venda->setIdImgsVenda($data->idImgsVenda);
        $venda->setTotal($data->total);
        $venda->setStatus($data->status);
        $venda->setFormaPagamento($data->formaPagamento);
        $venda->setInsertDateTime(new DateTime());

        if ($this->repository->updateVenda($venda)) {
            http_response_code(200);
            echo json_encode(["message" => "Venda atualizada com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar venda."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteVenda($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Venda excluída com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir venda."]);
        }
    }
}