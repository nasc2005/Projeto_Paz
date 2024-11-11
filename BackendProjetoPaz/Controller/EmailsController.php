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
                            case $action == "FinalizarVenda":
                                // Chama o serviço para obter os usuários com o perfil "Administrador"
                                $result = $service->readByPerfil2("Administrador");
                            
                       
                                        
                                        // Chama o método para enviar email para o usuário atual
                                     if(   $service->EnviaEmailNotificarVenda($result)){
                    
                            
                                    http_response_code(200);
                                    echo json_encode([
                                        "message" => "Emails enviados com sucesso!"
                                    ]);
                                } else {
                                    // Retorna uma mensagem de erro se 'data' estiver vazio ou for inválido
                                    http_response_code(404);
                                    echo json_encode([
                                        "message" => "Nenhum usuário encontrado para o perfil especificado."
                                    ]);
                                }
                                break;
                                case $action == "FaltaProduto":
                                    // Chama o serviço para obter os usuários com o perfil "Administrador"
                                    $result = $service->readByPerfil2("Administrador");
                                    $p=  $_GET['produto'];
                                
                                    // Verifica se a chave 'data' existe e é um array
                                    if (isset($result['data']) && is_array($result['data'])) {
                                        // Itera sobre cada usuário no array 'data'
                                        foreach ($result['data'] as $usuario) {
                                            $email = $usuario["email"];
                                            
                                            // Chama o método para enviar email para o usuário atual
                                            $service->EnviaEmailFaltaProduto($email,$p);
                                        }
                                
                                        http_response_code(200);
                                        echo json_encode([
                                            "message" => "Emails enviados com sucesso!"
                                        ]);
                                    } else {
                                        // Retorna uma mensagem de erro se 'data' estiver vazio ou for inválido
                                        http_response_code(404);
                                        echo json_encode([
                                            "message" => "Nenhum usuário encontrado para o perfil especificado."
                                        ]);
                                    }
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