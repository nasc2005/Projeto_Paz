<?php
require "../../vendor/autoload.php";

use App\Backend\Http\HttpHeader;
use App\Backend\Repository\LugarRepository;
use App\Backend\Service\LugarService;

$repository = new LugarRepository();
$service = new LugarService($repository);

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
        switch ($action) {
            default:
                $service->create($data);
                break;
        }
        break;
    case 'GET':
        switch ($action) {
            default:
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $service->read($id);
                break;
        }
        break;
    case 'PUT':
        switch ($action) {
         default:
            $service->update($data);
            break;   
        }
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