<?php
/*****************************************
* Framework Nautilus (versão 3)          *
* por Felipe Geroldi (Feriip3D)          *
* feriip3d@gmail.com                     *
* Proibido uso ou cópia sem autorização  *
*****************************************/
session_start();

// MODO PRODUÇÃO ATIVADO
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
error_reporting(0);
// MODO PRODUÇÃO ATIVADO

// Caminho raiz de todo o framework
define("ROOT_DIR", str_replace("\\Webroot", "", __DIR__));

// Carregamento do autoloader
require_once ROOT_DIR."/vendor/autoload.php";

echo password_hash("usuario123@", PASSWORD_BCRYPT);

// Carregamento das classes principais
use Nautilus\Resources\Dispatcher;
$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();
$dotenv->required([
    "DB_TYPE",
    "DB_NAME",
    "DB_PASS",
    "DB_HOST",
    "DB_PORT"
]);

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
