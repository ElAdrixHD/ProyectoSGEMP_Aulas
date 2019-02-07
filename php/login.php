<?php
include_once("Application.php");
session_start();
$app = new Application();
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Inicio Sesion", "../css/login.css")
?>
<body  class="mybackground">
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" action="login.php" class="form" method="post">
                        <div class="form-group">
                            <h3 class="text-center text-black">Inicio Sesión</h3>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-black">Usuario:</label><br>
                            <input type="text" name="username" autofocus="autofocus" required="required" placeholder="Usuario" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-black">Contraseña:</label><br>
                            <input type="password" name="password" autofocus="autofocus" required="required" placeholder="Contraseña" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-dark" value="Iniciar Sesión">
                        </div>
                        <div id="register-link" class="text-right form-group">
                            <br/>
                            <a href="registro.php" class="btn btn-outline-dark">Registrarse</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br/>
        <?php
        if($app->estaLogeado()){
            echo "<script language=\"javascript\">window.location.href=\"panel.php\"</script>";
        }else{
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $user = $_POST["username"];
                $pass = $_POST["password"];
                if (empty($user)){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir un nombre de usuario</p>
                              </div>";
                }elseif (empty($pass)){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir una contraseña</p>
                              </div>";
                }else{
                    if (!$app->estaConectado()){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>".$app->getError()."</p>
                                  </div>";
                    }elseif ($app->validarUsuario($user,$pass)){
                        $app->guardarSesion($user);
                        echo "<script language=\"javascript\">window.location.href=\"panel.php\"</script>";
                    }else{
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>El nombre usuario o la contraseña es incorrecta</p>
                                  </div>";
                    }
                }
            }
        }
        ?>
    </div>
</div>
<?php
Application::PonerFooter();
?>
</body>
</html>