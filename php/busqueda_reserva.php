<?php
include_once("Application.php");
$app = new Application();
$app->validarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Buscar Reservas", "../css/buscar_reservas.css")
?>
<body  class="mybackground">
<?php
Application::PonerNav($app->getNombreReal($app->getUsuarioLogeado()));
?>
<div id="buscar_reserva">
    <div class="container">
        <div id="buscar_reserva-row" class="row justify-content-center align-items-center">
            <div id="buscar_reserva-column" class="col-md-6">
                <h1 class="text-white text-center">BUSQUEDA DE RESERVAS</h1>
                <br/>
                <form method="POST" action="panel.php">
                    <div class="form-group">
                        <label for="aula" class="text-white">Nombre del aula:</label>
                        <select name="aula" class="form-control" required>
                            <option selected disabled>Seleccione una opcion</option>
                            <?php
                                $aulas = $app->getNombreAulas()->fetchAll();
                            foreach ($aulas as $fila) {
                                echo "<option value=" . $fila['id_aula'] . ">" . $fila['nombre_aula'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="text-white">Fecha de la reserva:</label>
                        <input name="fecha" class="form-control" type="date" required/>
                    </div>
                    <input type="submit" value="Buscar reservas" class="btn btn-primary"/>
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
