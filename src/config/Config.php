<?php

const BASE_URL ='http://localhost/ruta';
$urlPath = ($_SERVER['REQUEST_URI']);
$carpetaPath =   dirname($_SERVER['SCRIPT_NAME']);

$url = substr($urlPath, strlen($carpetaPath));
define('RUTA',$url);

date_default_timezone_set('America/Guayaquil');


const ENV = [
    'DB_HOST' => "127.0.0.1",
    'DB_NAME' => "NOMBRE DE LA BASE DE DATOS",
    'DB_USER' => "USUARIO",
    'DB_PASS' => "PASSWORD",
    'DB_CHAR' => "charset=utf8",
];
