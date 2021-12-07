<?php
class MateriaModel extends Mysql{       // MODELO editMateria

    // ATRIBUTOS
    public $id_materia, $nom_materia, $estado;

    // CONSTRUCTOR
    public function __construct(){
        parent::__construct();
    }

    // CONSULTA REGISTROS DE MATERIA
    public function selectMateria()
    {
        $sql = "SELECT * FROM materia";
        $res = $this->select_all($sql);
        return $res;
    }

    // INSERTAR UNA NUEVA MATERIA
    public function insertarMateria(String $nom_materia)
    {
        $this->nom_materia = $nom_materia;
        $query = "INSERT INTO materia(nom_materia) VALUES (?)";
        $data = array($this->nom_materia);
        $this->insert($query, $data);
        return true;
    }

    // ACTUALIZAR DATOS DE UNA MATERIA
    public function editMateria(int $id_materia)
    {
        $sql = "SELECT * FROM materia WHERE id_materia = $id_materia";
        $res = $this->select($sql);                 // recuperar datos de la materia (si existe)
        return $res;
    }

    public function actualizarMateria(int $id_materia, String $nom_materia)
    {
        $this->id_materia = $id_materia;
        $this->nom_materia = $nom_materia;
        $query = "UPDATE materia SET nom_materia = ? WHERE id_materia = ?";
        $data = array($this->nom_materia, $this->id_materia);
        $this->update($query, $data);
        return true;
    }

    // CAMBIAR ESTADO DE UNA MATERIA        1-Activo <=> 0 Inactivo
    public function estadoMateria(int $id_materia, int $estado)
    {
        $this->id_materia = $id_materia;
        $this->estado = $estado;
        $query = "UPDATE materia SET estado = ? WHERE id_materia = ?";
        $data = array($this->estado, $this->id_materia);
        $this->update($query, $data);
        return true;
    }

    // ELIMINAR UN AUTOR
    public function eliminarMateria(int $id_materia)
    {
        $return = "";
        $this->id_materia = $id_materia;
        $query = "DELETE FROM materia WHERE id_materia = ?";
        $data = array($this->id_materia);
        $resul = $this->delete($query, $data);
        $return = $resul;
        return $return;
    }
}
?>