<?php
class Controllers{      // CLASE PADRE DE LOS CONTROLADORES

    // CONSTRUCTOR
    public function __construct() {
        $this->views = new Views();
        $this->loadModel();
    }

    // MÉTODO PARA CARGAR MODELO
    public function loadModel(){
        $model = get_class($this)."Model";      // Ej. AdminModel, AutorModel
        $routClass = "models/".$model.".php";
        if (file_exists($routClass)) {
            require_once($routClass);
            $this->model = new $model();
        }
    }
}
?>