<?php

// CONTROLADOR ESTUDIANTES
class Estudiantes extends Controllers {
        
    // CONSTRUCTOR
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();
    }

     // LISTAR ESTUDIANTES REGISTRADOS
    public function estudiantes(){
        $estudiante = $this->model->selectEstudiante();
        $carreras = $this->model->selectCarrera();
        $data = ['estudiantes' => $estudiante, 'carreras' => $carreras];
        $this->views->getView($this, "listar", $data);
    }

    // REGISTRAR NUEVO ESTUDIANTE
    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $dni = $_POST['dni'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $id_carrera = $_POST['id_carrera'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $insert = $this->model->insertarEstudiante($codigo, $dni, $nombres, $apellidos, $id_carrera, $direccion, $telefono);
        if ($insert) {
            header("location: ".base_url()."estudiantes");
            die();    
        }
    }

    // ACTUALIZAR DATOS DE UN ESTUDIANTE
    public function editar()
    {
        $codigo = $_GET['id'];
        $carreras = $this->model->selectCarrera();
        $estudiante = $this->model->editEstudiante($codigo);
        $data = ['estudiante' => $estudiante, 'carreras' => $carreras];
        if ($data == 0) {
            $this->estudiantes();
        } else {
            $this->views->getView($this, "editar", $data);
        }
    }

    public function modificar()
    {
        $codigo = $_POST['codigo'];
        $dni = $_POST['dni'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $id_carrera = $_POST['carrera'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $actualizar = $this->model->actualizarEstudiante($codigo, $dni, $nombres, $apellidos, $id_carrera, $direccion, $telefono);
        if ($actualizar) {   
            header("location: ".base_url()."estudiantes"); 
            die();
        }
    }

    // ELIMINAR UN ESTUDIANTE (ELIMINA TAMBIÉN LOS PRÉSTAMOS QUE TENÍA REGISTRADOS)
    public function eliminar(){
        $codigo = $_POST['codigo'];
        $this->model->eliminarEstudiante($codigo);
        header("location: ".base_url()."estudiantes");
        die();
    }

    // CAMBIAR ESTADO DE UN ESTUDIANTE        1-Activo <=> 0 Inactivo
    
    public function darBaja()
    {
        $codigo = $_POST['codigo'];
        $this->model->estadoEstudiante($codigo, 0);
        header("location: " . base_url() . "estudiantes");
        die();
    }
    public function reingresar()
    {
        $codigo = $_POST['codigo'];
        $this->model->estadoEstudiante($codigo, 1);
        header("location: " . base_url() . "estudiantes");
        die();
    }
}
?>