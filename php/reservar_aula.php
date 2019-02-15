<?php
include_once("Application.php");
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
                        <select name="aula" class="form-control"required onchange="if (this.value) window.location.href='reservar_aula.php?aula='+this.value">
                            <?php
                            if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['aula'])){
                                echo "<option disabled>Seleccione un aula</option>";
                                $result = $app->getNombreAulas()->fetchAll();
                                foreach ($result as $fila) {
                                    if ($fila['id_aula'] === $_GET['aula']){
                                        $selected = "selected=\"true\"";
                                    }else{
                                        $selected = "";
                                    }
                                    echo "<option ".$selected." value=" . $fila['id_aula'] . ">" . $fila['nombre_aula'] . "</option>";
                                }
                            }else{
                                echo "<option selected disabled>Seleccione un aula</option>";
                                $result = $app->getNombreAulas()->fetchAll();
                                foreach ($result as $fila) {
                                    echo "<option value=" . $fila['id_aula'] . ">" . $fila['nombre_aula'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="control-label text-white">Fecha y hora:</label>
                        <div class="form-inline row">
                            <div class="form-group col-sm-6">
                                <input type="date" class="form-control" <?php
                                if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['date'])){
                                    echo "value=\"".$_GET['date']."\"";
                                }
                                ?> onchange="handler(<?php echo $_GET['aula']?>,event)" id="fecha" name="fecha" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <select name="hora" class="form-control" required>
                                    <?php
                                    if(isset($_GET['date']) && isset($_GET['aula'])) {
                                        $horas = $app->getHoras($_GET['aula'],$_GET['date']);
                                        if ($horas->rowCount() == 0){
                                            for ($i = 1; $i <= 6; $i++) {
                                                    echo "<option value=\"" . $i . "º Hora\">".$i."º Hora</option>";
                                            }
                                        }else{
                                            $list = $horas->fetchAll();
                                            for ($i = 1;$i<=6;$i++){
                                                foreach ($list as $item){
                                                    $hora = $i."º Hora";
                                                    if ($hora !== $item['hora_reserva']) {
                                                        echo "<option value=\"" . $i . "º Hora\">" . $i . "º Hora</option>";
                                                    }
                                                }
                                            }

                                        }

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
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