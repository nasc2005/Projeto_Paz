<?php
namespace  app\Backend\Config;

use PDO;
use PDOException;
use Exception;


class Database {
    private static $instance = null;
    private $conn;
    private $config;

    private function __construct() {
        $this->config = require 'Config.php';
        $dbConfig = $this->config['database'];


try {
    $mysqlConfig = $dbConfig['mysql'];
    $dsn = "mysql:host={$mysqlConfig['host']};dbname={$mysqlConfig['db_name']};charset={$mysqlConfig['charset']}";
    $this->conn = new PDO($dsn, $mysqlConfig['username'], $mysqlConfig['password'], [PDO::ATTR_PERSISTENT => true]);
} catch (PDOException $exception) {
    echo "Erro de conexão: ". $exception->getMessage();
}catch (Exception $exception) {
    echo "Erro de conexão2: ". $exception->getMessage();
}
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }
}
