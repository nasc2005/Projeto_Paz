<?php
namespace App\Backend\Repository;

use App\Backend\Model\ImgVenda;
use App\Backend\Config\Database;
use PDO;

class ImgVendaRepository {
    private $conn;
    private $table = "imgvendas";

    public function __construct()
    {
        $this->conn = Database::getInstance(); 
    }

    public function insertImgVenda(ImgVenda $imgVenda) {
        $imgPix = $imgVenda->getImgPix();
        $imgDinheiro = $imgVenda->getImgDinheiro();
        $imgComprovante = $imgVenda->getImgComprovante();

        $query = "INSERT INTO $this->table (imgPix, imgDinheiro, imgComprovante)
                  VALUES (:imgPix, :imgDinheiro, :imgComprovante)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":imgPix", $imgPix);
        $stmt->bindParam(":imgDinheiro", $imgDinheiro);
        $stmt->bindParam(":imgComprovante", $imgComprovante);

        return $stmt->execute();
    }

    public function getAllImgVendas() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImgVendaById($imgVenda_id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $imgVenda_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateImgVenda(ImgVenda $imgVenda) {
        $imgVenda_id = $imgVenda->getId();
        $imgPix = $imgVenda->getImgPix();
        $imgDinheiro = $imgVenda->getImgDinheiro();
        $imgComprovante = $imgVenda->getImgComprovante();

        $query = "UPDATE $this->table SET 
                    imgPix = :imgPix, 
                    imgDinheiro = :imgDinheiro, 
                    imgComprovante = :imgComprovante
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":imgPix", $imgPix);
        $stmt->bindParam(":imgDinheiro", $imgDinheiro);
        $stmt->bindParam(":imgComprovante", $imgComprovante);
        $stmt->bindParam(":id", $imgVenda_id);

        return $stmt->execute();
    }

    public function deleteImgVenda($imgVenda_id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $imgVenda_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}