<?php
namespace App\Backend\Service;

use App\Backend\Model\Lugar;
use App\Backend\Repository\LugarRepository;
use DateTime;

class LugarService {
    private $repository;

    public function __construct(LugarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->idInstituicao, $data->apelido, $data->endereco, $data->numero, $data->arranjo)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do lugar."]);
            return;
        }
        
        $lugar = new Lugar();
        $lugar->setIdInstituicao ($data->idInstituicao);
        $lugar->setApelido($data->apelido);
        $lugar->setEndereco($data->endereco);
        $lugar->setNumero($data->numero);
        $lugar->setArranjo($data->arranjo);
        $lugar->setInsertDateTime(new DateTime());

        if ($this->repository->insertLugar($lugar)) {
            http_response_code(201);
            echo json_encode(["message" => "Lugar criado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar lugar."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getLugarById($id);
           // unset($result['senha']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllLugares();
            foreach ($result as &$lugar) {
                //unset($lugar['senha']);
            }
            unset($lugar);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum lugar encontrado."]);
    }

    public function update($data) {
        if (!isset($data->id, $data->idInstituicao, $data->apelido, $data->endereco, $data->numero, $data->arranjo)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do lugar."]);
            return;
        }

        $lugar = new Lugar();
        $lugar->setId($data->id);
        $lugar->setApelido($data->idInstituicao);
        $lugar->setApelido($data->apelido);
        $lugar->setEndereco($data->endereco);
        $lugar->setNumero($data->numero);
        $lugar->setArranjo($data->arranjo);
        $lugar->setInsertDateTime(new DateTime());

        if ($this->repository->updateLugar($lugar)) {
            http_response_code(200);
            echo json_encode(["message" => "Lugar atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar lugar."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteLugar($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Lugar excluído com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir lugar."]);
        }
    }
}