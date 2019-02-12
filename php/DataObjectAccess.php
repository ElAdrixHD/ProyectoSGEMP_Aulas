<?php
define("DATABASE", "gestion_aulas");
define("DSN", "mysql:host=localhost;dbname=".DATABASE);
define("USER", "www-data");
define("PASSWORD", "123");
define("TABLA_USUARIO", "usuario");
define("TABLA_AULA","aula");
define("COLUMNA_USUARIO", "nombre_usuario");
define("COLUMNA_CONTRASENIA", "contrasenia");
define("COLUMNA_FECHA", "fecha_nacimiento");
define("COLUMNA_NOMBRE", "nombre");
define("COLUMNA_ID","id");
define("COLUMNA_APELLIDOS", "apellidos");
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
        $sql = "SELECT ".COLUMNA_USUARIO." FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$user."' AND ".COLUMNA_CONTRASENIA." = sha1('".$pass."')";
        $consulta = $this->conexion->query($sql);
        if ($consulta->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function comprobarUsuario($user){
        $sql = "SELECT ".COLUMNA_USUARIO." FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$user."'";
        $consulta = $this->conexion->query($sql);
        if ($consulta->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function comprobarCorreo($correo){
        $sql = "SELECT ".COLUMNA_USUARIO." FROM ".TABLA_USUARIO." WHERE ".COLUMNA_CORREO." = '".$correo."'";
        $consulta = $this->conexion->query($sql);
        if ($consulta->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function registrarUsuario($user, $pass, $correo, $fnac, $nombre, $apellidos)
    {
        $sql = "INSERT INTO ".TABLA_USUARIO." (".COLUMNA_USUARIO.", ".COLUMNA_CONTRASENIA.", ".COLUMNA_APELLIDOS.", ".COLUMNA_NOMBRE.", ".COLUMNA_FECHA.", ".COLUMNA_CORREO.") VALUES ('".$user."',sha1('".$pass."'),'".$apellidos."','".$nombre."','".$fnac."','".$correo."')";
        if ($this->conexion->exec($sql) === false){
            $this->error = "Imposible registrar usuario";
            return false;
        }else{
            return true;
        }
    }

    public function getNombreReal($usuario)
    {
        $sql = "SELECT ".COLUMNA_NOMBRE." FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$usuario."'";
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
            return false;
        }
    }

    public function getDatosUsuario($user)
    {
        try{
            $sql = "SELECT ".COLUMNA_USUARIO.", ".COLUMNA_NOMBRE.", ".COLUMNA_APELLIDOS.", ".COLUMNA_FECHA.", ".COLUMNA_CORREO." FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$user."'";
            $result = $this->conexion->query($sql);
            return $result;
        }catch (PDOException $e){
            $this->error = $e->getMessage();
        }

    }

    public function getIDdeUsuario($usuario){
        $sql = "SELECT ".COLUMNA_ID." FROM ".TABLA_USUARIO." WHERE ".COLUMNA_USUARIO." = '".$usuario."'";
        $consulta = $this->conexion->query($sql);
        return $consulta->fetch()["id"];
    }

    public function actualizarDatosConContrasenia($userA,$user, $pass, $apellidos, $nombre, $fnac, $correo)
    {
        $id = $this->getIDdeUsuario($userA);
        $sql = "UPDATE ".TABLA_USUARIO." SET ".COLUMNA_USUARIO." = '".$user."', ".COLUMNA_CONTRASENIA." = sha1('".$pass."'), ".COLUMNA_APELLIDOS." = '".$apellidos."', ".COLUMNA_NOMBRE." = '".$nombre."', ".COLUMNA_FECHA." = '".$fnac."', ".COLUMNA_CORREO." = '".$correo."' WHERE ".COLUMNA_ID." = ".$id."";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        if ($consulta->rowCount()){
            return true;
        }else{
            $this->error = "Imposible actualizar usuario";
            return false;
        }
    }

    public function actualizarDatosSinContrasenia($userA,$user, $apellidos, $nombre, $fnac, $correo)
    {
        $id = $this->getIDdeUsuario($userA);
        $sql = "UPDATE ".TABLA_USUARIO." SET ".COLUMNA_USUARIO." = '".$user."', ".COLUMNA_APELLIDOS." = '".$apellidos."', ".COLUMNA_NOMBRE." = '".$nombre."', ".COLUMNA_FECHA." = '".$fnac."', ".COLUMNA_CORREO." = '".$correo."' WHERE ".COLUMNA_ID." = ".$id."";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        if ($consulta->rowCount()){
            return true;
        }else{
            $this->error = "Imposible actualizar usuario";
            return false;
        }
    }

    public function getUsuarioPorID($id)
    {
        $sql = "SELECT ".COLUMNA_USUARIO." FROM ".TABLA_USUARIO." WHERE ".COLUMNA_ID." = ".$id."";
        $result = $this->conexion->query($sql);
        return $result->fetch()['nombre_usuario'];
    }

    public function getAulas($nombre_aula, $nmbre_corto, $descripcion)
    {
        $sql = "SELECT * FROM ".TABLA_AULA." WHERE nombre_aula rlike '".$nombre_aula."'";
        $result = $this->conexion->query($sql);
        return $result;
    }
}