<?php
class TesisModel extends Mysql{

    // ATRIBUTOS
    protected $id_recurso, $tipo, $titulo, $autor, $anio;
    protected $materia, $cant_disponible, $paginas, $descripcion, $estado;

    // CONSTRUCTOR
    public function __construct(){
        $this->tipo = 3;
        parent::__construct();
    }

    
    // CONSULTA REGISTROS DE TESIS
    public function selectTesis()
    {
        $sql = "SELECT r.id_recurso, r.titulo, tr.nom_tipo, r.cant_disponible, a.id_autor, CONCAT(a.nom_autor,' ',a.ape_autor) as autor, m.nom_materia as materia,
        r.anio, r.paginas, r.descripcion, r.estado FROM recurso r INNER JOIN autor a on a.id_autor = r.id_autor INNER JOIN materia m on m.id_materia = r.id_materia INNER JOIN tipo_recurso tr on r.id_tipo = tr.id_tipo WHERE tr.nom_tipo = 'Tesis'";
        
        $res = $this->select_all($sql);
        return $res;
    }

    // CONSULTA DE MATERIAS
    public function selectMateria()
    {
        $sql = "SELECT * FROM materia";
        $res = $this->select_all($sql);
        return $res;
    }

    // CONSULTA DE AUTORES
    public function selectAutor()
    {
        $sql = "SELECT * FROM autor";
        $res = $this->select_all($sql);
        return $res;
    }

    // INSERTAR UN RECURSO DE TIPO TESIS
    public function insertarTesis(String $titulo, int $cant_disponible, int $autor, String $anio, int $materia, int $paginas, String $descripcion)
    {
        $this->titulo = $titulo;
        $this->cant_disponible = $cant_disponible;
        $this->autor = $autor;
        $this->anio = $anio;
        $this->materia = $materia;
        $this->paginas = $paginas;
        $this->descripcion = $descripcion;

        $query = "INSERT INTO recurso (id_tipo, titulo, cant_disponible, id_autor, anio, id_materia, paginas, descripcion) VALUES (?,?,?,?,?,?,?,?)";
        $data = array($this->tipo, $this->titulo, $this->cant_disponible, $this->autor, $this->anio, $this->materia, $this->paginas, $this->descripcion);
        $this->insert($query, $data);
        return true;
    }

    // ACTUALIZAR DATOS DE UN RECURSO
    public function editTesis(int $id_recurso)
    {
        $sql = "SELECT * FROM recurso WHERE id_recurso = $id_recurso";
        $res = $this->select($sql);
        return $res;
    }

    public function actualizarTesis(int $id_recurso, String $titulo, int $cant_disponible, int $autor, String $anio, int $materia, int $paginas, String $descripcion)
    {
        $this->id_recurso = $id_recurso;
        $this->titulo = $titulo;
        $this->cant_disponible = $cant_disponible;
        $this->autor = $autor;
        $this->anio = $anio;
        $this->materia = $materia;
        $this->paginas = $paginas;
        $this->descripcion = $descripcion;

        $query = "UPDATE recurso SET titulo=?, cant_disponible=?, id_autor=?, anio=?, id_materia=?, paginas=?, descripcion=? WHERE id_recurso = ?";
        $data = array($this->titulo, $this->cant_disponible, $this->autor, $this->anio, $this->materia, $this->paginas, $this->descripcion, $this->id_recurso);
        $this->update($query, $data);
        return true;
    }

    // CAMBIAR ESTADO DE UNA TESIS        1-Activo <=> 0 Inactivo
    public function estadoTesis(int $id_recurso, int $estado)
    {
        $this->estado = $estado;
        $this->id_recurso = $id_recurso;
        $query = "UPDATE recurso SET estado = ? WHERE id_recurso = ?";
        $data = array($this->estado, $this->id_recurso);
        $this->update($query, $data);
        return true;
    }
    
    // ELIMINAR UNA TESIS
    public function eliminarTesis(int $id_recurso)
    {
        $return = "";
        $this->id_recurso = $id_recurso;
        $query = "DELETE FROM recurso WHERE id_recurso = ?";
        $data = array($this->id_recurso);
        $resul = $this->delete($query, $data);
        $return = $resul;
        return $return;
    }
}
