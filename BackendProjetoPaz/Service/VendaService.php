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
        if (!isset($data->id_usuario, $data->id_lugar, $data->id_imgsVenda, $data->total, $data->status_venda, $data->forma_pagamento)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do venda."]);
            return;
        }
        
        $venda = new Venda();
        $venda->setIdUsuario($data->id_usuario);
        $venda->setIdLugar($data->id_lugar);
        $venda->setIdImgsVenda($data->id_imgsVenda);
        $venda->setTotal($data->total);
        $venda->setStatusVenda($data->status_venda);
        $venda->setFormaPagamento($data->forma_pagamento);
        $venda->setInsertDateTime(new DateTime());

        if ($this->repository->insertVenda($venda)) {
            http_response_code(201);
            echo json_encode(["message" => "Venda criada com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar venda."]);
        }
    }
   
    public function read($venda_id = null) {
        if ($venda_id) {
            $result = $this->repository->getDetalhesVenda($venda_id);
            $status = $result ? 200 : 404;
        }else {
            $result = $this->repository->getAllResumoVendas();
            foreach ($result as &$venda) {
            }
            unset($venda);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum venda encontrada."]);
    }

    public function readByUsuario($usuario_id) {
        if ($usuario_id) {
            $result = $this->repository->getResumoVendasByUsuario($usuario_id);
            foreach ($result as &$venda) {
            }
            unset($venda);
            $status = !empty($result) ? 200 : 404;
        }
        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum venda encontrada."]);
    }

    public function readByLugar($lugar_id) {
        if ($lugar_id) {
            $result = $this->repository->getResumoVendasByLugar($lugar_id);
            foreach ($result as &$venda) {
            }
            unset($venda);
            $status = !empty($result) ? 200 : 404;
        }
        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum venda encontrada."]);
    }

    public function update($data) {
        if (!isset($data->id_venda, $data->id_usuario, $data->id_lugar, $data->id_imgsVenda, $data->total, $data->status_venda, $data->forma_pagamento, $data->estoque)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização da venda."]);
            return;
        }

        $venda = new Venda();
        $venda->setId($data->id_venda);
        $venda->setIdUsuario($data->id_usuario);
        $venda->setIdLugar($data->id_lugar);
        $venda->setIdImgsVenda($data->id_imgsVenda);
        $venda->setTotal($data->total);
        $venda->setStatusVenda($data->status_venda);
        $venda->setFormaPagamento($data->forma_pagamento);
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