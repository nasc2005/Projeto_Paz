<?php
require "../../vendor/autoload.php";

use App\Backend\Http\HttpHeader;
use App\Backend\Repository\UsuarioRepository;
use App\Backend\Service\UsuarioService;

$repository = new UsuarioRepository();
$service = new UsuarioService($repository);

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
        case 'login':
            $service->login($data);
            break;
        default:
            $service->create($data);
            break;
        }        
        break;
    case 'GET':
        switch ($action) {
            case 'usuarios/perfil':
                $perfil = isset($_GET['perfil']) ? $_GET['perfil'] : null;
                $service->readByPerfil($perfil);
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