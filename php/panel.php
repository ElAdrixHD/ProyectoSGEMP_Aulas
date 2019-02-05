<?php
include_once("Application.php");
$app = new Application();
$app->validarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php
Application::PonerHead("Panel de control", "../css/panel.css")
?>
<body class="mybackground">
<div class="nav-side-menu">
    <div class="brand">BIENVENIDO <?php echo $app->getUsuarioLogeado()?></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a href="#">
                    <i class="fa fa-arrow-up fa-lg"></i> Dashboard
                </a>
            </li>

            <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                <a href="#"><i class="fa fa-gift fa-lg"></i> Anlagenauswahl <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="products">
                <li class="active"><a href="#">RFT-H1</a></li>
                <li><a href="#">RFT-H2</a></li>
                <li><a href="#">BTB-H1</a></li>
                <li><a href="#">BTB-H2</a></li>
            </ul>


            <li data-toggle="collapse" data-target="#service" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> Auswertungen <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="service">
                <li>Trendmonitoring</li>
                <li>Alarmmonitoring</li>
                <li>Audit-Trail</li>
            </ul>


            <li data-toggle="collapse" data-target="#new" class="collapsed">
                <a href="#"><i class="fa fa-car fa-lg"></i> Reporting <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="new">
                <li>Alarmstatistik</li>
                <li>Prozessfähigkeit</li>
            </ul>


            <li>
                <a href="#">
                    <i class="fa fa-user fa-lg"></i> Perfil
                </a>
            </li>


        </ul>
    </div>
</div>
<footer>
    <br/>
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://adrianmmudarra.es"> Adrian Muñoz Mudarra</a>
    </div>
</footer>
</body>
</html>
