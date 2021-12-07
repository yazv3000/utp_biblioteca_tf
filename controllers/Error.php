<?php
    class Errors extends Controllers{

        // CONSTRUCTOR
        public function __construct(){
            parent::__construct();      // invoca al constructor de la clase padre Controllers
        }

        public function notFound() {
            $this->views->getView($this, "error");
        }
    }
    
    $notFound = new Errors();
    $notFound ->notFound();

?>
    
