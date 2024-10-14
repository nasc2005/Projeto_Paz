<?php
require "../../vendor/autoload.php";

use App\Backend\Http\HttpHeader;
use App\Backend\Repository\ProdutoRepository;
use App\Backend\Service\ProdutoService;

$repository = new ProdutoRepository();
$service = new ProdutoService($repository);

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
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $service->read($id);
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