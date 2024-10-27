<?php
require "../../vendor/autoload.php";

use App\Backend\Http\HttpHeader;
use App\Backend\Repository\UsuarioRepository;
use App\Backend\Service\UsuarioService;

class Router {
    private $service;
    private $routes = [];

    public function __construct($service) {
        $this->service = $service;
    }

    public function addRoute($method, $uri, $action) {
        $this->routes[$method][$uri] = $action;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri]);
        } else {
            HttpHeader::sendNotAllowedMethod();
        }
    }
}

$repository = new UsuarioRepository();
$service = new UsuarioService($repository);

// Definir cabeçalhos padrão
HttpHeader::setDefaultHeaders();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$data = json_decode(file_get_contents("php://input"));
$router = new Router($service);

// Definindo as rotas
$router->addRoute('POST', '/BackendProjetoPaz/Controller/UsuarioController.php/admin/criar', function() use ($service, $data) {
    $service->create($data);
});

$router->addRoute('GET', '/BackendProjetoPaz/Controller/UsuarioController.php/usuarios', function() use ($service) {
    $id = $_GET['id'] ?? null;
    $service->read($id);
});

$router->addRoute('PUT', '/BackendProjetoPaz/Controller/UsuarioController.php/usuarios/atualizar', function() use ($service, $data) {
    $service->update($data);
});

$router->addRoute('DELETE', '/BackendProjetoPaz/Controller/UsuarioController.php/usuarios/deletar', function() use ($service) {
    $id = $_GET['id'] ?? null;
    if ($id === null) {
        HttpHeader::sendNotAllowedMethod();
    } else {
        $service->delete($id);
    }
});

// Executando o roteador
$router->run();