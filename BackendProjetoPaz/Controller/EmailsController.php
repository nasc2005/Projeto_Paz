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
    case 'GET':
        switch ($action) {
            case $action == "Redefinir":
        // var_dump("deu bom");
           $email=  $_GET['email'];
        // var_dump($email);
           $service->EnviaEmail($email);
           http_response_code(200);
                echo json_encode([
                    "message" => "Email Enviado com Sucesso!", 
                ]);
                break;
                case $action == "NovoVendedor":
                    // var_dump("deu bom");
                       $email=  $_GET['email'];
                    // var_dump($email);
                       $service->EnviaEmailVendedor($email);
                       http_response_code(200);
                            echo json_encode([
                                "message" => "Email Enviado com Sucesso!", 
                            ]);
                            break;
                    case $action == "NovoVendedor":
                    // var_dump("deu bom");
                    $email=  $_GET['email'];
                    // var_dump($email);
                    $service->EnviaEmailVendedor($email);
                    http_response_code(200);
                    echo json_encode([
                    "message" => "Email Enviado com Sucesso!", 
                    ]);
                    break;            
            default:
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                var_dump("deu ruim");
                break;
        }
        break;
    default:
        HttpHeader::sendNotAllowedMethod();
        break;
}