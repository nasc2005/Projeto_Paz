<?php
namespace App\Backend\Service;

use App\Backend\Model\ImgVenda;
use App\Backend\Repository\ImgVendaRepository;

class ImgVendaService {
    private $repository;

    public function __construct(ImgVendaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data) {
        if (!isset($data->imgPix, $data->imgDinheiro, $data->imgComprovante)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do imgVenda."]);
            return;
        }
        
        $imgVenda = new ImgVenda();
        $imgVenda->setimgPix($data->imgPix);
        $imgVenda->setimgDinheiro($data->imgDinheiro);
        $imgVenda->setimgComprovante($data->imgComprovante);

        if ($this->repository->insertImgVenda($imgVenda)) {
            http_response_code(201);
            echo json_encode(["message" => "Imgagens da venda criadas com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar imagens da venda."]);
        }
    }
   
    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getImgVendaById($id);
           
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllImgVendas();

            unset($imgVenda);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhuma imagens da venda encontradas."]);
    }

    public function update($data) {
        if (!isset($data->id_imgsVenda, $data->img_pix, $data->img_dinheiro, $data->img_comprovante)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização das imagens da venda."]);
            return;
        }

        $imgVenda = new ImgVenda();
        $imgVenda->setId($data->id_imgsVenda);
        $imgVenda->setimgPix($data->img_pix);
        $imgVenda->setimgDinheiro($data->img_dinheiro);
        $imgVenda->setimgComprovante($data->img_comprovante);

        if ($this->repository->updateImgVenda($imgVenda)) {
            http_response_code(200);
            echo json_encode(["message" => "Imagens da venda atualizadas com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar imagens da venda."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteImgVenda($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Imagens da venda excluídas com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir imagens da venda."]);
        }
    }
}