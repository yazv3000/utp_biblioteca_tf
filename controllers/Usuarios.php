<?php

    // CONTROLADOR AUTOR
    class Usuarios extends Controllers{

        // CONSTRUCTOR
        public function __construct() {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url());
            }
            parent::__construct();
        }

        // LISTAR USUARIOS REGISTRADOS
        public function listar()
        {
            $data = $this->model->selectUsuarios();
            $this->views->getView($this, "listar", $data);
        }

        // REGISTRAR NUEVO USUARIO
        public function insertar()
        {
            $usuario = $_POST['usuario'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $dni = $_POST['dni'];
            $clave = $_POST['clave'];
            $rol = $_POST['rol'];
            $hash = hash("SHA256", $clave);
            $this->model->insertarUsuarios($usuario, $nombres, $apellidos, $dni, $hash, $rol);
            header("location: ".base_url()."usuarios/listar");
            die();
        }

        // ACTUALIZAR DATOS DE UN USUARIO
        public function editar()
        {
            $id = $_GET['id'];
            $data = $this->model->editarUsuarios($id);
            if ($data == 0) {
                $this->Listar();
            } else {
                $this->views->getView($this, "Editar", $data);
            }
        }

        public function actualizar()
        {
            $id = $_POST['id'];
            $usuario = $_POST['usuario'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $dni = $_POST['dni'];
            $rol = $_POST['rol'];
            $actualizar = $this->model->actualizarUsuarios($id, $usuario, $nombres, $apellidos, $dni, $rol);
            if ($actualizar == 1) {
                $alert = 'Modificado';
            } else {
                $alert = 'Error';
            }
            header("location: " . base_url() . "usuarios/listar");
            die();
        }


        public function darBaja()
        {
            $id = $_POST['id'];
            $this->model->darBajaUsuario($id);
            header("location: " . base_url() . "usuarios/listar");
            die();
        }

        public function eliminar()
        {
            $id = $_POST['id'];
            $this->model->eliminarUsuario($id);
            header("location: " . base_url() . "usuarios/listar");
            die();
        }

        public function reingresar()
        {
            $id = $_POST['id'];
            $this->model->reingresarUsuario($id);
            $this->model->selectUsuarios();
            header('location: '. base_url().'usuarios/listar');
            die();
        }

        // INICIO DE SESIÓN 
        public function login()
        {
            if (!empty($_POST['usuario']) || !empty($_POST['clave'])) {
                $usuario = $_POST['usuario'];
                $clave = $_POST['clave'];
                $hash = hash("SHA256", $clave);
                $data = $this->model->selectUsuario($usuario, $hash);
                if (!empty($data)) {
                        $_SESSION['id'] = $data['id_user'];
                        $_SESSION['usuario'] = $data['usuario'];
                        $_SESSION['nombres'] = $data['nombres'];
                        $_SESSION['apellidos'] = $data['apellidos'];
                        $_SESSION['nombres'] = $data['nombres'];
                        $_SESSION['dni'] = $data['dni'];
                        $_SESSION['rol'] = $data['rol'];
                        $_SESSION['activo'] = true;
                        header('location: '.base_url(). 'admin/listar');
                } else {
                    $error = 0;
                    header("location: ".base_url()."?msg=$error");
                }
            }
        }

        // CAMBIO DE CONTRASEÑA
        public function cambiar()
        {
            $id = $_SESSION['id'];
            $actual = $_POST['actual'];
            $hash = hash("SHA256", $actual);
            $nueva = hash("SHA256", $_POST['nueva']);
            $data = $this->model->cambiarPass($hash, $id);
            if ($data != null || $data != "") {
                $cambio = $this->model->cambiarContra($nueva, $id);
                if ($cambio == 1) {
                    header("Location: " . base_url(). "usuarios/salir");
                }
            }else{
                header("Location: " . base_url() . "usuarios/listar?error");
            }  
        }

        // VER PERFIL - USUARIO
        public function perfil()
        {

            $data = $this->model->selectUsuariosPass(1);
            $this->views->getView($this, "cambiarPass", $data);
        }

        // CERRAR SESIÓN
        public function salir()
        {
            session_destroy();
            header("Location: ".base_url());
        }
    }
?>