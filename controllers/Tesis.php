<?php

    // CONTROLADOR TESIS
    class Tesis extends Controllers{
        
        // CONSTRUCTOR
        public function __construct()   {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url());
            }
            parent::__construct();
        }

        // LISTAR TESIS REGISTRADAS, MATERIAS, AUTORES
        public function tesis()
        {
            $tesis = $this->model->selectTesis();
            $materias = $this->model->selectMateria();
            $autores = $this->model->selectAutor();
            $data = ['tesis' => $tesis, 'materias' => $materias, 'autores' => $autores];
            $this->views->getView($this, "listar", $data);
        }

        // REGISTRAR UN NUEVO ARTÍCULO DE REVISTA
        public function registrar()
        {
            $titulo = $_POST['titulo'];
            $cantidad = $_POST['cantidad'];
            $autor = $_POST['autor'];
            $anio = $_POST['anio'];
            $materia = $_POST['materia'];
            $paginas = $_POST['paginas'];
            $descripcion = $_POST['descripcion'];
            
            $insert = $this->model->insertarTesis($titulo, $cantidad, $autor, $anio, $materia, $paginas, $descripcion);
            if ($insert) {
                header("location: " . base_url() . "tesis");
                die();
            }
        }
        
        public function editar()
        {
            $id_recurso = $_GET['id'];
            $materias = $this->model->selectMateria();
            $autor = $this->model->selectAutor();
            $tesis = $this->model->editTesis($id_recurso);
            $data = ['materias' => $materias, 'autores' => $autor, 'tesis' => $tesis];
            if ($data == 0) {
                $this->articulos();
            } else {
                $this->views->getView($this, "editar", $data);
            }
        }

        public function modificar()
        {
            $id_recurso = $_POST['id_recurso'];
            $titulo = $_POST['titulo'];
            $cantidad = $_POST['cantidad'];
            $autor = $_POST['autor'];
            $anio = $_POST['anio'];
            $materia = $_POST['materia'];
            $paginas = $_POST['paginas'];
            $descripcion = $_POST['descripcion'];
            
            $actualizar = $this->model->actualizarTesis($id_recurso, $titulo, $cantidad, $autor, $anio, $materia, $paginas, $descripcion);
            if ($actualizar) { 
                header("location: ".base_url()."tesis");
                die();
            }
        }

         // ELIMINAR UN LIBRO 
        public function eliminar()
        {
            $id_recurso = $_POST['id_recurso'];
            $this->model->eliminarTesis($id_recurso);
            header("location: ".base_url()."tesis");
            die();
        }
    
        // CAMBIAR ESTADO DE UN LIBRO        1-Activo <=> 0 Inactivo
        public function darBaja(){
            $id_recurso = $_POST['id_recurso'];
            $this->model->estadoTesis($id_recurso, 0);
            header("location: ".base_url()."tesis");
            die();
        }

        public function reingresar()
        {
            $id_recurso = $_POST['id_recurso'];
            $this->model->estadoTesis($id_recurso, 1);
            header("location: ".base_url()."tesis");
            die();
        }

        // EXPORTAR EN PDF
        public function pdf()
        {
            $tesis = $this->model->selectTesis();
            require_once 'Libraries/pdf/fpdf.php';
            $pdf = new FPDF('P', 'mm', 'letter');
            $pdf->AddPage();
            $pdf->SetMargins(10, 10, 10);
            $pdf->SetTitle("tesis");
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(0, 0, 0);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(196, 5, "Tesis", 1, 1, 'C', 1);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(6, 5, utf8_decode('N°'), 1, 0, 'L');
            $pdf->Cell(130, 5, utf8_decode('Titulo'), 1, 0, 'L');
            $pdf->Cell(50, 5, utf8_decode('Autor'), 1, 0, 'L');
            $pdf->Cell(10, 5, 'Cant.', 1, 1, 'L');
            $pdf->SetFont('Arial', '', 10);
            $contador = 1;
            foreach ($tesis as $row) {
                $pdf->Cell(6, 5, $contador, 1, 0, 'L');
                $pdf->Cell(130, 5, utf8_decode($row['titulo']), 1, 0, 'L');
                $pdf->Cell(50, 5, utf8_decode($row['autor']), 1, 0, 'L');
                $pdf->Cell(10, 5, $row['cant_disponible'], 1, 1, 'L');
                $contador++;
            }
            $pdf->Output("tesis.pdf", "I");
        }
}
