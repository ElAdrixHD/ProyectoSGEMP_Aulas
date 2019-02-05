<?php
include_once("DataObjectAccess.php");
class Application
{
    public static function PonerHead($titulo, $cssPersonalizado = "#"){
        echo "<head>
    <title>".$titulo."</title>
    <meta charset=\"UTF - 8\">
    <meta name=\"title\" content=\"".$titulo."\">
    <meta name=\"description\" content=\"".$titulo."\">
    <link rel=\"stylesheet\" href=\"../css/bootstrap.css\"/>
    <link rel=\"stylesheet\" href=\"".$cssPersonalizado."\"/>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script type='text/javascript' src='../js/bootstrap.js'></script>
    <link href=\"//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css\" rel=\"stylesheet\">
</head>";
    }
    private $dao;

    public function __construct()
    {
        $this->dao = new DataObjectAccess();
    }

    public function getDao()
    {
        return $this->dao;
    }

    public function getUsuarioLogeado(){
        return strtoupper($_SESSION['username']);
    }

    public function guardarSesion($user){
        $_SESSION['username'] = $user;
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
            unset($_SESSION['username']);
            session_destroy();
        }
        $this->mostrarLogin();
    }

    public function estaLogeado(){
        return isset($_SESSION['username']);
    }

    private function mostrarLogin(){
        header('Location: login.php');
    }
}