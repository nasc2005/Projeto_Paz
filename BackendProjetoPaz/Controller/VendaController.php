<?php
require "../../vendor/autoload.php";

use App\Backend\Http\HttpHeader;
use App\Backend\Repository\VendaRepository;
use App\Backend\Service\VendaService;

$repository = new VendaRepository();
$service = new VendaService($repository);

//function Static
HttpHeader::setDefaultHeaders();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}
$action = 'default'; 
if (isset($_GET['action'])) {
    $action = $_GET['action']; 
}
$data = json_decode(file_get_contents("php://input"));

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
    $service->create($data);
        break;
    case 'GET':
        switch ($action) {
            case 'vendas/usuario':
                $usuario_id = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
                $service->readByUsuario($usuario_id);
                break;
            case 'vendas/lugar':
                $lugar_id = isset($_GET['id_lugar']) ? $_GET['id_lugar'] : null;
                $service->readByLugar($lugar_id);
                break;
            default:
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $service->read($id);
                break;
        }
        break;
    case 'PUT':
        $service->update($data);
        break;
    case 'DELETE':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id === null) {
            HttpHeader::sendNotAllowedMethod();
        }
        $service->delete($id);
        break;
    default:
        HttpHeader::sendNotAllowedMethod();
        break;
}