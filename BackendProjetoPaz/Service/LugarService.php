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
        if (!isset($data->id_instituicao, $data->apelido, $data->endereco, $data->numero, $data->arranjo)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do lugar."]);
            return;
        }
        
        $lugar = new Lugar();
        $lugar->setIdInstituicao($data->id_instituicao);
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

            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllLugares();
  
            unset($lugar);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum lugar encontrado."]);
    }

    public function update($data) {
        if (!isset($data->id_lugar, $data->id_instituicao, $data->apelido, $data->endereco, $data->numero, $data->arranjo)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do lugar."]);
            return;
        }

        $lugar = new Lugar();
        $lugar->setId($data->id_lugar);
        $lugar->setIdInstituicao($data->id_instituicao);
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