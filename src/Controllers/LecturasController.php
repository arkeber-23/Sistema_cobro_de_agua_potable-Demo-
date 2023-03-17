<?php

use Dompdf\Dompdf;

require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../models/LecturasModel.php';

require_once __DIR__ . '/../libs/dompdf/autoload.inc.php';

class LecturasController
{

    public function registrar()
    {
        $lecturas = new LecturasModel();
        $clientes = new ClienteModel();
        $fecha = getFechas();
        $data = [
            'titulo' => "Lecturas",
            'lecturas' => $lecturas->listar(),
            'clientes' => $clientes->listar(),
            'clientesActivos' => $clientes->listarEsatdoActivo(),
            'fechas' => $fecha
        ];
        Render::view('lecturas.ingresar.index', $data);
    }

    public function plantilla()
    {
        $cleintes =  new ClienteModel();
        $data = [
            'titulo' => 'Platilla lectutas',
            'clientes' => $cleintes->listar()
        ];
        ob_start();
        Render::view('lecturas.plantilla.index', $data);
        $htmlAPdf = ob_get_clean();
        $domPDF = new Dompdf();

        $opciones = $domPDF->getOptions();
        $opciones->set(['isRemoteEnable' => true]);
        $domPDF->setOptions($opciones);

        $domPDF->loadHtml($htmlAPdf);
        $domPDF->setPaper('letter');
        $domPDF->render();
        $domPDF->stream("planilla_" . date('d-m-Y') . ".pdf", ["Attachment" => false]);
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::pageError();
            return;
        }

        //$datos = json_decode(file_get_contents('php://input'), true);
        extract($_POST);
        $lectura =  new LecturasModel();
        $lectura->setIdCliente($idCliente);
        $lectura->setLectura($lecturaActual);
        $lectura->setFechaRegistro($fechaRegistro);
        $lectura->setMes($mes);
        $resp = $lectura->registrar($lectura);
        echo json_encode($resp);
    }

    public function guardarLecturaInicial()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::pageError();
            return;
        }

        $f = getFechas()['fecha'];
        $m = getFechas()['mes'];

        extract($_POST);
        $lectura =  new LecturasModel();
        $lectura->setIdCliente($idCliente);
        $lectura->setLectura($lecturInicial);
        $lectura->setFechaRegistro($f);
        $lectura->setMes($m);
        $resp = $lectura->registrarLectura($lectura);
        echo json_encode($resp);
    }

    public function cargarlectura()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::pageError();
            return;
        }
        $id = json_decode(file_get_contents('php://input'), true);
        extract($id);
        $lectura = new LecturasModel();
        $lectura->setIdCliente($id);
        $res = $lectura->obtenerLecturaPorID($lectura);
        echo json_encode($res);
    }

    public function buscarPorAny()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::pageError();
            return;
        }
        $req = json_decode(file_get_contents('php://input'), true);
        $cliente = new ClienteModel();
        $cliente->setNombre($req['nombre']);
        $resp = $cliente->buscarPorAny($cliente);
        echo json_encode($resp);
    }
}
