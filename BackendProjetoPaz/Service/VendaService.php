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
        if (!isset($data->id_usuario, $data->id_lugar, $data->id_imgsVenda, $data->total, $data->status_venda)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação da venda."]);
            return;
        }
    
        if (empty($data->id_usuario) || empty($data->id_lugar) || empty($data->id_imgsVenda) || empty($data->total) || empty($data->status_venda)) {
            http_response_code(400);
            echo json_encode(["error" => "Campos obrigatórios estão vazios."]);
            return;
        }
    
        $venda = new Venda();
        $venda->setIdUsuario($data->id_usuario);
        $venda->setIdLugar($data->id_lugar);
        $venda->setIdImgsVenda($data->id_imgsVenda);
        $venda->setTotal($data->total);
        $venda->setFormaPagamento($data->forma_pagamento);
        $venda->setStatusVenda($data->status_venda);
        $venda->setInsertDateTime(new DateTime());
    
        // Agora insertVenda retorna o ID da venda
        $id_venda = $this->repository->insertVenda($venda);
    
        if ($id_venda) {
            http_response_code(201);
            echo json_encode([
                "message" => "Venda criada com sucesso.",
                "id_venda" => $id_venda // Retorna o ID da venda criada
            ]);
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
        // Verifica se os campos necessários para a atualização estão presentes
        if (!isset($data->id_venda, $data->total, $data->forma_pagamento, $data->status_venda)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a atualização da venda."]);
            return;
        }
    
        // Verifica se campos obrigatórios estão vazios ou nulos
        if (empty($data->total) || empty($data->status_venda)) {
            http_response_code(400);
            echo json_encode(["error" => "Campos obrigatórios estão vazios."]);
            return;
        }
    
        // Criação da venda (sem mudar os campos não informados)
        $venda = new Venda();
        $venda->setId($data->id_venda);
        $venda->setTotal($data->total);
        $venda->setFormaPagamento($data->forma_pagamento);
        $venda->setStatusVenda($data->status_venda);
    
        // Chama o método para atualizar a venda no banco de dados
        if ($this->repository->updateVenda($venda)) {
            http_response_code(200);
            echo json_encode([
                "message" => "Venda atualizada com sucesso.",
                "id_venda" => $data->id_venda // Retorna o ID da venda atualizada
            ]);
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