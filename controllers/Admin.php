<?php

    // CONTROLADOR ADMINISTRADOR
    class Admin extends Controllers{

        // CONSTRUCTOR
        public function __construct(){
            session_start();            // Inicia una nueva sesión o reanuda la existente
            
            if (empty($_SESSION['activo'])) {
                header("location: ".base_url());
            }
            parent::__construct();      // invoca al constructor de Controllers, el cual carga el modelo y la vista
        }

        // MÉTODO LISTAR
        public function listar(){
            $libros = $this->model->selectRecursos('Libro');
            $tesis = $this->model->selectRecursos('Tesis');
            $articulos = $this->model->selectRecursos('Artículo de Revista');
            $estudiantes = $this->model->selectEstudiantes();
            $solicitudes = $this->model->selectSolicitudes();          
            $prestamos = $this->model->selectPrestamos();

            // Arreglo con propiedades
            $data = ['libros' => $libros, 
                    'tesis' => $tesis,
                    'articulos' => $articulos,
                    'estudiantes' => $estudiantes, 
                    'solicitudes' => $solicitudes, 
                    'prestamos' => $prestamos];
            
            $this->views->getView($this, "listar", $data);  // function getView($controller, $view, $data="", $alert="", $config = "", $cliente = "")
                                                            // carga la vista de Préstamos
        }

        public function registrarPrestamoLibro()
        {
            $libro = $_POST['libro'];
            $estudiante = $_POST['estudiante_libro'];
            $cantidad = $_POST['cantidad'];
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $fecha_lim_dev = $_POST['fecha_lim_dev'];
            $observacion = $_POST['observacion'];
            $cantidadActual = $this->model->selectRecursoCantidad($libro);
            if ($cantidadActual['cant_disponible'] < $cantidad) {
                header("location: " . base_url() . "admin/listar?no_s");
            }else{
                $insert = $this->model->insertarPrestamo($estudiante, $libro, $cantidad, $fecha_prestamo, $fecha_prestamo, $fecha_lim_dev, $observacion);
                $total = ($cantidadActual['cant_disponible'] - $cantidad);
                $this->model->actualizarCantidad($total, $libro);
                if ($insert) {
                    header("location: ".base_url()."admin/listar");
                    die();
                }
            }
            
        }

        public function registrarPrestamoArticulo()
        {
            $articulo = $_POST['articulo'];
            $estudiante = $_POST['estudiante_articulo'];
            $cantidad = $_POST['cantidad'];
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $fecha_lim_dev = $_POST['fecha_lim_dev'];
            $observacion = $_POST['observacion'];
            $cantidadActual = $this->model->selectRecursoCantidad($articulo);
            if ($cantidadActual['cant_disponible'] < $cantidad) {
                header("location: " . base_url() . "admin/listar?no_s");
            }else{
                $insert = $this->model->insertarPrestamo($estudiante, $articulo, $cantidad, $fecha_prestamo, $fecha_prestamo, $fecha_lim_dev, $observacion);
                $total = ($cantidadActual['cant_disponible'] - $cantidad);
                $this->model->actualizarCantidad($total, $articulo);
                if ($insert) {
                    header("location: ".base_url()."admin/listar");
                    die();
                }
            }
            
        }

        public function registrarPrestamoTesis()
        {
            $tesis = $_POST['tesis'];
            $estudiante = $_POST['estudiante_tesis'];
            $cantidad = $_POST['cantidad'];
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $fecha_lim_dev = $_POST['fecha_lim_dev'];
            $observacion = $_POST['observacion'];
            $cantidadActual = $this->model->selectRecursoCantidad($tesis);
            if ($cantidadActual['cant_disponible'] < $cantidad) {
                header("location: " . base_url() . "admin/listar?no_s");
            }else{
                $insert = $this->model->insertarPrestamo($estudiante, $tesis, $cantidad, $fecha_prestamo, $fecha_prestamo, $fecha_lim_dev, $observacion);
                $total = ($cantidadActual['cant_disponible'] - $cantidad);
                $this->model->actualizarCantidad($total, $tesis);
                if ($insert) {
                    header("location: ".base_url()."admin/listar");
                    die();
                }
            }
            
        }

        // DEVOLVER PRÉSTAMO
        public function devolver()
        {
            $id = $_POST['id'];
            $cantidadprestado = $this->model->selectPrestamoCantidad($id);
            $cantidadActual = $this->model->selectRecursoCantidad($cantidadprestado['id_recurso']);
            $total = ($cantidadActual['cant_disponible'] + $cantidadprestado['cantidad']);
            $estado_devuelto = 0;      // Estado de préstamo
            $prest = $this->model->cambiarEstadoPrestamo($id, "", $estado_devuelto , true);
            $actualizado = $this->model->actualizarCantidad($total, $cantidadprestado['id_recurso']);
            if ($actualizado && $prest) {
                header("location: ".base_url()."admin/listar");
                die();
            }
        }

        // EXPORTAR PDF
        public function pdf()
        {
        $datos = $this->model->selectDatos();
        $prestamo = $this->model->selectPrestamoDebe();
        require_once 'libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Prestamos");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 5, utf8_decode($datos['empresa']), 0, 1, 'C');

        $pdf->image(base_url() . "/assets/img/logo.png", 180, 10, 20, 20, 'png');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, $datos['telefono'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['direccion']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, "Correo: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['correo']), 0, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, "Detalle de Prestamos", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Cell(10, 5, utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(40, 5, utf8_decode('Estudiantes'), 1, 0, 'L');
        $pdf->Cell(20, 5, 'Recurso', 1, 0, 'L');
        $pdf->Cell(56, 5, utf8_decode('Título'), 1, 0, 'L');
        $pdf->Cell(12, 5, 'Cant.', 1, 0, 'L');
        $pdf->Cell(28, 5, utf8_decode('Préstamo'), 1, 0, 'L');
        $pdf->Cell(30, 5, utf8_decode('Lím. Devolución'), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($prestamo as $row) {
            $pdf->Cell(10, 5, $contador, 1, 0, 'L');
            $pdf->Cell(40, 5, utf8_decode($row['nom_estudiante']), 1, 0, 'L');
            $pdf->Cell(20, 5, $row['nom_tipo'], 1, 0, 'L');
            $pdf->Cell(56, 5, utf8_decode($row['titulo']), 1, 0, 'L');
            $pdf->Cell(12, 5, $row['cantidad'], 1, 0, 'L');
            $pdf->Cell(28, 5, $row['fecha_prestamo'], 1, 0, 'L');
            $pdf->Cell(30, 5, $row['fecha_lim_dev'], 1, 1, 'L');
            $contador++;
        }
        $pdf->Output("prestamos.pdf", "I");
        }
    
    }
