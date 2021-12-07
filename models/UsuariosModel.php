<?php

    class UsuariosModel extends Mysql{

        // ATRIBUTOS
        public $id, $usuario, $nombres, $apellidos, $dni, $clave, $rol, $estado;
        
        // CONSTRUCTOR
        public function __construct(){
            parent::__construct();
        }

        // CONSULTAS A LA BASE DE DATOS
        public function selectUsuarios()
        {
            $sql = "SELECT * FROM usuarios";
            $res = $this->select_all($sql);
            return $res;
        }

        public function selectUsuario(string $usuario, string $clave)
        {
            $this->usuario = $usuario;
            $this->clave = $clave;
            $sql = "SELECT * FROM usuarios WHERE usuario = '{$this->usuario}' AND clave = '{$this->clave}' AND estado = 1";
            $res = $this->select($sql);
            return $res;
        }

        public function selectUsuariosPass(int $id)
        {
            $sql = "SELECT * FROM usuarios WHERE id_user = $id";
            $res = $this->select($sql);
            return $res;
        }

        // INSERTAR NUEVO USUARIO
        public function insertarUsuarios(string $usuario, string $nombres, string $apellidos, string $dni, string $clave, int $rol)
        {
            $return = "";
            $this->usuario = $usuario;
            $this->nombres = $nombres;
            $this->apellidos = $apellidos;
            $this->dni = $dni;
            $this->clave = $clave;
            $this->rol = $rol;
            $query = "INSERT INTO usuarios(usuario, nombres, apellidos, dni, clave, rol) VALUES (?,?,?,?,?,?)";
            $data = array($this->usuario, $this->nombres, $this->apellidos, $this->dni, $this->clave, $this->rol);
            $resul = $this->insert($query, $data);
            $return = $resul;
            return $return;
        }

        // EDITAR USUARIOS
        public function editarUsuarios(int $id)
        {
            $sql = "SELECT * FROM usuarios WHERE id_user = $id";
            $res = $this->select($sql);
            if (empty($res)) {              // valida que el usuario exista
                $res = 0;
            }
            return $res;
        }

        public function actualizarUsuarios(int $id, string $usuario, string $nombres, string $apellidos, string $dni, int $rol)
        {
            $return = "";
            $this->id = $id;
            $this->usuario = $usuario;
            $this->nombres = $nombres;
            $this->apellidos = $apellidos;
            $this->dni = $dni;
            $this->rol = $rol;
            $query = "UPDATE usuarios SET usuario=?, nombres=?, apellidos=?, dni=?, rol=? WHERE id_user=?";
            $data = array($this->usuario, $this->nombres, $this->apellidos, $this->dni, $this->rol, $this->id);
            $resul = $this->update($query, $data);
            $return = $resul;
            return $return;
        }

        // ELIMINAR UN USUARIO
        public function eliminarUsuario(int $id)
        {
            $return = "";
            $this->id = $id;
            $query = "DELETE FROM usuarios WHERE id_user=?";
            $data = array($this->id);
            $resul = $this->delete($query, $data);
            $return = $resul;
            return $return;
        }

        public function darBajaUsuario(int $id)
        {
            $return = "";
            $this->id = $id;
            $query = "UPDATE usuarios SET estado = 0 WHERE id_user=?";
            $data = array($this->id);
            $resul = $this->update($query, $data);
            $return = $resul;
            return $return;
        }
        
        // REINGRESAR USUARIO DADO DE BAJA
        public function reingresarUsuario(int $id)
        {
            $return = "";
            $this->id = $id;
            $query = "UPDATE usuarios SET estado = 1 WHERE id_user=?";
            $data = array($this->id);
            $resul = $this->update($query, $data);
            $return = $resul;
            return $return;
        }

        // MÉTODOS PARA CAMBIAR CONTRASEÑA

        // CON EL ID
        public function cambiarPass(string $clave, int $id)
        {
            $this->clave = $clave;
            // Validar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE clave = '$clave' AND id_user = $id";
            $resul = $this->select($query);
            return $resul;
        }

        public function cambiarContra(string $clave, int $id)
        {
            $this->clave = $clave;
            $this->id = $id;
            // Restablecer la constraseña
            $query = "UPDATE usuarios SET clave = ? WHERE id_user = ?";
            $data = array($this->clave, $this->id);
            $resul = $this->update($query, $data);
            return $resul;
        }
        
        // CON EL DNI
        public function cambiarPassDni(string $clave, String $dni)
        {
            $this->clave = $clave;
            // Validar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE clave = '$clave' AND dni = $dni";
            $resul = $this->select($query);
            return $resul;
        }

        public function cambiarContraDni(string $clave, String $dni)
        {
            $this->clave = $clave;
            $this->dni = $dni;
                        // Restablecer la constraseña
            $query = "UPDATE usuarios SET clave = ? WHERE dni = ?";
            $data = array($this->clave, $this->dni);
            $resul = $this->update($query, $data);
            return $resul;
        }
    }
?>