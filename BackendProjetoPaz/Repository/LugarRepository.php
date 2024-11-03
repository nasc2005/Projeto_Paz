<?php
namespace App\Backend\Repository;

use App\Backend\Model\Lugar;
use App\Backend\Config\Database;
use PDO;

class LugarRepository {
    private $conn;
    private $table = "lugares";

    public function __construct()
    {
        $this->conn = Database::getInstance(); 
    }

    public function getAllLugares() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLugarById($lugar_id) {
        $query = "SELECT * FROM $this->table WHERE id_lugar = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $lugar_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /*
    public function getAllMetasByLugar($id_lugar) {
        $query = "SELECT l.apelido AS apelido_lugar, m.* FROM lugares l
                  JOIN lugares l ON l.id_lugarMeta = l.id_lugar
                  WHERE l.id_lugar = :id_lugar";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_lugar', $id_lugar, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    */
    public function insertLugar(Lugar $lugar) {
        $idInstituicao = $lugar->getIdInstituicao();
        $apelido = $lugar->getApelido();
        $endereco = $lugar->getEndereco();
        $numero = $lugar->getNumero();
        $arranjo = $lugar->getArranjo();

        $query = "INSERT INTO $this->table 
                    (id_instituicaoLugar, apelido, endereco, numero, arranjo)
                  VALUES (:idInstituicao, :apelido, :endereco, :numero, :arranjo)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idInstituicao", $idInstituicao);
        $stmt->bindParam(":apelido", $apelido);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":arranjo", $arranjo);

        return $stmt->execute();
    }

    public function updateLugar(Lugar $lugar) {
        $lugar_id = $lugar->getId();
        $idInstituicao = $lugar->getIdInstituicao();
        $apelido = $lugar->getApelido();
        $endereco = $lugar->getEndereco();
        $numero = $lugar->getNumero();
        $arranjo = $lugar->getArranjo();

        $query = "UPDATE $this->table 
                  SET 
                    id_instituicaoLugar = :idInstituicao, 
                    apelido = :apelido, 
                    endereco = :endereco, 
                    numero = :numero, 
                    arranjo = :arranjo
                  WHERE id_lugar = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idInstituicao", $idInstituicao);
        $stmt->bindParam(":apelido", $apelido);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":arranjo", $arranjo);
        $stmt->bindParam(":id", $lugar_id);

        return $stmt->execute();
    }

    public function deleteLugar($lugar_id) {
        $query = "DELETE FROM $this->table WHERE id_lugar = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $lugar_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}