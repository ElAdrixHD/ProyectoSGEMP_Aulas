<?php
include_once("Application.php");
$app = new Application();
$app->validarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Borrar Reserva", "../css/borrarcuenta.css")
?>
<body class="mybackground">
<?php
Application::PonerNav($app->getNombreReal($app->getUsuarioLogeado()));
if (!isset($_GET['reserva'])){
    echo "<script language=\"javascript\">window.location.href=\"panel.php\"</script>";
}
?>
<div id="borrar">
    <div class="container">
        <div id="borrar-row" class="row justify-content-center align-items-center">
            <div id="borrar-column" class="col-md-6">
                <div id="borrar-box" class="col-md-12">
                    <form id="borrar-form" action="borrar_reserva.php" class="form" method="post">
                        <div class="form-group">
                            <label for="submit" class="control-label">¿Estás seguro que quieres borrar esta reserva?</label>
                            <div class="form-inline row">
                                <div class="form-group col-sm-9">
                                    <input type="hidden" name="reserva" value="<?php echo $_GET['reserva']?>">
                                    <input type="submit" name="submit" class="btn btn-danger" value="Si">
                                </div>
                                <div class="form-group col-sm-1">
                                    <div id="back-link" class="text-right form-group">
                                        <a href="panel.php" class="btn btn-outline-dark">No</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if (isset($_POST['reserva'])){
                        if(!$app->borrarReserva($_POST['reserva'])){
                            echo "<div class=\"alert alert-warning\" role=\"alert\">
                                <p>".$app->getError()."</p>
                              </div>";
                        }else{
                            echo "<script language=\"javascript\">window.location.href=\"panel.php\"</script>";

                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
Application::PonerFooter();
?>
</body>
</html>