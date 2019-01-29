<?php
include_once("DataObjectAccess.php");
class Application
{
    private $dao;

    public function __construct()
    {
        $this->dao = new DataObjectAccess();
    }

    public function getDao()
    {
        return $this->dao;
    }

    public function guardarSesion($user){
        $_SESSION['user'] = $user;
    }

    public function validarSesion(){
        session_start();
        if(!$this->estaLogeado()){
            $this->mostrarLogin();
        }
    }

    public function invalidateSession()
    {
        session_start();
        if($this->estaLogeado()){
            unset($_SESSION['user']);
            session_destroy();
        }
        $this->mostrarLogin();
    }

    public function estaLogeado(){
        return isset($_SESSION['user']);
    }

    private function mostrarLogin(){
        header('Location: login.php');
    }
}