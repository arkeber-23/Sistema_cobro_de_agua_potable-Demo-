<?php
class BarriosModel
{
    private int $idBarrio;
    private String $nombreBarrio;


    public function __construct()
    {
    }



    public function listar()
    {
        try {
            $sql = "SELECT * FROM barrios";
            $stmt = Conexion::con()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return "Error listar Barrios: " . $e->getMessage();
        }
    }

    public function getIdBarrio()
    {
        return $this->idBarrio;
    }

    public function setIdBarrio($idBarrio)
    {
        $this->idBarrio = $idBarrio;
    }

    public function setNombreBarrio($nombreBarrio)
    {
        $this->nombreBarrio = $nombreBarrio;
    }

    public function getNombreBarrio()
    {
        return $this->nombreBarrio;
    }
}
