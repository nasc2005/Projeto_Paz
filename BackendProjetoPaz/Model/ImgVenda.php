<?php

namespace App\Backend\Model;

use PDO;

class ImgVenda {
    private $id;
    private $imgPix;
    private $imgDinheiro;
    private $imgComprovante;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getImgPix() {
        return $this->imgPix;
    }

    public function setImgPix($imgPix) {
        $this->imgPix = $imgPix;
    }

    public function getImgDinheiro() {
        return $this->imgDinheiro;
    }

    public function setImgDinheiro($imgDinheiro) {
        $this->imgDinheiro = $imgDinheiro;
    }

    public function getImgComprovante() {
        return $this->imgComprovante;
    }

    public function setImgComprovante($imgComprovante) {
        $this->imgComprovante = $imgComprovante;
    }
}
