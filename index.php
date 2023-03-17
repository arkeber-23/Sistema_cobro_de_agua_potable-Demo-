<?php
require_once __DIR__ . '/src/Autoload.php';
require_once __DIR__ . '/src/config/Config.php';
require_once __dir__ . '/src/libs/core/Conexion.php';
require_once __DIR__ . '/src/routes/Router.php';
require_once __DIR__ . '/src/libs/helpers/Funcionalidad.php';
require_once __DIR__ . '/src/libs/helpers/Render.php';

$router = new Router();
$router->cargarRuta();
