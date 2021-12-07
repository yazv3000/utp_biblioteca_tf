<?php
class Conexion{

    private $conect;

    // CONSTRUCTOR
    public function __construct() {
      $conexion = "mysql:host=".HOST.";dbname=".BD.";.CHARSET.";  
      
      try {
         $this->conect = new PDO($conexion, DB_USER, PASS);
         $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } 
      catch (PDOException $e) {
         $this->conect = "Error en la conexion";
         echo "Error: " . $e->getMessage();
      }
    }

    // MÉTODO PARA DEVOLVER LA CONEXIÓN
    public function conect() {
        return $this->conect;
    }
}

?>