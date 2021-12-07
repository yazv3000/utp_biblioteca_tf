<?php
class AdminModel extends Mysql{             // MODELO ADMINISTRADOR

    // CONSTRUCTOR
    public function __construct(){
        parent::__construct();
    }

    // CONSULTAS DE RECURSOS (LIBROS, ARTÍCULOS, REVISTAS)
    public function selectRecursos($tipo_recurso)
    {
        $sql = "SELECT r.*, tr.nom_tipo FROM recurso r INNER JOIN tipo_recurso tr ON r.id_tipo = tr.id_tipo WHERE r.estado = 1 AND tr.nom_tipo='$tipo_recurso'";      // selecciona los libros activos
        $res = $this->select_all($sql);
        return $res;
    }

    public function selectRecursoCantidad(int $id)
    {
        $sql = "SELECT * FROM recurso r WHERE id_recurso = $id"; 
        $res = $this->select($sql);
        return $res;
    }

    // CONSULTA DE ESTUDIANTES
    public function selectEstudiantes()
    {
        $sql = "SELECT * FROM estudiante WHERE estado = 1";     // estudiantes activos
        $res = $this->select_all($sql);
        return $res;
    }

    // CONSULTAS DE PRÉSTAMOS
    public function selectSolicitudes(){
        $sql = "SELECT p.id_prestamo, r.id_recurso, r.titulo, e.codigo, CONCAT(e.nombres,' ', e.apellidos), p.cantidad FROM prestamo p INNER JOIN recurso r ON p.id_recurso = r.id_recurso INNER JOIN tipo_recurso tr ON r.id_tipo = tr.id_tipo INNER JOIN estudiante e ON p.cod_estudiante = e.codigo WHERE p.estado_solicitud=0";
        $res = $this->select_all($sql);
        return $res;
    }

    public function aprobarPrestamo(int $id_prestamo, String $fecha_prestamo, String $fecha_lim_dev, String $observacion)
    {
        $this->id_prestamo = $id_prestamo;
        $this->fecha_prestamo = $fecha_prestamo;
        $this->fecha_lim_dev = $fecha_lim_dev;
        $this->estado_solicitud = 1;        // aprobado
        $this->estado_prestamo = 1;                  // sin devolver

        $query = "UPDATE prestamo SET estado_solicitud = ?, fecha_prestamo = ?, fecha_lim_dev = ?, estado_prestamo = ? WHERE id_prestamo = ?";
        $data = array($this->estado_solicitud , $this->fecha_prestamo, $this->fecha_lim_dev, $this->estado_prestamo, $this->id_prestamo);
        $this->update($query, $data);
        return true;
    }

    public function selectPrestamos()
    {
        $sql = "SELECT p.id_prestamo, r.id_recurso, r.titulo, tr.nom_tipo, e.codigo, CONCAT(e.nombres,' ', e.apellidos) as nom_estudiante, p.fecha_prestamo, p.fecha_lim_dev, p.cantidad, p.observacion, p.estado_prestamo FROM prestamo p INNER JOIN recurso r ON p.id_recurso = r.id_recurso INNER JOIN tipo_recurso tr ON r.id_tipo = tr.id_tipo INNER JOIN estudiante e ON p.cod_estudiante = e.codigo WHERE p.estado_solicitud=1";
        $res = $this->select_all($sql);
        return $res;
    }

    public function selectPrestamoCantidad($id)
    {
        $sql = "SELECT * FROM prestamo WHERE estado_prestamo = 1 and id_prestamo=$id";       // préstamos sin devolder
        $res = $this->select($sql);
        return $res;
    }

    public function insertarPrestamo(String $estudiante, int $recurso, int $cantidad, String $fecha_solicitud, String $fecha_prestamo, String $fecha_lim_dev, String $observacion)
    {
        $this->estudiante = $estudiante;
        $this->recurso = $recurso;
        $this->cantidad = $cantidad;
        $this->fecha_solicitud = $fecha_solicitud;
        $this->estado_solicitud = 1;                 // aprobado
        $this->fecha_prestamo = $fecha_prestamo;
        $this->fecha_lim_dev = $fecha_lim_dev;
        $this->observacion = $observacion;
        $this->estado_prestamo = 1;                  // sin devolver

        $query = "INSERT INTO prestamo(cod_estudiante, id_recurso, cantidad, fecha_solicitud, estado_solicitud, fecha_prestamo, fecha_lim_dev, estado_prestamo, observacion) VALUES (?,?,?,?,?,?,?,?,?)";
        $data = array($this->estudiante, $this->recurso,  $this->cantidad, $this->fecha_solicitud, $this->estado_solicitud, $this->fecha_prestamo, $this->fecha_lim_dev, $this->estado_prestamo, $this->observacion);
        $this->insert($query, $data);
        return true;
    }

    public function cambiarEstadoPrestamo(int $id_prestamo, String $obser, int $estado, bool $devuelto) 
    {
        $this->observacion = $obser;
        $this->estado_prestamo = $estado;
        $this->id_prestamo = $id_prestamo;
        if($devuelto){
            $query = "UPDATE prestamo SET observacion = ?, estado_prestamo = ?, fecha_real_dev = current_date() WHERE id_prestamo = ?";
        }else{
            $query = "UPDATE prestamo SET observacion = ?, estado_prestamo = ? WHERE id_prestamo = ?";
        }
        $data = array($this->observacion, $this->estado_prestamo, $this->id_prestamo);
        $this->update($query, $data);
        return true;
    }

    public function actualizarCantidad(String $cantidad, int $id)
    {
        $this->cantidad = $cantidad;
        $this->recurso = $id;
        $query = "UPDATE recurso SET cant_disponible = ? WHERE id_recurso = ?";
        $data = array($this->cantidad, $this->recurso);
        $this->update($query, $data);
        return true;
    }

    public function selectPrestamoDebe()
    {
        $sql = "SELECT p.id_prestamo, r.id_recurso, tr.nom_tipo, r.titulo, CONCAT(e.nombres,' ', e.apellidos) as nom_estudiante, p.fecha_prestamo, p.fecha_lim_dev, p.cantidad, p.observacion, p.estado_prestamo FROM prestamo p INNER JOIN recurso r ON p.id_recurso = r.id_recurso INNER JOIN tipo_recurso tr ON r.id_tipo = tr.id_tipo INNER JOIN estudiante e ON p.cod_estudiante = e.codigo WHERE p.estado_solicitud = 1 AND p.estado_prestamo=1";
        $res = $this->select_all($sql);
        return $res;
    }

    // CONSULTA CONFIGURACIÓN DEL SISTEMA
    public function selectDatos()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
}
