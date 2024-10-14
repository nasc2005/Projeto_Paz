<?php
namespace App\Backend\Service;

use App\Backend\Model\Meta;
use App\Backend\Repository\MetaRepository;
use DateTime;

class MetaService {
    private $repository;

    public function __construct(MetaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->idLugar, $data->usuarioCriador, $data->nome, $data->valor, $data->marca, $data->imagem, $data->status)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação da meta."]);
            return;
        }
        
        $meta = new Meta();
        $meta->setIdLugar($data->idLugar);
        $meta->setUsuarioCriador($data->usuarioCriador);
        $meta->setNome($data->nome);
        $meta->setValor($data->valor);
        $meta->setMarca($data->marca);
        $meta->setImagem($data->imagem);
        $meta->setStatus($data->status);
        $meta->setInsertDateTime(new DateTime());

        if ($this->repository->insertMeta($meta)) {
            http_response_code(201);
            echo json_encode(["message" => "Meta criada com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar meta."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getMetaById($id);
           // unset($result['senha']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllMetas();
            foreach ($result as &$meta) {
                //unset($meta['senha']);
            }
            unset($meta);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhuma meta encontrada."]);
    }

    public function update($data) {
        if (!isset($data->id, $data->idLugar, $data->usuarioCriador, $data->nome, $data->valor, $data->marca, $data->imagem, $data->status)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização da meta."]);
            return;
        }

        $meta = new Meta();
        $meta->setId($data->id);
        $meta->setIdLugar($data->idLugar);
        $meta->setUsuarioCriador($data->usuarioCriador);
        $meta->setNome($data->nome);
        $meta->setValor($data->valor);
        $meta->setMarca($data->marca);
        $meta->setImagem($data->imagem);
        $meta->setStatus($data->status);
        $meta->setInsertDateTime(new DateTime());

        if ($this->repository->updateMeta($meta)) {
            http_response_code(200);
            echo json_encode(["message" => "Meta atualizada com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar meta."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteMeta($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Meta excluído com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir meta."]);
        }
    }
}