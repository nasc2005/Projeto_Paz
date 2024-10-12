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

    public function insertLugar(Lugar $lugar) {
        $idInstL = $lugar->getIdInstLugar();
        $insertDateTime = $lugar->getInsertDateTime();
        $apelido = $lugar->getApelido();
        $endereco = $lugar->getEndereco();
        $numero = $lugar->getNumero();
        $arranjo = $lugar->getArranjo();

        $query = "INSERT INTO $this->table (idInstL, insertDateTime, apelido, endereco, numero, arranjo)
                  VALUES (:idInstL, :insertDateTime, :apelido, :endereco, :numero, :arranjo)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idInstL", $idInstL);
        $stmt->bindParam(":insertDateTime", $insertDateTime);
        $stmt->bindParam(":apelido", $apelido);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":arranjo", $arranjo);

        return $stmt->execute();
    }

    public function getAllLugares() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLugarById($lugar_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $lugar_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLugar(Lugar $lugar) {
        $lugar_id = $lugar->getId();
        $idInstL = $lugar->getIdInstLugar();
        $apelido = $lugar->getApelido();
        $endereco = $lugar->getEndereco();
        $numero = $lugar->getNumero();
        $arranjo = $lugar->getArranjo();

        $query = "UPDATE $this->table SET 
                    idInstL = :idInstL, 
                    apelido = :apelido, 
                    endereco = :endereco, 
                    numero = :numero, 
                    arranjo = :arranjo
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idInstL", $idInstL);
        $stmt->bindParam(":apelido", $apelido);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":arranjo", $arranjo);
        $stmt->bindParam(":id", $lugar_id);

        return $stmt->execute();
    }

    public function deleteLugar($lugar_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $lugar_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}