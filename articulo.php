<?php
include_once('plantilla.php');
include_once('libreria/cls_manejador.php');
include_once('db_handler.php');
$dbHandler = new DBHandler();
$articulo = new articulo();
$configuracion = $dbHandler->query("configuracion", null, "nombre_opcion='Titulo'");

if (!empty($_GET['id'])) {
    $articulo->id = $_GET['id'];
}

function cargarComentario($metodo, $comentario){
    $comentario->nombre = is_null($metodo)? "" : $metodo['txtNombre'];
    $comentario->email = is_null($metodo)? "" : $metodo['txtEmail'];
    $comentario->comentario = is_null($metodo)? "" :  $metodo['contenido'];
    $comentario->fecha_creacion = date("Y-m-d");
    $comentario->id_articulo = is_null($metodo)? "" :  "{$_GET['id']}";
    //$this->articulo->datos[0]->id
}

$articulo = $dbHandler->query("articulo a join user u on a.id_usuario = u.id", null, "a.id = ".$_GET['id']);

if($_POST) {
    $comentario = new comentario();
    cargarComentario($_POST, $comentario);
    var_dump($comentario);
    $comentario->guardar();
    //$dbHandler->insert("comentario", getComentarioArray($_POST, true));
}

function getComentarioArray($metodo, $guardar){
    $comillas = ($guardar) ? "'" : "";
    //var_dump($this->articul);
    $fieldAndValue = array("nombre" => is_null($metodo)? "" : $comillas.$metodo['txtNombre'].$comillas,
        "email" => is_null($metodo)? "" : $comillas.$metodo['txtEmail'].$comillas,
        "comentario" => is_null($metodo)? "" : $comillas.$metodo['contenido'].$comillas,
        "id_articulo" => is_null($metodo)? "" : $comillas."1".$comillas);
    return $fieldAndValue;
}

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

            $row = $articulo->datos[0]?>
            <!-- Title -->
            <h1><?php echo $row->titulo?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#"><?php echo $row->nombre?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $row->fecha_creacion ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="http://placehold.it/900x300" alt="">

            <hr>

            <!-- Post Content -->

            <?php
                /*var_dump($articulo);
                die;*/
                echo $row->contenido;
            ?>
            <hr>
            <!-- Blog Comments -->

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
               $comentarios = $dbHandler->query("comentario", null, "id_articulo = {$_GET['id']}");

             //   $sql = "select * from comentario where id = 1";
             //   $rs = mysqli_query(conexion::get(), $sql);
  //var_dump($rs);
                //$comentarios = array();
              //  while($fila = mysqli_fetch_assoc($comentarios)) {
            //        $comentarios[] = $fila;
            ///    }
            ?>
            <?php foreach ($comentarios->datos as $comment) {?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php echo $comment->nombre;?>
                            <small><?php echo $comment->fecha_creacion?></small>
                        </h4>
                        <?php echo $comment->comentario;?>
                    </div>
                </div>
            <?php }?>
            
            <hr>
             <!-- Comments Form -->
            <div class="well">
                <h4 style="margin-left: 6px;">Deja un comentario:</h4>
                <form role="form" method="POST" >
                    <div class="form-group">
                        <label style="margin-left: 4px;">Nombre:</label>
                        <input type="text" name="txtNombre" class="form-control">
                        <label style="margin-left: 4px;">Email:</label>
                        <input type="text" name="txtEmail" class="form-control">
                        <label style="margin-left: 4px;">Comentario:</label>
                        <textarea class="form-control" name="contenido" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-left: 6px;">Publicar</button>
                </form>
            </div>

            <hr>
        <!-- Blog Sidebar Widgets Column -->

    </div>
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <?php include("plantilla_buscador.php") ?>
            <?php include("plantilla_paginas.php") ?>
            <?php include("plantilla_descripcion.php") ?>

        </div>
    <!-- /.row -->

    <hr>
</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>