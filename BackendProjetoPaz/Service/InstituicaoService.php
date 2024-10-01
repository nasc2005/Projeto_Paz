<?php
namespace App\Backend\Service;

use App\Backend\Model\Instituicao;
use App\Backend\Repository\InstituicaoRepository;
use DateTime;

class InstituicaoService {
    private $repository;

    public function __construct(InstituicaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->nome, $data->descricao, $data->logo, $data->saldo)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do instituição."]);
            return;
        }
        
        $instituicao = new Instituicao();
        $instituicao->setNome($data->nome);
        $instituicao->setDescricao($data->descricao);
        $instituicao->setLogo($data->logo);
        $instituicao->setSaldo($data->saldo);
        $instituicao->setInsertDateTime(new DateTime());

        if ($this->repository->insertInstituicao($instituicao)) {
            http_response_code(201);
            echo json_encode(["message" => "Instituição criado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar instituição."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getInstituicaoById($id);
           // unset($result['senha']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllInstituicaos();
            foreach ($result as &$instituicao) {
                //unset($instituicao['senha']);
            }
            unset($instituicao);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum instituição encontrado."]);
    }

    public function update($data) {
        if (!isset($data->instituicao_id, $data->descricao, $data->logo, $data->saldo)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do instituição."]);
            return;
        }

        $instituicao = new Instituicao();
        $instituicao->setId($data->instituicao_id);
        $instituicao->setNome($data->nome);
        $instituicao->setDescricao($data->descricao);
        $instituicao->setLogo($data->logo);
        $instituicao->setSaldo($data->saldo);

        if ($this->repository->updateInstituicao($instituicao)) {
            http_response_code(200);
            echo json_encode(["message" => "Instituição atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar instituição."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteInstituicao($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Usuário excluído com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir instituição."]);
        }
    }
}