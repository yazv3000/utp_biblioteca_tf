<?php

// CONTROLADOR DE MATERIA
class Materia extends Controllers {

    public function __construct(){
        
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
        parent::__construct();      // invoca al constructor de Controllers, el cual carga el modelo y la vista
    }

    // LISTAR MATERIAS REGISTRADOS
    public function materia() {
        $data = $this->model->selectMateria();
        $this->views->getView($this, "listar", $data);
    }

    // REGISTRAR NUEVA MATERIA
    public function registrar()
    {
        $nom_materia = $_POST['nombre'];
        $insert = $this->model->insertarMateria($nom_materia);
        if ($insert) {
            header("location: ".base_url()."materia");
            die();    
        }
    }

    // ACTUALIZAR DATOS DE UNA MATERIA
    public function editar()
    {
        $id_materia = $_GET['id'];
        $data = $this->model->editMateria($id_materia);
        if ($data == 0) {
            $this->materia();
        } else {
            $this->views->getView($this, "editar", $data);
        }
    }

    public function modificar()
    {
        $id_materia = $_POST['id_materia'];
        $nom_materia = $_POST['nombre'];
        $actualizar = $this->model->actualizarMateria($id_materia, $nom_materia);
        if ($actualizar) {   
            header("location: ".base_url()."materia");
            die();
        }
    }

    // ELIMINAR UNA MATERIA (ELIMINA TAMBIÉN LOS LIBROS/REVISTAS/TESIS EN LOS QUE APARECE)
    public function eliminar()
    {
        $id_materia = $_POST['id_materia'];
        $this->model->eliminarMateria($id_materia);
        header("location: ".base_url()."materia");
        die();
    }

    // CAMBIAR ESTADO DE UNA MATERIA        1-Activo <=> 0 Inactivo
    public function darBaja()
    {
        $id_materia = $_POST['id_materia'];
        $this->model->estadoMateria($id_materia, 0);
        header("location: " . base_url() . "materia");
        die();
    }

    public function reingresar()
    {
        $id_materia = $_POST['id_materia'];
        $this->model->estadoMateria($id_materia, 1);
        header("location: " . base_url() . "materia");
        die();
    }
}
?>