<?php
include_once("Application.php");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión</title>
    <meta charset=\"UTF-8\">
    <meta name="title" content="Registrarse">
    <meta name="description" content="Registro">
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/registro.css"/>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script type='text/javascript' src='../js/bootstrap.js'></script>
</head>
<body  class="mybackground">
<div id="login">
    <h1 class="text-center text-black pt-5">GESTIÓN DE AULAS</h1>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="#" method="post">
                        <h3 class="text-center text-black">Registro</h3>
                        <div class="form-group">
                            <label for="username" class="text-black">Nombre de usuario:</label><br>
                            <input type="text" name="username" id="username" autofocus="autofocus" required="required" placeholder="Nombre de usuario" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="correo" class="text-black">Correo electronico:</label><br>
                            <input type="email" name="correo" id="correo" autofocus="autofocus" required="required" placeholder="Correo electronico" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="apellidos" class="text-black">Apellidos:</label><br>
                            <input type="text" name="apellidos" id="apellidos" autofocus="autofocus" placeholder="Apellidos" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="text-black">Nombre:</label><br>
                            <input type="text" name="nombre" id="nombre" autofocus="autofocus" placeholder="Nombre" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Contraseña:</label>
                            <div class="form-inline row">
                                <div class="form-group col-sm-6">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="password" class="form-control" id="passwordconfirmar" name="passwordconfirmar" placeholder="Confirmar contraseña" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fnac" class="text-black">Fecha Nacimiento:</label><br>
                            <input type="date" name="fnac" id="fnac" autofocus="autofocus" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-dark" value="Registrarse">
                        </div>
                        <div id="back-link" class="text-right form-group">
                            <a href="login.php" class="btn btn-outline-dark">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <br/>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $user = $_POST["username"];
                $pass = $_POST["password"];
                $passwordconfirmar = $_POST["passwordconfirmar"];
                $apellidos = $_POST["apellidos"];
                $nombre = $_POST["nombre"];
                $fnac = $_POST["fnac"];
                $correo = $_POST["correo"];
                if (empty($user)){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir un nombre de usuario</p>
                              </div>";
                }elseif (empty($pass)){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir una contraseña</p>
                              </div>";
                }elseif ($pass != $passwordconfirmar){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Las contraseñas son son iguales</p>
                              </div>";
                }
                elseif (strftime("%Y", strtotime($fnac)) >= 2001 || strftime("%Y", strtotime($fnac)) <= 1930){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes ser mayor de 18 años</p>
                              </div>";
                } else{
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
        ?>
    </div>
</div>
</body>
</html>