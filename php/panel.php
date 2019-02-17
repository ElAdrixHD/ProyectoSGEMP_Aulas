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
                    echo "<td>".$fila['nombre_aula']."</td><td>".$fila['nombre_corto']."</td><td>".$fila['ubicacion']."</td><td>".$fila['tic']."</td><td>".$fila['numero_pcs']."</td><td>".$fila['descripcion']."</td><td><a class='btn btn-outline-secondary' href='reservar_aula.php?aula=".$fila['id_aula']."'>Reservar</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        }
    }elseif(substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'],"/")+1) === "busqueda_reserva.php"){
        $aula = $_POST["aula"];
        $fecha = $_POST["fecha"];

        $result = $app->getReservasPorFecha($aula,$fecha);
        if(!$result){
            echo "<p>Error al conectar al servidor: ".$app->getError()."</p>";
        }else{
            $list= $result->fetchAll();
            $array = array();
            foreach ($list as $item){
                $array[] = $item['hora_reserva'];
            }
                echo "<table class=\"table table-striped table-dark\">";
                echo "<thead>";
                echo "<tr>";
                echo "<th>".strtoupper("fecha reserva")."</th>";
                echo "<th>".strtoupper("hora_reserva")."</th>";
                echo "<th>".strtoupper("aula")."</th>";
                echo "<th>".strtoupper("usuario")."</th>";
                echo "<th>".strtoupper("motivo de reserva")."</th>";
                echo "<th>".strtoupper("reservar")."</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $i = 0;
                for ($j = 1; $j<=6;$j++){
                    $hora = sprintf("%dº Hora", $j);
                    if (!in_array($hora,$array)){
                        echo "<tr>";
                        echo "<td>".$fecha."</td><td>".$hora."</td><td>".$app->getNombreAulaPorID($aula)."</td><td></td><td></td><td><a class='btn btn-primary' href='reservar_aula.php?aula=".$aula."&date=".$fecha."'>Reservar</a></td>";
                        echo "</tr>";
                    }else{
                        echo "<tr>";
                        echo "<td>".$list[$i]['fecha_reserva']."</td><td>".$list[$i]['hora_reserva']."</td><td>".$app->getNombreAulaPorID($list[$i]['id_aula'])."</td><td>".$app->getNombreUsuario($list[$i]['id_usuario'])."</td><td>".$list[$i]['descripcion']."</td><td><a  class='btn btn-danger isDisabled' href='#'>Reservar</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                }
                echo "</tbody>";
                echo "</table>";
            }
    }
}elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], "/") + 1) != "index.php" and substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], "/") + 1) != "borrarcuenta.php") {
        $result = $app->getReservas();
        if(!$result){
            echo "<p>Error al conectar al servidor: ".$app->getError()."</p>";
        }else{
            $list= $result->fetchAll();
            if (count($list)==0){
                echo "<p class='text-white'>NO HAY RESERVAS</p>";
            }else{
                echo "<table class=\"table table-striped table-dark\">";
                echo "<thead>";
                echo "<tr>";
                echo "<th>".strtoupper("fecha reserva")."</th>";
                echo "<th>".strtoupper("hora_reserva")."</th>";
                echo "<th>".strtoupper("aula")."</th>";
                echo "<th>".strtoupper("usuario")."</th>";
                echo "<th>".strtoupper("motivo de reserva")."</th>";
                echo "<th>".strtoupper("borrar reserva")."</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($list as $fila){
                    echo "<tr>";
                    echo "<td>".$fila['fecha_reserva']."</td><td>".$fila['hora_reserva']."</td><td>".$app->getNombreAulaPorID($fila['id_aula'])."</td><td>".$app->getUsuarioPorID($fila['id_usuario'])."</td><td>".$fila['descripcion']."</td><td>";
                    if (strtolower($app->getUsuarioPorID($fila['id_usuario'])) == strtolower($app->getUsuarioLogeado())){
                        echo "<a class='btn btn-danger' href='borrar_reserva.php?reserva=".$fila['id_reserva']."'>Borrar Reserva</a>";
                    }else{
                        echo "<a  class='btn btn-danger isDisabled' href='#'>No eres el dueño de la reserva</a>";
                    }
                    echo "</td>";
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
