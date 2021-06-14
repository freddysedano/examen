<?php
use Dotenv\Dotenv;
use Libs\Core;

require_once '../vendor/autoload.php';
// require_once '../Libs/core.php';
// require_once '../Config/config.php';
// require_once '../libs/controller.php';
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$_ENV['DB_DATABASE'];
$core=new Core();

// echo "Hola mundo";
