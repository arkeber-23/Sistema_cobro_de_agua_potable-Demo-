<?php

class Router
{

    private $controlador;
    private $metodo;
    private $parametros;
    private $ruta;

    public function __construct()
    {
        $this->ruteador();
    }

    public function ruteador()
    {

        $url = explode('/', RUTA);
        $this->controlador = !empty($url[1]) ? ucwords($url[1]) : 'Home';
        $this->metodo = !empty($url[2]) ? $url[2] : 'index';
        $this->parametros = array_slice($url, 3); #creamos un nuevo array desde esta posicion 
        $this->controlador = $this->controlador . 'Controller';
        $this->ruta = __DIR__ . '/../Controllers/' . $this->controlador . '.php';
    }

    public function cargarRuta()
    {
        if (
            !file_exists($this->ruta)
            || !class_exists($this->controlador)
            || !method_exists($this->controlador, $this->metodo)
        ) {

            Render::pageError();
            return;
        }
        $controlador = new $this->controlador();
        $metodo = $this->metodo;
        $controlador->$metodo($this->parametros);
    }
}
