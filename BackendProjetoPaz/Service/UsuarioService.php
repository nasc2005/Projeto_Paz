<?php
namespace App\Backend\Service;

use App\Backend\Model\Usuario;
use App\Backend\Repository\UsuarioRepository;
use DateTime;

class UsuarioService {
    private $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->idInstituicao, $data->nome, $data->email, $data->senha, $data->perfil, $data->cpf, $data->telefone, $data->dataNasc, $data->imagem)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do usuário."]);
            return;
        }
        
        $usuario = new usuario();
        $usuario->setIdInstituicao($data->idInstituicao);
        $usuario->setNome($data->nome);
        $usuario->setEmail($data->emai);
        $usuario->setSenha($data->senha);
        $usuario->setPerfil($data->perfil);
        $usuario->setCpf($data->cpf);
        $usuario->setTelefone($data->telefone);
        $usuario->setDataNasc($data->dataNasc);
        $usuario->setImagem($data->imagem);
        $usuario->setInsertDateTime(new DateTime());

        if ($this->repository->insertUsuario($usuario)) {
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar usuário."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getUsuarioById($id);
            unset($result['senha']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllUsuarios();
            foreach ($result as &$usuario) {
                unset($usuario['senha']);
            }
            unset($usuario);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum usuário encontrado."]);
    }

    public function update($data) {
        if (!isset($data->id, $data->idInstituicao, $data->nome, $data->email, $data->senha, $data->perfil, $data->cpf, $data->telefone, $data->dataNasc, $data->imagem)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do usuário."]);
            return;
        }

        $usuario = new Usuario();
        $usuario->setId($data->id);
        $usuario->setIdInstituicao($data->idInstituicao);
        $usuario->setNome($data->nome);
        $usuario->setEmail($data->emai);
        $usuario->setSenha($data->senha);
        $usuario->setPerfil($data->perfil);
        $usuario->setCpf($data->cpf);
        $usuario->setTelefone($data->telefone);
        $usuario->setDataNasc($data->dataNasc);
        $usuario->setImagem($data->imagem);
        $usuario->setInsertDateTime(new DateTime());

        if ($this->repository->updateusuario($usuario)) {
            http_response_code(200);
            echo json_encode(["message" => "Usuário atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar usuário."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteusuario($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Usuário excluído com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir instituição."]);
        }
    }
}