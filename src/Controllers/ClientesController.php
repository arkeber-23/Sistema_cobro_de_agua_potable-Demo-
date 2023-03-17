<?php
require_once __DIR__ . '/../models/BarriosModel.php';
require_once __DIR__ . '/../models/ClienteModel.php';
class ClientesController
{
    public function index()
    {
        $barrios = new BarriosModel();
        $clientes = new ClienteModel();
        $data = [
            'titulo' => 'Clientes',
            'barrios' => $barrios->listar(),
            'clientes' => $clientes->listar()
        ];
        Render::view('cliente.index', $data);
    }

    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::pageError();
            return;
        }
        extract($_POST);
        if (
            $barrio == 0 || empty($nombre) ||
            empty($apellidos) || empty($cedula) ||
            empty($correo) || empty($telefono) ||
            empty($n_medidor)
        ) {
            $messageError =  ['create' => false, 'msj' => "No se aceptan campos vacios..."];
            echo json_encode($messageError);
            return;
        }

        $cliente = new ClienteModel();
        $cliente->setIdBarrio($barrio);
        $cliente->setNombre($nombre);
        $cliente->setApellidos($apellidos);
        $cliente->setCedula($cedula);
        $cliente->setCorreo($correo);
        $cliente->setTelefono($telefono);
        $cliente->setNumeroMedidor($n_medidor);
        $res =  $cliente->registrar($cliente);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    public function editar()
    {
        $id = func_get_arg(0)[0];
        $cliente = new ClienteModel();
        $barrios = new BarriosModel();
        $cliente->setIdCliente($id);
        $datos = $cliente->buscarPorId($cliente);
        if (is_null($datos)) {
            Render::pageError();
            return;
        }
        $data = [
            'titulo' => 'Editar',
            'id' => $id,
            'barrios' => $barrios->listar(),
            'cliente' => $datos
        ];
        Render::view('cliente.editar.index', $data);
    }

    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::pageError();
            return;
        }
        $id = json_decode(file_get_contents('php://input'), true);
        $cliente = new ClienteModel();
        $cliente->setIdCliente($id['id']);
        $res = $cliente->eliminar($cliente);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            Render::pageError();
            return;
        }

        $datos = json_decode(file_get_contents('php://input'), true);
        extract($datos);

        $cliente = new ClienteModel();
        $cliente->setIdCliente($id);
        $cliente->setNombre($nombre);
        $cliente->setApellidos($apellidos);
        $cliente->setCedula($cedula);
        $cliente->setTelefono($telefono);
        $cliente->setCorreo($correo);
        $cliente->setIdBarrio($barrio);
        $cliente->setNumeroMedidor($nMedidor);
        $res = $cliente->actualizar($cliente);
        echo json_encode($res);
    }

    public function buscar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::pageError();
            return;
        }
        $cedula = json_decode(file_get_contents('php://input'), true);
        $cliente = new ClienteModel();
        $cliente->setCedula($cedula['cedula']);
        $res = $cliente->buscar($cliente);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
