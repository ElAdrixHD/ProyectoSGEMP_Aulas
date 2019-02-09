<?php
include_once("Application.php");
session_start();
$app = new Application();
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Registro", "../css/registro.css")
?>
<body  class="mybackground">
<div id="register">
    <div class="container">
        <div id="register-row" class="row justify-content-center align-items-center">
            <div id="register-column" class="col-md-6">
                <div id="register-box" class="col-md-12">
                    <form id="register-form" class="form" action="registro.php" method="post">
                        <div class="form-group">
                            <h3 class="text-center text-black">Registro</h3>
                        </div>
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
                if (empty(trim($user))){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir un nombre de usuario</p>
                              </div>";
                }elseif (empty(trim($pass))){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir una contraseña</p>
                              </div>";
                }elseif ($pass != $passwordconfirmar){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Las contraseñas no son iguales</p>
                              </div>";
                }elseif (empty(trim($nombre))){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir un nombre válido</p>
                              </div>";
                }elseif (empty(trim($apellidos))){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir un apellido válido</p>
                              </div>";
                }elseif (strftime("%Y", strtotime($fnac)) >= 2001 || strftime("%Y", strtotime($fnac)) <= 1930){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes ser mayor de 18 años</p>
                              </div>";
                } else{
                    if (!$app->estaConectado()){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>".$app->getError()."</p>
                                  </div>";
                    }elseif ($app->comprobarUsuario($user)){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>Ya existe ese usuario</p>
                                  </div>";
                    }elseif ($app->comprobarCorreo($correo)){
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>Ya existe ese correo electronico</p>
                                  </div>";
                    }elseif($app->registrarUsuario($user,$pass,$correo,$fnac,$nombre,$apellidos)){
                        echo "<div class=\"alert alert-success\" role=\"alert\">
                                    <p>Se ha registrado satisfactoriamente. Se le redireccionará automaticamente para que pueda iniciar sesión.</p>
                                  </div>";
                        echo "<script language=\"javascript\">setTimeout(function(){window.location.href=\"login.php\"},2500)</script>";
                    }else{
                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>".$app->getError()."</p>
                                  </div>";
                    }
                }
            }
        ?>
    </div>
</div>
<div style="height: 50px"></div>
<?php
Application::PonerFooter();
?>
</body>
</html>