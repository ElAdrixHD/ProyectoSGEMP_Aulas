<?php
include_once("Application.php");
$app = new Application();
$app->validarSesion();
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
<div id="buscar_aula">
    <div class="container">
        <div id="buscar_aula-row" class="row justify-content-center align-items-center">
            <div id="buscar_aula-column" class="col-md-6">
            <h1 class="text-white text-center">BUSQUEDA DE AULAS</h1>
            <br/>
            <form method="POST" action="panel.php">
                <div class="form-group">
                    <label for="nombre_aula" class="text-white">Nombre del aula:</label>
                    <input name="nombre_aula" class="form-control" type="text" placeholder="Nombre del aula">
                </div>
                <div class="form-group">
                    <label for="nombre_corto_aula" class="text-white">Nombre corto:</label>
                    <input name="nombre_corto_aula" class="form-control" type="text" placeholder="Nombre corto del aula">
                </div>
                <div class="form-group">
                    <label for="descripcion" class="text-white">Descripción:</label>
                    <textarea name="descripcion" class="form-control" type="text" placeholder="Descripción"></textarea>
                </div>
                <input type="submit" value="Buscar aulas" class="btn btn-primary"/>
            </form>
        </div>
        </div>
    </div>
</div>

<div style="height: 50px"></div>
<?php
Application::PonerFooter();
?>
</body>
</html>
