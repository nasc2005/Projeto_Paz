<?php
namespace App\Backend\Service;

use App\Backend\Model\Usuario;
use App\Backend\Repository\UsuarioRepository;
use Exception;

use DateTime;

class UsuarioService {
    private $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login($data) {
        if (!isset($data->email) || !isset($data->senha)) {
            http_response_code(400);
            echo json_encode(["error" => "Email e senha são necessários para o login."]);
            return;
        }
        try {
            $usuario = $this->repository->getUsuarioByEmail($data->email);
            //senha com hash
            //if ($usuario && password_verify($data->senha, $usuario['senha']))
            //senha sem "hash"
            if ($data->senha === $usuario['senha']) {
                unset($usuario['senha']);
                http_response_code(200);
                echo json_encode([
                    "message" => "Login bem-sucedido.", 
                    "usuario" => $usuario
                ]);
        } else {
            http_response_code(401);
            echo json_encode(["error"=> "Email ou senha incorretos"]);
        }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Erro interno do servidor."]);
        }
    }

    public function create($data) {
        if (!isset($data->id_instituicao, $data->nome, $data->telefone, $data->email, $data->senha, $data->perfil, $data->cpf, $data->data_nasc, $data->imagem)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do usuário."]);
            return;
        }
        $usuario = new Usuario();
        $usuario->setIdInstituicao($data->id_instituicao);
        $usuario->setNome($data->nome);
        $usuario->setTelefone($data->telefone);
        $usuario->setEmail($data->email);
        $usuario->setSenha($data->senha);
        $usuario->setCpf($data->cpf);
        $usuario->setPerfil($data->perfil);
        $usuario->setDataNasc($data->data_nasc);
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

    public function readByPerfil($perfil) {
        if($perfil) {
            $result = $this->repository->getUsuariosByPerfil($perfil);
            foreach ($result as &$usuario) {
                unset($usuario['senha']);
            }
            unset($usuario);
            $status = !empty($result) ? 200 : 404;
        }
        http_response_code($status);
        $response = [
            "data" => $result ?: null,
            "message" => !empty($result) ? "Usuários encontrados para o perfil especificado." : "Nenhum usuário encontrado para o perfil."
        ];
        echo json_encode($response);
    }
        

    public function update($data) {
        if (!isset($data->id_usuario, $data->id_instituicao, $data->nome, $data->telefone, $data->email, $data->cpf, $data->perfil, $data->data_nasc, $data->imagem)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do usuário."]);
            return;
        }

        $usuario = new Usuario();
        $usuario->setId($data->id_usuario);
        $usuario->setIdInstituicao($data->id_instituicao);
        $usuario->setNome($data->nome);
        $usuario->setTelefone($data->telefone);
        $usuario->setEmail($data->email);
        $usuario->setCpf($data->cpf);
        $usuario->setPerfil($data->perfil);
        $usuario->setDataNasc($data->data_nasc);
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