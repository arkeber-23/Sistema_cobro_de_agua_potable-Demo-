<?php

function cargarControladores($controlador)
{
    $archivo = __DIR__ . '/Controllers/' . ucfirst($controlador) . ".php";
    include_once $archivo;
}

spl_autoload_register('cargarControladores');
