<?php
include_once("Application.php");
session_start();
$app = new Application();
$app->validarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Reservar Aula", "../css/reservar_aula.css")
?>
    <body  class="mybackground">
<?php
Application::PonerNav($app->getNombreReal($app->getUsuarioLogeado()));
?>
<div id="reservar_aula">
    <div class="container">
        <div id="reservar_aula-row" class="row justify-content-center align-items-center">
            <div id="reservar_aula-column" class="col-md-6">
                <h1 class="text-white text-center">RESERVA DE AULA</h1>
                <br/>
                <form method="POST" action="panel.php">
                    <div class="form-group">
                        <label for="aula" class="text-white">Selecciona un aula:</label>
                        <?php
                        if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['aula'])){
                            echo "<select name=\"aula\" class=\"form-control\" disabled>
                                    <option>".$app->getNombreAulaPorID($_GET['aula'])."</option>
                                  </select>";
                        }else{
                            ?>
                            <select name="aula" class="form-control">
                                <option value=""></option>
                                <?php
                                $result = $app->getNombreAulas()->fetchAll();
                                foreach ($result as $fila){
                                echo "<option value=".$fila['id_aula'].">".$fila['nombre_aula']."</option>";
                                }
                                ?>
                            </select>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="nombre_corto_aula" class="text-white">Nombre corto:</label>
                        <input name="nombre_corto_aula" class="form-control" type="text" placeholder="Nombre corto del aula">
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="text-white">Descripción:</label>
                        <textarea name="descripcion" class="form-control" type="text" placeholder="Descripción"></textarea>
                    </div>
                    <input type="submit" value="Reservar aula" class="btn btn-primary"/>
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