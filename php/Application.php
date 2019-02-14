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
    <link rel='stylesheet' href='../css/nav.css'/>
    <link rel='stylesheet' href='../css/footer.css'/>
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

    public static function PonerFooter()
    {
        echo "<footer>
    <div class=\"footer-copyright text-center py-3\">© 2019 Copyright:
        <a href=\"https://adrianmmudarra.es\"> Adrian Muñoz Mudarra</a>
    </div>
</footer>";
    }

    public static function PonerNav($user)
    {
        echo "<nav>
<div class=\"nav-side-menu\">
    <div class=\"brand\">Bienvenido, ".$user."</div>
    <i class=\"fa fa-bars fa-2x toggle-btn\" data-toggle=\"collapse\" data-target=\"#menu-content\"></i>

    <div class=\"menu-list\">

        <ul id=\"menu-content\" class=\"menu-content collapse out\">
            <li  data-toggle=\"collapse\" data-target=\"#gestion\" class=\"collapsed\">
                <a href=\"#\"><i class=\"fa fa-arrow-up fa-lg\"></i>Gestion de aulas <span class=\"arrow\"></span></a>
            </li>
            <ul class=\"sub-menu collapse\" id=\"gestion\">
                <li onclick=\"window.location='buscar_aula.php';\"><a href='buscar_aula.php'>Busquedas de aulas</a></li>
                <li onclick=\"window.location='reservar_aula.php';\"><a href='reservar_aula.php'>Reservar de aula</a></li>
                <li onclick=\"window.location='#';\"><a href='#'>Consultar reservas de un aula</a></li>
                <li onclick=\"window.location='#';\"><a href='#'>Gestión de reservas</a></li>
            </ul>

            <li data-toggle=\"collapse\" data-target=\"#perfil\" class=\"collapsed\">
                <a href=\"#\"><i class=\"fa fa-user fa-lg\"></i>Perfil<span class=\"arrow\"></span></a>
            </li>
            <ul class=\"sub-menu collapse\" id=\"perfil\">
                <li onclick=\"window.location='editar_perfil.php';\"><a href='editar_perfil.php'>Mis datos</a></li>
                <li onclick=\"window.location='borrarcuenta.php';\"><a href='borrarcuenta.php'>Eliminar mi cuenta</a></li>
            </ul>

            <li onclick=\"window.location='desconectar.php';\">
                <a href=\"desconectar.php\">
                    <i class=\"fa fa-power-off fa-lg\"></i>Desconectar
                </a>
            </li>
        </ul>
    </div>
</div>
</nav>";
    }

    public function getUsuarioLogeado(){
        return strtoupper($this->getUsuarioPorID($_SESSION['username']));
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

    public function getNombreReal($usuario)
    {
        return $this->dao->getNombreReal($usuario)->fetch()['nombre'];
    }

    public function registrarUsuario($user, $pass, $correo, $fnac, $nombre, $apellidos)
    {
        return $this->dao->registrarUsuario($user,$pass,$correo,$fnac,$nombre,$apellidos);
    }

    public function comprobarCorreo($correo)
    {
        return $this->dao->comprobarCorreo($correo);
    }

    public function comprobarUsuario($user)
    {
        return $this->dao->comprobarUsuario($user);
    }

    public function getError()
    {
        return $this->dao->getError();
    }

    public function estaConectado()
    {
        return $this->dao->estaConectado();
    }

    public function validarUsuario($user, $pass)
    {
        return $this->dao->validarUsuario($user,$pass);
    }

    public function borrarCuenta($getUsuarioLogeado)
    {
        return $this->dao->borrarCuenta($getUsuarioLogeado);
    }

    public function getDatosUsuario($user)
    {
        return $this->dao->getDatosUsuario($user);
    }

    public function actualizarDatosConContrasenia($userA,$user, $pass, $apellidos, $nombre, $fnac, $correo)
    {
        return $this->dao->actualizarDatosConContrasenia($userA,$user, $pass, $apellidos, $nombre, $fnac, $correo);
    }

    public function actualizarDatosSinContrasenia($userA,$user, $apellidos, $nombre, $fnac, $correo)
    {
        return $this->dao->actualizarDatosSinContrasenia($userA,$user, $apellidos, $nombre, $fnac, $correo);
    }

    public function getUsuarioPorID($id){
        return $this->dao->getUsuarioPorID($id);
    }

    public function getID($user)
    {
        return $this->dao->getIDdeUsuario($user);
    }

    public function getAulas($nombre_aula, $nmbre_corto, $descripcion)
    {
        return $this->dao->getBuscarAulas($nombre_aula,$nmbre_corto,$descripcion);
    }

    public function getNombreAulaPorID($aula)
    {
        return $this->dao->getNombreAulaPorID($aula);
    }

    public function getNombreAulas()
    {
        return $this->dao->getNombreAulas();
    }
}