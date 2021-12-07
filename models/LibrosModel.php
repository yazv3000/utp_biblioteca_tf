<?php
class LibrosModel extends Mysql{

    // ATRIBUTOS
    protected $id_recurso, $tipo, $titulo, $autor, $paginas, $editorial, $anio;
    protected $cant_disponible, $descripcion, $imagen, $estado;

    // CONSTRUCTOR
    public function __construct(){
        $this->tipo = 1;
        parent::__construct();
    }

    
    // CONSULTA REGISTROS DE LIBROS
    public function selectLibro()
    {
        $sql = "SELECT r.id_recurso, r.titulo, tr.nom_tipo, r.cant_disponible, a.id_autor, CONCAT(a.nom_autor,' ',a.ape_autor) as autor, ed.nom_editorial as editorial, m.nom_materia as materia,
        r.anio, r.paginas, r.imagen, r.descripcion, r.estado FROM recurso r INNER JOIN autor a on a.id_autor = r.id_autor INNER JOIN editorial ed on ed.id_editorial = r.id_editorial INNER JOIN materia m on m.id_materia = r.id_materia INNER JOIN tipo_recurso tr on r.id_tipo = tr.id_tipo WHERE tr.nom_tipo = 'Libro'";
        
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

    // CONSULTA DE EDITORIALES
    public function selectEditorial()
    {
        $sql = "SELECT * FROM editorial";
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

    // INSERTAR UN RECURSO DE TIPO LIBRO
    public function insertarLibro(String $titulo, int $cant_disponible, int $autor, int $editorial, String $anio, int $materia, int $paginas, String $descripcion, String $imgName)
    {
        $this->titulo = $titulo;
        $this->cant_disponible = $cant_disponible;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->anio = $anio;
        $this->materia = $materia;
        $this->paginas = $paginas;
        $this->descripcion = $descripcion;
        $this->imgName = $imgName;
        $query = "INSERT INTO recurso (id_tipo, titulo, cant_disponible, id_autor, id_editorial, anio, id_materia, paginas, descripcion, imagen) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $data = array($this->tipo, $this->titulo, $this->cant_disponible, $this->autor, $this->editorial,$this->anio, $this->materia, $this->paginas, $this->descripcion, $this->imgName);
        $this->insert($query, $data);
        return true;
    }

    // ACTUALIZAR DATOS DE UN LIBRO
    public function editLibro(int $id_recurso)
    {
        $sql = "SELECT * FROM recurso WHERE id_recurso = $id_recurso";
        $res = $this->select($sql);
        return $res;
    }

    public function actualizarLibro(int $id_recurso, String $titulo, int $cant_disponible, int $autor, int $editorial, String $anio, int $materia, int $paginas, String $descripcion, String $imgName)
    {
        $this->id_recurso = $id_recurso;
        $this->titulo = $titulo;
        $this->cant_disponible = $cant_disponible;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->anio = $anio;
        $this->materia = $materia;
        $this->paginas = $paginas;
        $this->descripcion = $descripcion;
        $this->imgName = $imgName;
        
        $query = "UPDATE recurso SET titulo=?, cant_disponible=?, id_autor=?, id_editorial=?, anio=?, id_materia=?, paginas=?, descripcion=?, imagen=? WHERE id_recurso = ?";
        $data = array($this->titulo, $this->cant_disponible, $this->autor, $this->editorial,$this->anio, $this->materia, $this->paginas, $this->descripcion, $this->imgName, $this->id_recurso);
        $this->update($query, $data);
        return true;
    }

    // CAMBIAR ESTADO DE UN LIBRO        1-Activo <=> 0 Inactivo
    public function estadoLibro(int $id_recurso, int $estado)
    {
        $this->estado = $estado;
        $this->id_recurso = $id_recurso;
        $query = "UPDATE recurso SET estado = ? WHERE id_recurso = ?";
        $data = array($this->estado, $this->id_recurso);
        $this->update($query, $data);
        return true;
    }
    
    // ELIMINAR UN LIBRO
    public function eliminarLibro(int $id_recurso)
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
