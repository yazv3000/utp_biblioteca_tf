<?php

class EditorialModel extends Mysql{     // MODELO EDITORIAL
    
    // ATRIBUTOS
    public $id, $nombre, $estado;

    // CONSTRUCTOR
    public function __construct() {
        parent::__construct();
    }

    // MÉTODOS
    public function selectEditorial()
    {
        $sql = "SELECT * FROM editorial";
        $res = $this->select_all($sql);
        return $res;
    }

    // INSERTAR UN REGISTRO DE EDITORIAL
    public function insertarEditorial(String $nom_editorial)
    {
        $this->nombre = $nom_editorial;
        $query = "INSERT INTO editorial(nom_editorial) VALUES (?)";
        $data = array($this->nombre);
        $this->insert($query, $data);
        return true;
    }

    // ACTUALIZAR LOS DATOS DE UNA EDITORIAL
    public function editEditorial(int $id_editorial)
    {
        $sql = "SELECT * FROM editorial WHERE id_editorial = $id_editorial";       // verificar si la editorial existe
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarEditorial(int $id_editorial, String $nom_editorial)
    {
        $this->nombre = $nom_editorial;
        $this->id = $id_editorial;
        $query = "UPDATE editorial SET nom_editorial = ? WHERE id_editorial = ?";
        $data = array($this->nombre, $this->id);
        $this->update($query, $data);
        return true;
    }

    // CAMBIAR ESTADO DE LA EDITORIAL    1-Activo <=> 0 Inactivo
    public function estadoEditorial(int $id_editorial, int $estado)
    {
        $this->estado = $estado;
        $this->id = $id_editorial;
        $query = "UPDATE editorial SET estado = ? WHERE id_editorial = ?";
        $data = array($this->estado, $this->id);
        $this->update($query, $data);
        return true;
    }

    // ELIMINAR UNA EDITORIAL
    public function eliminarEditorial(int $id_editorial){
        
        $return = "";
        $this->id = $id_editorial;
        $query = "DELETE FROM editorial WHERE id_editorial = ?";
        $data = array($this->id);
        $resul = $this->delete($query, $data);
        $return = $resul;
        return $return;
    }
}
?>