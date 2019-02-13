<?php
include_once("Application.php");
$app = new Application();
$app->validarSesion();
//substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'],"/")+1)
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Panel de control", "../css/panel.css")
?>
<body class="mybackground">
<?php
Application::PonerNav($app->getNombreReal($app->getUsuarioLogeado()));
?>
<div id="panel">
    <div class="container">
        <div id="panel-row" class="row justify-content-center align-items-center">
            <div id="panel-column" class="col-9">
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'],"/")+1) === "buscar_aula.php"){
        $nombre_aula = $_POST["nombre_aula"];
        $nmbre_corto = $_POST["nombre_corto_aula"];
        $descripcion = $_POST["descripcion"];

        $result = $app->getAulas($nombre_aula,$nmbre_corto,$descripcion);
        if(!$result){
            echo "<p>Error al conectar al servidor: ".$app->getError()."</p>";
        }else{
            $list= $result->fetchAll();
            if (count($list)==0){
                echo "<p class='text-white'>NO HAY AULAS</p>";
            }else{
                echo "<table class=\"table table-striped table-dark\">";
                echo "<thead>";
                echo "<tr>";
                for ($i = 1; $i<$result->columnCount();$i++){
                    $namecolumn = $result->getColumnMeta($i);
                    echo "<th>".strtoupper($namecolumn['name'])."</th>";
                }
                echo "<th>".strtoupper("reservar")."</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($list as $fila){
                    echo "<tr>";
                    echo "<td>".$fila['nombre_aula']."</td><td>".$fila['nombre_corto']."</td><td>".$fila['ubicacion']."</td><td>".$fila['tic']."</td><td>".$fila['numero_pcs']."</td><td>".$fila['descripcion']."</td><td><a class='btn btn-outline-secondary' href='#'>Reservar</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
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
