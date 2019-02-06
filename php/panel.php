<?php
include_once("Application.php");
$app = new Application();
$app->validarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Panel de control", "../css/panel.css")
?>
<body class="mybackground">
<?php
Application::PonerNav($app->getNombreReal($app->getUsuarioLogeado()));
?>
<?php
Application::PonerFooter();
?>
</body>
</html>
