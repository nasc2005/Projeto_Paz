<?php
namespace App\Backend\Repository;

use App\Backend\Model\Usuario;
use App\Backend\Config\Database;
use PDO;

class UsuarioRepository {
    private $conn;
    private $table = "usuarios";

    public function __construct()
    {
        $this->conn = Database::getInstance(); 
    }
    
    public function getUsuarioByEmail($email){
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* views do usuario */
    public function getAllUsuarios() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioById($usuario_id) {
        $query = "SELECT * FROM $this->table WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_usuario", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUsuariosByPerfil($perfil) {
        $query = "SELECT * FROM $this->table WHERE perfil = :perfil";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":perfil", $perfil);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertUsuario(Usuario $usuario) {
        $id_instituicao = $usuario->getIdInstituicao();
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $perfil = $usuario->getPerfil();
        $cpf = $usuario->getCpf();
        $telefone = $usuario->getTelefone();
        $data_nasc = $usuario->getDataNasc();
        $imagem = $usuario->getImagem();

        $query = "INSERT INTO $this->table 
                    (
                    id_instituicao,
                    nome, email, senha, perfil, cpf, 
                    telefone, dataNasc, imagem
                    )
                  VALUES (
                    :idInstituicao, 
                    :nome, :email, :senha, :perfil, :cpf, 
                    :telefone, :data_nasc, :imagem
                    )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_instituicao", $id_instituicao);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":perfil", $perfil);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":data_nasc", $data_nasc);
        $stmt->bindParam(":imagem", $imagem);
        
        return $stmt->execute();
    }

    public function updateUsuario(Usuario $usuario) {
        $id_usuario = $usuario->getId();
        $id_instituicao = $usuario->getIdInstituicao();
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $perfil = $usuario->getPerfil();
        $cpf = $usuario->getCpf();
        $telefone = $usuario->getTelefone();
        $data_nasc = $usuario->getDataNasc();
        $imagem = $usuario->getImagem();

        $query = "UPDATE $this->table SET 
                    id_instituicao = :idInstituicao, 
                    nome = :nome, email = :email, 
                    senha = :senha, perfil = :perfil, 
                    cpf = :cpf, telefone = :telefone, 
                    dataNasc = :dataNasc, imagem = :imagem
                  WHERE id_usuario = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_instituicao", $id_instituicao);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":perfil", $perfil);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":data_nasc", $data_nasc);
        $stmt->bindParam(":imagem", $imagem);
        $stmt->bindParam(":id_usuario", $id_usuario);

        return $stmt->execute();
    }

    public function deleteUsuario($usuario_id) {
        $query = "DELETE FROM $this->table WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_usuario", $usuario_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}