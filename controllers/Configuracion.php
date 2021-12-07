<?php

    // CONTROLADOR CONFIGURACIÓN
    class Configuracion extends Controllers{    

        // CONSTRUCTOR
        public function __construct() {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url());
            }
            parent::__construct();
        }

        // MÉTODOS
        public function listar(){
            $data = $this->model->selectConfiguracion();         
            $this->views->getView($this, "Listar", $data, "");
        }

        public function actualizar(){
            $id_config= $_POST['id'];
            $empresa = $_POST['empresa'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $actualizar = $this->model->actualizarConfiguracion($id_config, $empresa, $telefono, $direccion);
            if ($actualizar) {
                header("location: ".base_url()."configuracion/listar");
            }
            die();
        }
    }
