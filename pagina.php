<?php
include_once('plantilla.php');
include_once('libreria/cls_manejador.php');
include_once('db_handler.php');
$dbHandler = new DBHandler();
$pagina = new pagina();
$configuracion = $dbHandler->query("configuracion", null, "nombre_opcion='Titulo'");

if (!empty($_GET['id'])) {
    $pagina->id = $_GET['id'];
}
$pagina = $dbHandler->query("pagina a join user u on a.id_usuario = u.id", null, "a.id_titulo = ".$_GET['id']);

//var_dump($pagina);die;
//
//Conseguir Configuracion del sistema
    $titulo = "Sistema de Inversion en prueba";
?>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/blog-home.css" rel="stylesheet">

    <!-- Page Content -->
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php

            $row = $pagina->datos[0]?>
            <!-- Title -->
            <h1><?php echo $row->titulo?></h1>


            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $row->fecha_creacion ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="http://placehold.it/900x300" alt="">

            <hr>


            <?php
                echo $row->contenido;
            ?>
            <hr>

            <hr>

    </div>

        <div class="col-md-4">

            <!-- Blog Search Well -->
            <?php include("plantilla_buscador.php") ?>
            <?php include("plantilla_paginas.php") ?>
            <?php include("plantilla_descripcion.php") ?>

        </div>

        <hr>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
