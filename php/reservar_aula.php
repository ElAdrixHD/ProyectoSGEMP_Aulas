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
                <br/>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $aula = $_POST["aula"];
                    $fecha = $_POST["fecha"];
                    $horita = $_POST["hora"];
                    $motivo = $_POST["motivo"];
                    if (empty(trim($aula))){
                        echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir un aula</p>
                              </div>";
                    }elseif (empty(trim($fecha))){
                        echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir una fecha</p>
                              </div>";
                    }elseif (empty(trim($horita))){
                        echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir una hora de reserva</p>
                              </div>";
                    }elseif (empty(trim($motivo))){
                        echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>Debes introducir un motivo válido</p>
                              </div>";
                    }elseif ($fecha < date("Y-m-d")){
                        echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>No puedes poner una fecha pasada.</p>
                              </div>";
                    } else{
                        if (!$app->estaConectado()){
                            echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>".$app->getError()."</p>
                                  </div>";
                        }elseif($app->insertarReserva($aula,$fecha,$horita,$motivo,$app->getID($app->getUsuarioLogeado()))){
                            echo "<div class=\"alert alert-success\" role=\"alert\">
                                    <p>Se ha insertado satisfactoriamente.</p>
                                  </div>";
                        }else{
                            echo "<div class=\"alert alert-danger\" role=\"alert\">
                                    <p>".$app->getError()."</p>
                                  </div>";
                        }
                    }
                }
                ?>
                <h1 class="text-white text-center">RESERVA DE AULA</h1>
                <br/>
                <form method="POST" action="reservar_aula.php">
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
                                            $array = array();
                                            foreach ($list as $item){
                                                $array[] = $item['hora_reserva'];
                                            }
                                            for ($j = 1; $j<=6;$j++){
                                                $hora = sprintf("%dº Hora", $j);
                                                if (!in_array($hora,$array)){
                                                    echo "<option value=\"" . $j . "º Hora\">" . $j . "º Hora</option>";
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
                        <label for="motivo" class="text-white">Motivo de la reserva:</label>
                        <textarea name="motivo" class="form-control" type="text" placeholder="Motivo"></textarea>
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