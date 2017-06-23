<?php
include_once('db_handler.php');
$dbHandler = new DBHandler();

$configuracion = $dbHandler->query("configuracion", null, "nombre_opcion='descripcion'");
?>
<div class="well">
    <h4>Descripci&#243;n General</h4>
    <p><?php echo $configuracion->datos[0]->valor_opcion ?> </p>
</div>