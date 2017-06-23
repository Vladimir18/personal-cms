<?php
include_once('plantilla.php');
error_reporting(0);
session_start();
if ($_SESSION['usuario']) {

    include_once('db_handler.php');
    $dbHandler = new DBHandler();
    $configuracion = $dbHandler->query("configuracion", null, "nombre_opcion='titulo'");


    $articulos = $dbHandler->query("articulo a join user u on a.id_usuario = u.id", null, "", 0, 'order by a.id DESC');

    //Conseguir Configuracion del sistema
    $titulo = "Sistema de Inversion en prueba";
    ?>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $configuracion->datos[0]->valor_opcion ?>
                </h1>

                <?php //array_reverse($articulos->datos) ?>
                <?php foreach ($articulos->datos as $row) { ?>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="articulo.php?id=<?php echo $row->id ?>"><?php echo $row->titulo ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $row->nombre ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Escrito en <?php echo $row->fecha_creacion ?></p>
                    <hr>
                    <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                    <hr>
                    <?php echo $row->contenido ?>
                    <a class="btn btn-primary" href="articulo.php?id=<?php echo $row->id ?>">Leer mas<span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                <?php } ?>

            </div>

            <div class="col-md-4">

                <?php include("plantilla_buscador.php") ?>
                <?php include("plantilla_paginas.php") ?>
                <?php include("plantilla_descripcion.php") ?>

            </div>

        </div>

        <hr>

    </div>

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <style type="text/css">
        div.upload {
            position: relative;
            width: 150px;
            height: 150px;
            overflow:hidden;
            background: transparent url('img/logo.png') center center no-repeat;
            clip:rect(0px, 80px, 24px, 0px );
        }

        div.upload input {
            position: absolute;
            right: 0px;
            top: 0px;
            margin:0;
            padding:0;
            filter: Alpha(Opacity=0);
            -moz-opacity: 0;
            opacity: 0;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
                <!--<h1 style="float:right"><a href="index.php?login=cerrar">Cerrar sesion</a></h1> -->
            </div>
        </div>
        <div class="media">
            <a class="pull-left" href="#">
                <input type="file" name="file" id="logo"/>
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><p><h3 style="float: left">Elije el &#237;cono que tendrá tu sitio web.</h3></p>
                    <small><?php echo $comment->fecha_creacion ?></small>
                </h4>
                <?php echo $comment->comentario; ?>
            </div>
        </div>
        <!--<div class="row" align='center'>
                <div class="col-md-2" style="text-align: center">
                        <div class="upload">

                                <!--<img src="img/logo.png"  height="150" width="150" style="float: left">-->

    <!--					<p><h4 style="float: left"></p>-->
        <!--				</div>-->
        <!--			</div>-->
        <!--		</div>-->-->
        <!--		<h1><a href="admin_entradas.php">Crea tu Sitio Web</a></h1>-->
    </div>
    <?php
    if ($_GET['login'] == 'cerrar') {
        header("Location:logout.php");
    }
} else {
    header("Location:registrar.php");
}
?>

