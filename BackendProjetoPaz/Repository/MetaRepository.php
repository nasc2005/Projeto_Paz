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

    public function insertMeta(Meta $meta) {
        $idLugarMeta = $meta->getIdLugarMeta();
        $usuarioCriador = $meta->getUsuarioCriador();
        $insertDateTime = $meta->getInsertDateTime();
        $nome = $meta->getNome();
        $valor = $meta->getValor();
        $marca = $meta->getMarca();
        $imgUrl = $meta->getImgUrl();
        $status = $meta->getStatus();

        $query = "INSERT INTO $this->table (idLugarMeta, usuarioCriador, insertDateTime, nome, valor, marca, imgUrl, status)
                  VALUES (:idLugarMeta, :usuarioCriador, :insertDateTime, :nome, :valor, :marca, :imgUrl, :status)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idLugarMeta", $idLugarMeta);
        $stmt->bindParam(":usuarioCriador", $usuarioCriador);
        $stmt->bindParam(":insertDateTime", $insertDateTime);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":imgUrl", $imgUrl);
        $stmt->bindParam(":status", $status);

        return $stmt->execute();
    }

    public function getAllMetas() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMetaById($meta_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $meta_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMeta(Meta $meta) {
        $meta_id = $meta->getId();
        $idLugarMeta = $meta->getIdLugarMeta();
        $usuarioCriador = $meta->getUsuarioCriador();
        $insertDateTime = $meta->getInsertDateTime();
        $nome = $meta->getNome();
        $valor = $meta->getValor();
        $marca = $meta->getMarca();
        $imgUrl = $meta->getImgUrl();
        $status = $meta->getStatus();

        $query = "UPDATE $this->table SET 
                    idLugarMeta = :idLugarMeta, 
                    usuarioCriador = :usuarioCriador, 
                    insertDateTime = :insertDateTime, 
                    nome = :nome, 
                    valor = :valor, 
                    marca = :marca, 
                    imgUrl = :imgUrl, 
                    status = :status
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idLugarMeta", $idLugarMeta);
        $stmt->bindParam(":usuarioCriador", $usuarioCriador);
        $stmt->bindParam(":insertDateTime", $insertDateTime);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":imgUrl", $imgUrl);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $meta_id);

        return $stmt->execute();
    }

    public function deleteMeta($meta_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $meta_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}