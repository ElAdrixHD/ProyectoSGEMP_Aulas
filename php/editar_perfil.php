<?php
include_once("Application.php");
$app = new Application();
$app->validarSesion();
$datos_usuario = $app->getDatosUsuario($app->getUsuarioLogeado())->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Editar Perfil", "../css/editar_perfil.css")
?>
<body class="mybackground">
<?php
Application::PonerNav($app->getNombreReal($app->getUsuarioLogeado()));
?>

<div id="editar">
    <div class="container">
        <div id="editar-row" class="row justify-content-center align-items-center">
            <div id="editar-column" class="col-md-6">
                <div id="editar-box" class="col-md-12">
                    <form id="editar-form" action="editar_perfil.php" class="form" method="post">
                        <div class="form-group">
                            <h3 class="text-center text-black">Editar Perfil</h3>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-black">Nombre de usuario:</label><br>
                            <input type="text" name="username" id="username" autofocus="autofocus" placeholder="Nombre de usuario" value="<?php echo $datos_usuario[0]['nombre_usuario']?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="correo" class="text-black">Correo electronico:</label><br>
                            <input type="email" name="correo" id="correo" autofocus="autofocus" placeholder="Correo electronico" value="<?php echo $datos_usuario[0]['email']?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="apellidos" class="text-black">Apellidos:</label><br>
                            <input type="text" name="apellidos" id="apellidos" autofocus="autofocus" placeholder="Apellidos" value="<?php echo $datos_usuario[0]['apellidos']?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="text-black">Nombre:</label><br>
                            <input type="text" name="nombre" id="nombre" autofocus="autofocus" placeholder="Nombre" value="<?php echo $datos_usuario[0]['nombre']?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Cambio de contraseña:</label>
                            <div class="form-inline row">
                                <div class="form-group col-sm-6">
                                    <input type="password" class="form-control" id="password" name="password" placeholder=" Nueva contraseña">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="password" class="form-control" id="passwordconfirmar" name="passwordconfirmar" placeholder="Confirmar contraseña">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fnac" class="text-black">Fecha Nacimiento:</label><br>
                            <input type="date" name="fnac" id="fnac" autofocus="autofocus" value="<?php echo $datos_usuario[0]['fecha_nacimiento']?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-dark" value="Guardar Cambios">
                        </div>
                        <div id="back-link" class="text-right form-group">
                            <a href="panel.php" class="btn btn-outline-dark">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){

        }
        ?>
    </div>
</div>
<?php
Application::PonerFooter();
?>
</body>
</html>
