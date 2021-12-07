<?php

    // CONTROLADOR EDITORIAL
    class Editorial extends Controllers {
       
        // CONSTRUCTOR
        public function __construct() {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url());
            }
            parent::__construct();
        }

        // LISTAR EDITORIALES REGISTRADAS
        public function editorial()
        {
            $data = $this->model->selectEditorial();
            $this->views->getView($this, "listar", $data);
        }

        // REGISTRAR NUEVA EDITORIAL
        public function registrar()
        {
            $nom_editorial = $_POST['nombre'];
            $insert = $this->model->insertarEditorial($nom_editorial);
            if ($insert) {
                header("location: ".base_url()."editorial");
                die();    
            }
        }
       
        // ACTUALIZAR DATOS DE UNA EDITORIAL
        public function editar()
        {
            $id_editorial = $_GET['id'];
            $data = $this->model->editEditorial($id_editorial);
            if ($data == 0) {
                $this->editorial();
            } else {
                $this->views->getView($this, "editar", $data);
            }
        }

        public function modificar()
        {
            $id_editorial = $_POST['id_editorial'];
            $nom_editorial = $_POST['nombre'];
            $actualizar = $this->model->actualizarEditorial($id_editorial, $nom_editorial);
            if ($actualizar) {   
                header("location: " . base_url() . "editorial");
                die();
            }
        }

        // ELIMINAR UNA EDITORIAL (ELIMINA TAMBIÉN LOS LIBROS EN LOS QUE APARECE)
        public function eliminar(){
            $id_editorial = $_POST['id_editorial'];
            $this->model->eliminarEditorial($id_editorial);
            header("location: ".base_url()."editorial");
            die();
        }

        // CAMBIAR ESTADO DE UN AUTOR        1-Activo <=> 0 Inactivo

        public function darBaja()
        {
            $id_editorial = $_POST['id_editorial'];
            $this->model->estadoEditorial($id_editorial, 0);
            header("location: " . base_url() . "editorial");
            die();
        }

        public function reingresar()
        {
            $id_editorial = $_POST['id_editorial'];
            $this->model->estadoEditorial($id_editorial, 1);
            header("location: ".base_url()."editorial");
            die();
        }
        
    }
?>