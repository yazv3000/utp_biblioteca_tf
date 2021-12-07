<?php

    class Home extends Controllers{

        // CONSTRUCTOR
        public function __construct(){
            session_start();
            if (!empty($_SESSION['activo'])) {
                header("location: ".base_url()."admin/listar");
            }
            parent::__construct();
        }

        // MÉTODO home
        public function home($params){
            $this->views->getView($this, "home");
        }

        // INICIO DE SESIÓN - PERSONAL (ADMINISTRADORES Y SUPERVISORES)
        public function login(){
            if (empty($_POST['usuario']) || empty($_POST['clave'])) {
                $usuario = $_POST['usuario'];
                $clave = $_POST['clave'];
                $data = $this->model->selectUsuario($usuario, $clave);  // devuelve un array con los datos del usuario
                
                if (!empty($data)) {
                    if (password_verify($clave, $data['clave'])) {      // verifica que la contraseña y el hash coincidan
                        $_SESSION['id_user'] = $data['id_user'];
                        $_SESSION['usuario'] = $data['usuario'];
                        $_SESSION['nombres'] = $data['nombres'];
                        $_SESSION['apellidos'] = $data['apellidos'];
                        $_SESSION['dni'] = $data['dni'];
                        $_SESSION['rol'] = $data['rol'];
                        $_SESSION['activo'] = true;
                        //header("location: Productos/Listar");
                    } else {
                        $data['error'] = "Las Contraseñas no coinciden";
                        print_r($data);
                        //$this->views->getView($this, "home", $data);
                    }
                } else {
                    $data['error'] = "El usuario no existe";
                    print_r($data);
                    //$this->views->getView($this, "home");
                }
            }
        }
    }
?>