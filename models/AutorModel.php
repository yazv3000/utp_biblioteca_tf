<?php
class AutorModel extends Mysql{     // MODELO AUTOR

    // ATRIBUTOS
    protected $id_autor, $nom_autor, $ape_autor, $imagen;

    // CONSTRUCTOR
    public function __construct(){
        parent::__construct();
    }

    // CONSULTA REGISTROS DE AUTORES
    public function selectAutor()
    {
        $sql = "SELECT * FROM autor";
        $res = $this->select_all($sql);
        return $res;
    }

    // INSERTAR UN NUEVO AUTOR
    public function insertarAutor(String $nom_autor, String $ape_autor, String $imagen)
    {
        $this->nom_autor = $nom_autor;
        $this->ape_autor = $ape_autor;
        $this->imagen = $imagen;
        $query = "INSERT INTO autor(nom_autor, ape_autor, imagen) VALUES (?,?,?)";
        $data = array($this->nom_autor, $this->ape_autor, $this->imagen);
        $this->insert($query, $data);
        return true;
    }

    // ACTUALIZAR DATOS DEL AUTOR
    public function editAutor(int $id_autor)
    {
        $sql = "SELECT * FROM autor WHERE id_autor = $id_autor";    // recupera datos del autor (si existe)
        $res = $this->select($sql);
        return $res;
    }

    public function actualizarAutor(int $id_autor, String $nom_autor, String $ape_autor, String $imagen)
    {
        $this->id_autor = $id_autor;
        $this->nom_autor = $nom_autor;
        $this->ape_autor = $ape_autor;
        $this->imagen = $imagen;
        $query = "UPDATE autor SET nom_autor = ?, ape_autor = ?, imagen = ? WHERE id_autor = ?";
        $data = array($this->nom_autor, $this->ape_autor, $this->imagen, $this->id_autor);
        $this->update($query, $data);
        return true;
    }

    // CAMBIAR ESTADO DE UN AUTOR        1-Activo <=> 0 Inactivo
    public function estadoAutor(int $id_autor, int $estado)
    {
        $this->estado = $estado;
        $this->id_autor = $id_autor;
        $query = "UPDATE autor SET estado = ? WHERE id_autor = ?";
        $data = array($this->estado, $this->id_autor);
        $this->update($query, $data);
        return true;
    }

    // ELIMINAR UN AUTOR
    public function eliminarAutor(int $id_autor)
    {
        $return = "";
        $this->id_autor = $id_autor;
        $query = "DELETE FROM autor WHERE id_autor = ?";
        $data = array($this->id_autor);
        $resul = $this->delete($query, $data);
        $return = $resul;
        return $return;
    }
    
}
