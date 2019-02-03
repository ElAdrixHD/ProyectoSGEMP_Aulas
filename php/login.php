<?php
include_once("Application.php");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión</title>
    <meta charset=\"UTF-8\">
    <meta name="title" content="Iniciar Sesión">
    <meta name="description" content="Iniciar Sesión">
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/login.css"/>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script type='text/javascript' src='../js/bootstrap.js'></script>
</head>
<body>
<div id="login">
    <h1 class="text-center text-white pt-5">GESTION DE AULAS</h1>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="#" method="post">
                        <h3 class="text-center text-info">Inicio Sesión</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Usuario:</label><br>
                            <input type="text" name="username" id="username" autofocus="autofocus" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Contraseña:</label><br>
                            <input type="password" name="password" id="password" autofocus="autofocus" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-dark" value="Iniciar Sesión">
                        </div>
                        <div id="register-link" class="text-right">
                            <br/>
                            <a href="#" class="btn text-info">Registrarse</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <br/>
        <?php
        $app = new Application();
        if($app->estaLogeado()){
            echo "<script language=\"javascript\">window.location.href=\"#\"</script>";
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
                    if (!$app->getDao()->estaConectado()){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>".$app->getDao()->getError()."</p>
                                  </div>";
                    }elseif ($app->getDao()->validarUsuario($user,$pass)){
                        $app->guardarSesion($user);
                        echo "<script language=\"javascript\">window.location.href=\"#\"</script>";
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
</body>
</html>