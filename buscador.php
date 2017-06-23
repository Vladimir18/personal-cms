<?php
include_once('libreria/motor.php');
include_once ('plantilla.php');
include_once ('db_handler.php');
$dbHandler = new DBHandler();

if($_POST){

    if(!empty($_POST['buscar'])){
        $resultado_articulos = $dbHandler->query("articulo", null, "titulo like '%".$_POST['buscar']."%' or contenido like '%".$_POST['buscar']."%'");
        $resultado_paginas = $dbHandler->query("pagina", null, "titulo like '%".$_POST['buscar']."%' or contenido like '%".$_POST['buscar']."%'");
    }
}

?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <?php include("plantilla_buscador.php") ?>

            <?php if(!is_null($resultado_articulos->datos) || !is_null($resultado_paginas->datos)){
                    echo '<h1 class="page-header">Resultados</h1>';
                    echo "<br>";
                }?>


            <?php foreach ($resultado_articulos->datos as $row) {?>
                <h2>
                    <a href="articulo.php?id=<?php echo $row->id ?>"><?php echo $row->titulo ?></a>
                </h2>

                <hr>
            <?php } ?>
            <?php foreach ($resultado_paginas->datos as $row) {?>
                <h2>
                    <a href="pagina.php?id=<?php echo $row->id_titulo ?>"><?php echo $row->titulo ?></a>
                </h2>

                <hr>
            <?php }
            if(is_null($resultado_articulos->datos) && is_null($resultado_paginas->datos)){
                echo "No fueron encontrados resultados";
            }
            ?>
        </div>
        <div class="col-md-4">

            <?php include("plantilla_paginas.php") ?>
            <?php include("plantilla_descripcion.php") ?>

        </div>
    </div>

</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>


