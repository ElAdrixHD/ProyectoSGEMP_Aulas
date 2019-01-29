<?php
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
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Inicio Sesión</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Usuario:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Contraseña:</label><br>
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="text-info"><span>Recuérdame</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Iniciar Sesión">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="#" class="text-info">Registrarse</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>