<?php
namespace App\Backend\Repository;

use App\Backend\Model\Meta;
use App\Backend\Config\Database;
use PDO;

class MetaRepository {
    private $conn;
    private $table = "metas";

    public function __construct() {
        $this->conn = Database::getInstance(); 
    }

    public function getAllMetas() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMetasByLugar($lugar_id) {
        $query = "SELECT * FROM $this->table WHERE id_lugarMeta = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $lugar_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMetaById($meta_id) {
        $query = "SELECT * FROM $this->table WHERE id_meta = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $meta_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertMeta(Meta $meta) {
        $idLugar = $meta->getIdLugar();
        $usuarioCriador = $meta->getUsuarioCriador();
        $nome = $meta->getNome();
        $valor = $meta->getValor();
        $marca = $meta->getMarca();
        $imagem = $meta->getImagem();
        $statusMeta = $meta->getStatusMeta();

        $query = "INSERT INTO $this->table (
                    id_lugar, usuarioCriador, nome, valor, marca, imagem, status_meta)
                  VALUES (
                    :idLugar, :usuarioCriador, :nome, :valor, :marca, :imagem, :statusMeta)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idLugar", $idLugar);
        $stmt->bindParam(":usuarioCriador", $usuarioCriador);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":imagem", $imagem);
        $stmt->bindParam(":statusMeta", $statusMeta);

        return $stmt->execute();
    }

    public function updateMeta(Meta $meta) {
        $meta_id = $meta->getId();
        $idLugar = $meta->getIdLugar();
        $usuarioCriador = $meta->getUsuarioCriador();
        $nome = $meta->getNome();
        $valor = $meta->getValor();
        $marca = $meta->getMarca();
        $imagem = $meta->getImagem();
        $statusMeta = $meta->getStatusMeta();

        $query = "UPDATE $this->table 
                  SET 
                    id_lugar = :idLugar, 
                    usuarioCriador = :usuarioCriador,
                    nome = :nome, 
                    valor = :valor, 
                    marca = :marca, 
                    imagem = :imagem, 
                    status_meta = :statusMeta
                  WHERE id_meta = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idLugar", $idLugar);
        $stmt->bindParam(":usuarioCriador", $usuarioCriador);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":imagem", $imagem);
        $stmt->bindParam(":statusMeta", $statusMeta);
        $stmt->bindParam(":id", $meta_id);

        return $stmt->execute();
    }

    public function deleteMeta($meta_id) {
        $query = "DELETE FROM $this->table WHERE id_meta = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $meta_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}