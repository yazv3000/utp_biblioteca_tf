<?php

    // CONTROLADOR AUTOR
    class Autor extends Controllers{

        // CONSTRUCTOR
        public function __construct(){
            session_start();

            if (empty($_SESSION['activo'])) {
                header("location: ".base_url());
            }
            
            parent::__construct();       // invoca al constructor de Controllers, el cual carga el modelo y la vista

        }

        // LISTAR AUTORES REGISTRADOS
        public function autor(){
            $data = $this->model->selectAutor();         
            $this->views->getView($this, "listar", $data);
        }

        // REGISTRAR NUEVO AUTOR
        public function registrar()
        {
            $nom_autor = $_POST['nombres'];
            $ape_autor = $_POST['apellidos'];
            $img = $_FILES['imagen'];
            $nombre = $img['name'];
            $nombreTemp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $nombre;
            $destino = "assets/images/autor/".$fecha;
            if ($nombre == null || $nombre == "") {
                $insert = $this->model->insertarAutor($nom_autor, $ape_autor, "default-avatar.png");
            } else {
                $insert = $this->model->insertarAutor($nom_autor, $ape_autor, $fecha);
                if ($insert) {
                    move_uploaded_file($nombreTemp, $destino);
                }
            }
            header("location: ".base_url()."autor");
            die();
        }

        // ACTUALIZAR DATOS DE UN AUTOR
        public function editar()
        {
            $id_autor = $_GET['id'];
            $data = $this->model->editAutor($id_autor);
            if ($data == 0) {
                $this->autor();
            }else{
                $this->views->getView($this, "editar", $data);
            }
        }
        
        public function modificar()
        {
            $id_autor = $_POST['id_autor'];
            $nom_autor = $_POST['nombres'];
            $ape_autor = $_POST['apellidos'];
            $img = $_FILES['imagen'];
            $imgName = $img['name'];
            $imgTmp = $img['tmp_name'];
            $fecha = md5(date("Y-m-d h:i:s")) . "_" . $imgName;
            $destino = "assets/images/autor/".$fecha;
            $imgAntigua = $_POST['foto'];
            
            if ($imgName == null || $imgName == "")  {
                $actualizar = $this->model->actualizarAutor($id_autor, $nom_autor, $ape_autor, $imgAntigua);
            }else{
                $actualizar = $this->model->actualizarAutor($id_autor,  $nom_autor, $ape_autor, $fecha);
                if ($actualizar) {
                    move_uploaded_file($imgTmp, $destino);
                    if ($imgAntigua != "default-avatar.png") {
                        unlink("assets/images/autor/".$imgAntigua);
                    }
                }
            }
            header("location: ".base_url()."autor");
            die();
        }

        // ELIMINAR UN AUTOR (ELIMINA TAMBIÉN LOS LIBROS/REVISTAS/TESIS EN LOS QUE APARECE)
        public function eliminar(){
            $id_autor = $_POST['id_autor'];
            $this->model->eliminarAutor($id_autor);
            header("location: ".base_url()."autor");
            die();
        }

        // CAMBIAR ESTADO DE UN AUTOR        1-Activo <=> 0 Inactivo
        
        public function darBaja()
        {
            $id_autor = $_POST['id_autor'];
            $this->model->estadoAutor($id_autor, 0);
            header("location: " . base_url() . "autor");
            die();
        }

        public function reingresar()
        {
            $id_autor = $_POST['id_autor'];
            $this->model->estadoAutor($id_autor, 1);
            header("location: ".base_url()."autor");
            die();
        }
}
