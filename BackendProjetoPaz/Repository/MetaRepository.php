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

    public function getAllMetasByLugar($id_lugar) {
        $query = "SELECT * FROM $this->table WHERE id_lugarMeta = :id_lugar";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_lugar", $id_lugar, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMetaById($meta_id) {
        $query = "SELECT * FROM $this->table WHERE id_meta = :id_meta";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_meta", $meta_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertMeta(Meta $meta) {
        $id_lugar = $meta->getIdLugar();
        $id_usuarioCriador = $meta->getUsuarioCriador();
        $nome = $meta->getNome();
        $valor = $meta->getValor();
        $marca = $meta->getMarca();
        $imagem = $meta->getImagem();
        $status_meta = $meta->getStatusMeta();

        $query = "INSERT INTO $this->table (
                    id_lugar, id_usuarioCriador, nome, valor, marca, imagem, status_meta)
                  VALUES (
                    :id_lugar, :id_usuarioCriador, :nome, :valor, :marca, :imagem, :status_meta)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_lugar", $id_lugar);
        $stmt->bindParam(":id_usuarioCriador", $id_usuarioCriador);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":imagem", $imagem);
        $stmt->bindParam(":status_meta", $status_meta);

        return $stmt->execute();
    }

    public function updateMeta(Meta $meta) {
        $id_meta = $meta->getId();
        $id_lugar = $meta->getIdLugar();
        $id_usuarioCriador = $meta->getUsuarioCriador();
        $nome = $meta->getNome();
        $valor = $meta->getValor();
        $marca = $meta->getMarca();
        $imagem = $meta->getImagem();
        $status_meta = $meta->getStatusMeta();

        $query = "UPDATE $this->table 
                  SET 
                    id_lugar = :id_lugar, 
                    id_usuarioCriador = :id_usuarioCriador,
                    nome = :nome, 
                    valor = :valor, 
                    marca = :marca, 
                    imagem = :imagem, 
                    status_meta = :status_meta
                  WHERE id_meta = :id_meta";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_lugar", $id_lugar);
        $stmt->bindParam(":id_usuarioCriador", $id_usuarioCriador);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":imagem", $imagem);
        $stmt->bindParam(":status_meta", $status_meta);
        $stmt->bindParam(":id_meta", $id_meta);

        return $stmt->execute();
    }

    public function deleteMeta($id_meta) {
        $query = "DELETE FROM $this->table WHERE id_meta = :id_meta";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_meta", $id_meta, PDO::PARAM_INT);

        return $stmt->execute();
    }
}