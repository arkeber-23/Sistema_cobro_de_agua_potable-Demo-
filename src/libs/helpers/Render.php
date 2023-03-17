<?php

class Render
{

    public static function view(string $archivo, $data = [])
    {
        $archivo = str_replace('.', '/', $archivo);
        include_once __DIR__ . '/../../views/' . $archivo . '.view.php';
    }

    public static function pageError()
    {
        self::view('error.index');
    }

}
