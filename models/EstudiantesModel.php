<?php
class EstudiantesModel extends Mysql{       // MODELO ESTUDIANTES

    // CONSTRUCTOR
    public function __construct(){
        parent::__construct();
    }

    // CONSULTA REGISTROS DE ESTUDIANTES
    public function selectEstudiante()
    {
        $sql = "SELECT e.*, c.nom_carrera FROM estudiante e INNER JOIN carrera c on c.id_carrera = e.id_carrera";
        $res = $this->select_all($sql);
        return $res;
    }

    // CONSULTA CARRERAS
    public function selectCarrera()
    {
        $sql = "SELECT * FROM carrera";
        $res = $this->select_all($sql);
        return $res;
    }

    // INSERTAR UN REGISTRO ESTUDIANTE
    public function insertarEstudiante(String $codigo, String $dni, String $nombres, String $apellidos, String $id_carrera, String $direccion, String $telefono)
    {
        $this->codigo = $codigo;
        $this->dni = $dni;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->id_carrera = $id_carrera;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $query = "INSERT INTO estudiante(codigo, dni, nombres, apellidos, id_carrera, direccion, telefono) VALUES (?,?,?,?,?,?,?)";
        $data = array($this->codigo, $this->dni, $this->nombres, $this->apellidos, $this->id_carrera, $this->direccion, $this->telefono);
        $this->insert($query, $data);
        return true;
    }

    // ACTUALIZAR DATOS DE UN ESTUDIANTE
    public function editEstudiante(String $codigo) 
    {
        $sql = "SELECT * FROM estudiante WHERE codigo = '$codigo'";
        $res = $this->select($sql);
        return $res;
    }

    public function actualizarEstudiante(String $codigo, String $dni, String $nombres, String $apellidos, String $id_carrera, String $direccion, String $telefono)
    {
        $this->codigo = $codigo;
        $this->dni = $dni;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->id_carrera = $id_carrera;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $query = "UPDATE estudiante SET dni = ?, nombres = ?, apellidos = ?, id_carrera = ?, direccion = ?, telefono = ? WHERE codigo = ?";
        $data = array($this->dni, $this->nombres, $this->apellidos, $this->id_carrera, $this->direccion, $this->telefono, $this->codigo);
        $this->update($query, $data);
        return true;
    }

    // CAMBIAR ESTADO DE UN ESTUDIANTE        1-Activo <=> 0 Inactivo
    public function estadoEstudiante(String $codigo, int $estado)
    {
        $this->estado = $estado;
        $this->codigo = $codigo;
        $query = "UPDATE estudiante SET estado = ? WHERE codigo = ?";
        $data = array($this->estado, $this->codigo);
        $this->update($query, $data);
        return true;
    }
        
    // ELIMINAR UN ESTUDIANTE
    public function eliminarEstudiante(String $codigo)
    {
        $return = "";
        $this->codigo = $codigo;
        $query = "DELETE FROM estudiante WHERE codigo = ?";
        $data = array($this->codigo);
        $resul = $this->delete($query, $data);
        $return = $resul;
        return $return;
    }
}
?>