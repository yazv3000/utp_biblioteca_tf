<?php
class Mysql extends Conexion{

    // ATRIBUTOS
    private $conexion;
    private $strquery;
    private $arrvalues;
    private $id;

    // CONSTRUCTOR
    function __construct(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }

    // CONSULTA DE UN REGISTRO
    public function select(string $query){
        $this->strquery = $query;                           
        $result = $this->conexion->prepare($this->strquery);    // Prepara la sentencia para su ejecución y devuelve un objeto sentencia
        $result->execute();                                     // Ejecuta la sentencia preparada
        $data = $result->fetch(PDO::FETCH_ASSOC);              // PDOStatement::fetch Obtiene la siguiente fila de un conjunto de resultados
        return $data;                                           
    }

    // CONSULTA DE VARIOS REGISTROS
    public function select_all(string $query){
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();                                      // PDOStatement::fetchAll — Devuelve un array que contiene todas las filas del conjunto de resultados
        $data = $result->fetchall(PDO::FETCH_ASSOC);             // PDO::FETCH_ASSOC: devuelve un array indexado por los nombres de las columnas del conjunto de resultados.
        return $data;
    }

    // OPERACIONES DE INSERCIÓN
    public function insert(string $query, array $arrvalues){
        $this->strquery = $query;
        $this->arrvalues = $arrvalues;
        
        $insert = $this->conexion->prepare($this->strquery);    
        $res = $insert->execute($this->arrvalues);              
        
        if ($res) {
            $lastInsert = $this->conexion->lastInsertId();      // Devuelve el ID de la última fila o secuencia insertada
        }else{
            $lastInsert = 0;
        }
        return $lastInsert;
    }

    // OPERACIONES DE ACTUALIZACIÓN
    public function update(string $query, array $arrvalues){
        $this->strquery = $query;
        $this->arrvalues = $arrvalues;
        $update = $this->conexion->prepare($this->strquery);
        $res = $update->execute($this->arrvalues);
        return $res;
    }

    // OPERACIONES DE BORRADO
    public function delete(string $query, array $arrvalues){
        $this->strquery = $query;
        $this->arrvalues = $arrvalues;
        $delete = $this->conexion->prepare($this->strquery);
        print_r($delete);
        $result = $delete->execute($this->arrvalues);
        return $result;
    }
}
?>