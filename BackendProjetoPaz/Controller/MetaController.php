<?php
require "../../vendor/autoload.php";

use App\Backend\Http\HttpHeader;
use App\Backend\Repository\MetaRepository;
use App\Backend\Service\MetaService;

$repository = new MetaRepository();
$service = new MetaService($repository);

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
            case 'metas/lugar':
                $lugar_id = isset($_GET['idLugar']) ? $_GET['idLugar'] : null;
                $service->readByLugar($id, $lugar_id);
                break;
            default:
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $service->read($id, $lugar_id);
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