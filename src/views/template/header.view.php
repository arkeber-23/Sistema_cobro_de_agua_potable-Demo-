<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gesti&oacute;n Agua | <?= $data['titulo'] ?? '' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/bootstrap/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/sweetAlert/sweetalert2.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/css/nav.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/css/all.min.css' ?>">
    <link rel="shortcut icon" href="<?= BASE_URL . '/assets/images/agua-icon.png' ?>" type="image/x-icon">
</head>

<body class="grid">
    <header class="header">
        <div class="header-icon">
            <a href="/ruta">
                <img class="header-icon-img" src="<?= BASE_URL . '/assets/images/agua-icon.png' ?>" alt="">
            </a>
        </div>
        <nav class="menu">
            <ul class="lista">
                <!-- <li class="lista_item">
                    <a href="/ruta">Inicio</a>
                </li> -->
                <li class="lista_item">
                    <a href="/ruta/clientes"> <i class="fa-solid fa-users"></i><span class="ms-2">Clientes</span></a>
                </li>
                <li id="activar--menu">
                    <i class="fa-solid fa-newspaper"></i>
                    <span class="ms-2"> Lecturas</span>
                    <ul class="lista_submenu_mostrar lista_submenu_mostrar--activo">
                        <li class="lista_item">
                            <a href="/ruta/lecturas/registrar">Generar Lecturas</a>
                        </li>
                    </ul>
                </li>
                <li class="lista_item">
                    <a href="">
                        <i class="fa-solid fa-money-bill"></i><span class="ms-2">Facturaci&oacute;n</span></a>
                </li>
                <li id="activar--menu">
                    <i class="fa-solid fa-map"></i>
                    <span class="ms-2">Barrios</span>
                    <ul class="lista_submenu_mostrar lista_submenu_mostrar--activo">
                        <li class="lista_item">
                            <a href="/ruta/cliente">Clientes Adeudados</a>
                        </li>
                    </ul>
                </li>
                <li id="activar--menu">
                    <i class="fa-solid fa-file-pdf"></i>
                    <span class="ms-2">Reportes</span>
                    <ul class="lista_submenu_mostrar lista_submenu_mostrar--activo">
                        <li class="lista_item">
                            <a href="/ruta/cliente">Clientes Morosos</a>
                        </li>
                        <li class="lista_item">
                            <a class="text-decoration-none" target="__blank" href="/ruta/lecturas/plantilla">Plantilla Lecturas</a>
                        </li>
                        <li class="lista_item">
                            <a href="/ruta/cliente">Clientes Morosos</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
    </header>

    <main class="contenido">