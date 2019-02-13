<?php
include_once("Application.php");
session_start();
$app = new Application();
?>
    <!DOCTYPE html>
    <html lang="es">
<?php
Application::PonerHead("Buscar Aulas", "../css/buscar_aula.css")
?>
    <body  class="mybackground">
<?php
Application::PonerNav($app->getNombreReal($app->getUsuarioLogeado()));
?>