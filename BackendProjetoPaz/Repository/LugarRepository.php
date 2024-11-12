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

    public function getLugarById($id_lugar) {
        $query = "SELECT * FROM $this->table WHERE id_lugar = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id_lugar, PDO::PARAM_INT);
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
        $id_instituicao = $lugar->getIdInstituicao();
        $apelido = $lugar->getApelido();
        $endereco = $lugar->getEndereco();
        $numero = $lugar->getNumero();
        $arranjo = $lugar->getArranjo();

        $query = "INSERT INTO $this->table 
                    (id_instituicao, apelido, endereco, numero, arranjo)
                  VALUES (:id_instituicao, :apelido, :endereco, :numero, :arranjo)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_instituicao", $id_instituicao);
        $stmt->bindParam(":apelido", $apelido);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":arranjo", $arranjo);

        return $stmt->execute();
    }

    public function updateLugar(Lugar $lugar) {
        $id_lugar = $lugar->getId();
        $id_instituicao = $lugar->getIdInstituicao();
        $apelido = $lugar->getApelido();
        $endereco = $lugar->getEndereco();
        $numero = $lugar->getNumero();
        $arranjo = $lugar->getArranjo();

        $query = "UPDATE $this->table 
                  SET 
                    id_instituicao = :id_instituicao, 
                    apelido = :apelido, 
                    endereco = :endereco, 
                    numero = :numero, 
                    arranjo = :arranjo
                  WHERE id_lugar = :id_lugar";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_instituicao", $id_instituicao);
        $stmt->bindParam(":apelido", $apelido);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":arranjo", $arranjo);
        $stmt->bindParam(":id_lugar", $id_lugar);

        return $stmt->execute();
    }

    public function deleteLugar($id_lugar) {
        $query = "DELETE FROM $this->table WHERE id_lugar = :id_lugar";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_lugar", $id_lugar, PDO::PARAM_INT);

        return $stmt->execute();
    }
}