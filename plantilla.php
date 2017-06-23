<?php
include_once("carga_ccs_js.php");
include_once('libreria/motor.php');
//$objPlantilla619 = new plantilla();

if (!mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
    header("Location:install.php");
    //echo "<script>window.location('install.php')</script>";
}

include_once('db_handler.php');
$dbHandler = new DBHandler();
//var_dump("sad");die;

$paginas = $dbHandler->query("pagina a join user u on a.id_usuario = u.id ", null, "u.is_superuser = 1");

//var_dump($paginas);
?>
<!DOCTYPE html>
<html lang="es">
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta charset="UTF-8">
            <link rel="stylesheet" href="<?php echo DIR_RAIZ ?>/css/bootstrap.css">
            <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
            <link rel="stylesheet" href="<?php echo DIR_RAIZ ?>/css/app.css">
            <title>Acer+</title>
        </head>
        <body>
            <div id="divPaginaCompleta">
                <!-- <div id="divEncabezado"><a href="./">
                                        <img id="logo" src="images/logo.jpg" class="img-thumbnail"/>
                                        <div id="divSaludo">
                <?php
                if (isset($_SESSION['sess_username'])) {
                    echo "Bienvenido {$_SESSION['sess_username']}";
                }
                ?>
                                        </div>
                                </div> -->
                <nav class="navbar navbar-inverse" style="margin-left: 8px; margin-right: 8px">
                    <div class="navbar-header">
                        <a href="./" class="navbar-brand">Inicio</a>
                        <!-- <a href="./" class="navbar-brand" style="right">Bienvenido <?php echo ''; ?></a> -->
                        <a href="admin_index.php" class="navbar-brand">Administrar</a>
                        <?php foreach ($paginas->datos as $row) { ?>
                            <a class="navbar-brand" href="pagina.php?id=<?php echo $row->id_titulo ?>"><?php echo $row->titulo ?></a>
                        <?php } ?>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (isset($_SESSION['usuario'])) {
                            echo '<a href="logout.php" class="navbar-brand">Salir</a>';
                        } else {
                            ?>
                            <li><a href="registrar.php" class="navbar-brand">Registrarse</a></li>
                            <li><a href="login.php" class="navbar-brand">Iniciar sesi&#243;n</a></li>
                        <?php } ?>
                    </ul>
                </nav>
                <div id="divContenido">

                </div>

                <div id="divPie">
                    <br/>
                </div>
            </div>
        </body>
    </html>
