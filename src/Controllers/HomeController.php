<?php
class HomeController
{

    public function index()
    {
        $data = ['titulo' => 'Inicio'];
        Render::view('home.index', $data);
    }
}
