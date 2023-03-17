<?php

require_once __DIR__ . '/LecturasModel.php';


class ClienteModel
{
    private $idCliente;
    private $idBarrio;
    private $nombre;
    private $apellidos;
    private $cedula;
    private $correo;
    private $telefono;
    private $numeroMedidor;
    private $db;

    public function __construct()
    {
        $this->db =  Conexion::con();
    }

    public function listar()
    {
        try {
            $sql = "SELECT clientes.*,barrios.NOMBRE_BARRIO FROM sistema_agua.clientes as clientes
            inner join sistema_agua.barrios as barrios on clientes.ID_BARRIO = barrios.ID_BARRIO ORDER BY clientes.ID_CLIENTE Asc ";
            $stmt = Conexion::con()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error listar clientes " . $e->getMessage();
        }
    }

    public function listarEsatdoActivo()
    {
        try {
            $sql = "SELECT clientes.*,barrios.NOMBRE_BARRIO FROM sistema_agua.clientes as clientes
            inner join sistema_agua.barrios as barrios on clientes.ID_BARRIO = barrios.ID_BARRIO WHERE clientes.ESTADO='ACTIVO' ORDER BY clientes.ID_CLIENTE Asc ";
            $stmt = Conexion::con()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error listar clientes " . $e->getMessage();
        }
    }


    public function registrar(ClienteModel $cliente)
    {
        try {
            $sql = "INSERT INTO clientes (ID_BARRIO,NOMBRE,APELLIDOS,CEDULA,CORREO,TELEFONO,N_MEDIDOR) VALUES(:idBarrio,:nombre,:apellidos,:cedula,:correo,:telefono,:n_medidor);";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idBarrio', $cliente->getIdBarrio(), PDO::PARAM_INT);
            $stmt->bindValue(':nombre',  $cliente->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellidos', $cliente->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(':cedula', $cliente->getCedula(), PDO::PARAM_STR);
            $stmt->bindValue(':correo', $cliente->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(':telefono', $cliente->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(':n_medidor', $cliente->getNumeroMedidor(), PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                return ['create' => true, 'msj' => "Cliente creado correctamente..."];
            }
            return ['create' => false, 'msj' => "Error en la creación del cliente..."];
        } catch (PDOException $e) {
            return "Error registro cliente " . $e->getMessage();
        }
    }



    public function actualizar(ClienteModel $cliente)
    {
        try {
            $sql = "UPDATE clientes SET NOMBRE ='{$cliente->getNombre()}',APELLIDOS= '{$cliente->getApellidos()}', CEDULA= '{$cliente->getCedula()}',ID_BARRIO='{$cliente->getIdBarrio()}',TELEFONO='{$cliente->getTelefono()}',N_MEDIDOR = '{$cliente->getNumeroMedidor()}' WHERE ID_CLIENTE = '{$cliente->getIdCliente()}'";
            $stmt = Conexion::con()->exec($sql);
            if ($stmt == 1) {
                return ['update' => true, 'msj' => 'Cliente actualizado correctamente...'];
            }
            return ['update' => false, 'msj' => 'No se pudo actualizar el cliente...'];
        } catch (PDOException $e) {
            return "Error al eliminar el cliente " . $e->getMessage();
        }
    }
    public function eliminar(ClienteModel $cliente)
    {
        try {
            $sql = "DELETE FROM clientes WHERE clientes.ID_CLIENTE = '{$cliente->getIdCliente()}'";
            $filasAfectadas =  Conexion::con()->exec($sql);
            if ($filasAfectadas <= 0) {
                return ['create' => false, 'msj' => "Error al eliminar al cliente ..."];
            }
            return ['create' => true, 'msj' => "Cliente eliminado correctamente..."];
        } catch (PDOException $e) {
            return "Error eliminar cliente " . $e->getMessage();
        }
    }

    public function buscar(ClienteModel $cliente)
    {
        try {
            $sql = " SELECT clientes.*,barrios.NOMBRE_BARRIO FROM sistema_agua.clientes as clientes
            inner join sistema_agua.barrios as barrios on clientes.ID_BARRIO = barrios.ID_BARRIO 
            WHERE clientes.CEDULA LIKE :cedula";
            $stmt = Conexion::con()->prepare($sql);
            $stmt->bindValue(':cedula', $cliente->getCedula() . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error en buscar cliente" . $e->getMessage();
        }
    }


    public function buscarPorId(ClienteModel $cliente)
    {
        try {
            $sql = " SELECT clientes.*,barrios.NOMBRE_BARRIO FROM sistema_agua.clientes as clientes
            inner join sistema_agua.barrios as barrios on clientes.ID_BARRIO = barrios.ID_BARRIO 
            WHERE clientes.ID_CLIENTE = :id";

            $stmt = Conexion::con()->prepare($sql);
            $stmt->bindValue(':id', $cliente->getIdCliente(), PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_OBJ);
            if (!is_object($res)) {
                return null;
            }
            return $res;
        } catch (PDOException $e) {
            return "Erro al buscar el cliente por id " . $e->getMessage();
        }
    }

    public function buscarPorAny(ClienteModel $cliente)
    {
        try {
            $sql = " SELECT clientes.*,barrios.NOMBRE_BARRIO FROM sistema_agua.clientes as clientes
        inner join sistema_agua.barrios as barrios on clientes.ID_BARRIO = barrios.ID_BARRIO 
        WHERE clientes.NOMBRE LIKE :nombre";

            $stmt = Conexion::con()->prepare($sql);
            $stmt->bindValue(':nombre', $cliente->getNombre() . "%", PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_OBJ);
            if (!is_object($res)) {
                return null;
            }
            return $res;
        } catch (PDOException $e) {
            return "Erro al buscar el cliente por any valor " . $e->getMessage();
        }
    }

    public function getIdBarrio()
    {
        return $this->idBarrio;
    }

    public function setIdBarrio($idBarrio)
    {
        $this->idBarrio = trim(addslashes($idBarrio));
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = trim(addslashes($nombre));
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = trim(addslashes($apellidos));
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function setCedula($cedula)
    {
        $this->cedula = trim(addslashes($cedula));
    }

    public function getCorreo()
    {
        return  $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = trim(addslashes($correo));
    }

    public function getTelefono()
    {
        return  $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = trim(addslashes($telefono));
    }

    public function getNumeroMedidor()
    {
        return $this->numeroMedidor;
    }
    public function setNumeroMedidor($numeroMedidor)
    {
        $this->numeroMedidor = trim(addslashes($numeroMedidor));
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente)
    {
        $this->idCliente = addslashes($idCliente);
    }
}
