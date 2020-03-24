<?php
/*****************************************
* Framework Nautilus (versão 3)          *
* por Felipe Geroldi (Feriip3D)          *
* feriip3d@gmail.com                     *
* Proibido uso ou cópia sem autorização  *
*****************************************/
session_start();

// Somente para desenvolvimento
// habilitando debugs
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
// Somente para desenvolvimento

// Caminho raiz de todo o framework
define("ROOT_DIR", str_replace("\\Webroot", "", __DIR__));

// Carregamento do autoloader
require_once ROOT_DIR."/vendor/autoload.php";

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
