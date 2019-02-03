<?php
define("DATABASE", "gestion_aulas");
define("DSN", "mysql:host=localhost;dbname=".DATABASE);
define("USER", "www-data");
define("PASSWORD", "123");
define("TABLA_USUARIO", "usuario");
define("COLUMNA_USUARIO", "nombre_usuario");
define("COLUMNA_CONTRASENIA", "contrasenia");
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
}