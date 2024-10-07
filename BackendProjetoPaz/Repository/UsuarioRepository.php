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

    public function insertUsuario(Usuario $usuario) {
        $idInstU = $usuario->getIdInstU();
        $insertDateTime = $usuario->getInsertDateTime();
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $perfil = $usuario->getPerfil();
        $cpf = $usuario->getCpf();
        $telefone = $usuario->getTelefone();
        $dataNasc = $usuario->getDataNasc();

        $query = "INSERT INTO $this->table (idInstU, insertDateTime, nome, email, senha, perfil, cpf, telefone, dataNasc)
                  VALUES (:idInstU, :insertDateTime, :nome, :email, :senha, :perfil, :cpf, :telefone, :dataNasc)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idInstU", $idInstU);
        $stmt->bindParam(":insertDateTime", $insertDateTime);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":perfil", $perfil);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":dataNasc", $dataNasc);

        return $stmt->execute();
    }

    public function getAllUsuarios() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioById($usuario_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUsuario(Usuario $usuario) {
        $usuario_id = $usuario->getId();
        $idInstU = $usuario->getIdInstU();
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $perfil = $usuario->getPerfil();
        $cpf = $usuario->getCpf();
        $telefone = $usuario->getTelefone();
        $dataNasc = $usuario->getDataNasc();

        $query = "UPDATE $this->table SET 
                    idInstU = :idInstU, 
                    nome = :nome, 
                    email = :email, 
                    senha = :senha, 
                    perfil = :perfil, 
                    cpf = :cpf, 
                    telefone = :telefone, 
                    dataNasc = :dataNasc
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idInstU", $idInstU);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":perfil", $perfil);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":dataNasc", $dataNasc);
        $stmt->bindParam(":id", $usuario_id);

        return $stmt->execute();
    }

    public function deleteUsuario($usuario_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $usuario_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}