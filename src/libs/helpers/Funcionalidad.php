<?php

function headers($data = [])
{
    Render::view('template.header', $data);
}


function footers($data = [])
{
    Render::view('template.footer', $data);
}
function getFechas()
{
    $numerMes = date('m');
    $mes = '';
    switch ($numerMes) {
        case 01:
            $mes = "ENERO";
            break;
        case 02:
            $mes = "FEBRERO";
            break;
        case 03:
            $mes = "MARZO";
            break;
        case 04:
            $mes = "ABRIL";
            break;
        case 05:
            $mes = "MAYO";
            break;
        case 06:
            $mes = "JUNIO";
            break;
        case 07:
            $mes = "JULIO";
            break;
        case 8:
            $mes = "AGOSTO";
            break;
        case 9:
            $mes = "SEPTIEMBRE";
            break;
        case 10:
            $mes = "OCTUBRE";
            break;
        case 11:
            $mes = "NOVIEMBRE";
            break;
        case 12:
            $mes = "DICIEMBRE";
            break;
    }
    return ['fecha' => date('Y-m-d'), 'mes' => $mes];
}
