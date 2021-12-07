<?php
    class ConfiguracionModel extends Mysql{

        // ATRIBUTOS
        protected $id, $nombre, $telefono, $direccion;
        
        // CONSTRUCTOR
        public function __construct() {
            parent::__construct();
        }

        // MÉTODOS
        public function selectConfiguracion()
        {
            $sql = "SELECT * FROM configuracion";
            $res = $this->select($sql);
            return $res;
        }

        public function actualizarConfiguracion(int $id_config, string $empresa, string $telefono, string $direccion)
        {
            $return = "";
            $this->id = $id_config;
            $this->empresa = $empresa;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $query = "UPDATE configuracion SET empresa=?, telefono=?, direccion=? WHERE id_config=?";
            $data = array($this->empresa, $this->telefono, $this->direccion ,$this->id);
            $resul = $this->update($query, $data);
            $return = $resul;
            return $return;
        }
    }
?>