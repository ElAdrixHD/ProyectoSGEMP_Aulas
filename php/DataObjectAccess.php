<?php
define("DATABASE", "gestion_aulas");
define("DSN", "mysql:host=localhost;dbname=".DATABASE);
define("USER", "www-data");
define("PASSWORD", "123");
define("TABLA_USUARIO", "usuario");
define("COLUMNA_USUARIO", "nombre_usuario");
define("COLUMNA_CONTRASENIA", "contrasenia");
define("COLUMNA_CORREO","email");
class DataObjectAccess
{
    private $conexion;
    private $error;

    function __construct()
    {
        try{
            $this->conexion = new PDO(DSN,USER,PASSWORD);
        }catch (PDOException $e){
            $this->error= "Error en la conexion a la base de datos: ".$e->getMessage();
        }
    }

    function estaConectado(){
        return isset($this->conexion);
    }

    function getError(){
        return $this->error;
    }

    public function validarUsuario($user, $pass)
    {
        $sql = "SELECT nombre_usuario FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$user."' AND ".COLUMNA_CONTRASENIA." = sha1('".$pass."')";
        $consulta = $this->conexion->query($sql);
        if ($consulta->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function comprobarUsuario($user){
        $sql = "SELECT nombre_usuario FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$user."'";
        $consulta = $this->conexion->query($sql);
        if ($consulta->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function comprobarCorreo($correo){
        $sql = "SELECT nombre_usuario FROM ".TABLA_USUARIO." WHERE ".COLUMNA_CORREO." = '".$correo."'";
        $consulta = $this->conexion->query($sql);
        if ($consulta->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function registrarUsuario($user, $pass, $correo, $fnac, $nombre, $apellidos)
    {
        $sql = "INSERT INTO ".TABLA_USUARIO." (nombre_usuario, contrasenia, apellidos, nombre, fecha_nacimiento, email) VALUES ('".$user."',sha1('".$pass."'),'".$apellidos."','".$nombre."','".$fnac."','".$correo."')";
        if ($this->conexion->exec($sql) === false){
            $this->error = "Imposible registrar usuario";
            return false;
        }else{
            return true;
        }
    }

    public function getNombreReal($usuario)
    {
        $sql = "SELECT nombre FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$usuario."'";
        $consulta = $this->conexion->query($sql);
        return $consulta;
    }

    public function borrarCuenta($getUsuarioLogeado)
    {
        $sql = "DELETE FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$getUsuarioLogeado."'";
        if ($this->conexion->exec($sql) === true){
            return true;
        }else{
            $this->error = "Imposible borrar usuario";
            echo $this->error;
            return false;
        }
    }

    public function getDatosUsuario($user)
    {
        try{
            $sql = "SELECT nombre_usuario, nombre, apellidos, fecha_nacimiento, email FROM usuario WHERE nombre_usuario = '".$user."'";
            $result = $this->conexion->query($sql);
            return $result;
        }catch (PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }

    }
}