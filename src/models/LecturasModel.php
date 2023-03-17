<?php
class LecturasModel
{
    private $idLectura;
    private $idCliente;
    private $lectura;
    private $fechaRegistro;
    private $mes;
    private $db;

    public function __construct()
    {
        $this->db =  Conexion::con();
    }


    public function listar()
    {
        try {
            $sql = "SELECT L.*,C.N_MEDIDOR,C.ESTADO,C.CEDULA,C.NOMBRE,C.APELLIDOS FROM lecturas AS L INNER JOIN clientes AS C ON L.ID_CLIENTE = C.ID_CLIENTE ORDER BY L.ID_LECTURA ASC";
            $stmt = Conexion::con()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error en listar lecturas " . $e->getMessage();
        }
    }

    public function registrar(LecturasModel $lectura)
    {
        try {
            $sql = "INSERT INTO lecturas (ID_CLIENTE,LECTURA,FECHA_REGISTRO,MES) VALUES (:idCliente,:lectura,:fechaRegistro,:mes)";
            $stmt = Conexion::con()->prepare($sql);
            $stmt->bindValue(':idCliente', $lectura->getIdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(':lectura', $lectura->getLectura(), PDO::PARAM_STR);
            $stmt->bindValue(':fechaRegistro', $lectura->getFechaRegistro(), PDO::PARAM_STR);
            $stmt->bindValue(':mes', $lectura->getMes(), PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                return ['create' => true, 'msj' => 'Lectura registrada con exito...'];
            }
            return ['create' => false, 'msj' => 'Error al crear la lectura...'];
        } catch (PDOException $e) {
            return "Error al registrar lectura " . $e->getMessage();
        }
    }


    public function registrarLectura(LecturasModel $lectura)
    {
        try {
            $sql = "INSERT INTO lecturas (ID_CLIENTE,LECTURA,FECHA_REGISTRO,MES) VALUES (:idCliente,:lectura,:fechaRegistro,:mes)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idCliente', $lectura->getIdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(':lectura', $lectura->getLectura(), PDO::PARAM_STR);
            $stmt->bindValue(':fechaRegistro', $lectura->getFechaRegistro(), PDO::PARAM_STR);
            $stmt->bindValue(':mes', $lectura->getMes(), PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $upda = "UPDATE clientes SET ESTADO = 'ACTIVO' WHERE ID_CLIENTE = '{$lectura->getIdCliente()}'";
                $sentencia = $this->db->exec($upda);
                if ($sentencia == 1) {
                    return ['create' => true, 'msj' => 'Lectura registrada con exito...'];
                }
            }
            return ['create' => false, 'msj' => 'Error al crear la lectura...'];
        } catch (PDOException $e) {
            return "Error al registrar lectura " . $e->getMessage();
        }
    }

    public function listarPorID(LecturasModel $lectura)
    {
        try {
            $sql = "SELECT L.*,C.N_MEDIDOR,C.ESTADO,C.CEDULA,C.NOMBRE,C.APELLIDOS FROM lecturas AS L INNER JOIN clientes AS C ON L.ID_CLIENTE = C.ID_CLIENTE ORDER BY L.ID_LECTURA ASC";
            $stmt = Conexion::con()->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error en listar lecturas " . $e->getMessage();
        }
    }

    public function obtenerLecturaPorID(LecturasModel $lectura)
    {
        try {
            $sql = "SELECT lectura FROM lecturas WHERE ID_CLIENTE =:id ORDER BY ID_LECTURA DESC LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $this->getIdCliente(), PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error al buscar lectura " . $e->getMessage();
        }
    }


    public function getIdLectura()
    {
        return $this->idLectura;
    }


    public function setIdLectura($idLectura)
    {
        $this->idLectura = $idLectura;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }


    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }


    public function getLectura()
    {
        return $this->lectura;
    }


    public function setLectura($lectura)
    {
        $this->lectura = $lectura;
    }

    public function getMes()
    {
        return $this->mes;
    }


    public function setMes($mes)
    {
        $this->mes = $mes;
    }

    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }
}
