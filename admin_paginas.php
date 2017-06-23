<?php
include_once('libreria/motor.php');
include_once ('plantilla.php');
include_once ('db_handler.php');
include_once('libreria/cls_manejador.php');
$dbHandler = new DBHandler();

$pagina = new pagina;
cargarPagina(null, $pagina, false);

$op = "Crear";
$is_actualizar = false;

if (!empty($_GET['op']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $op = $_GET['op'];
}

if (isset($op) && isset($id) && $op == "d") {
    $dbHandler->delete("pagina", "id_titulo = '".$id."'");
}else if(isset($op) && isset($id) && $op == "Actualizar"){
    $paginas = $dbHandler->query("pagina", null, "id_titulo = ".$id);
    if(!empty($paginas->datos)){
        $pagina = $paginas->datos[0];
    }
    $op = "Actualizar";
    $is_actualizar = true;
}

if($_POST){
    if($_POST['op']=="Crear"){
        $pagina = new pagina();
        cargarPagina($_POST,$pagina, true);
        $pagina->guardar();
    }else if($_POST['op']=="Actualizar"){
        $pagina = new pagina();
        cargarPagina($_POST,$pagina, false);

        $fieldAndValue = array("titulo" => "'".$pagina->titulo."'",
            "contenido" => "'".$pagina->contenido."'",
            "fecha_modificacion" => "NOW()",
            "estado" => "'".$pagina->estado."'");

        $dbHandler->update("pagina",$fieldAndValue, "id_titulo = ".$id);
//        var_dump($fieldAndValue);
//        die;
    }
    header("Location:admin_paginas.php");
}

function cargarPagina($metodo, $pagina, $is_insert){
    $pagina->titulo = is_null($metodo)? "" : $metodo['txtTitulo'];
    $pagina->contenido = is_null($metodo)? "" :  $metodo['entradas'];
    $pagina->id_usuario = is_null($metodo)? "" :  $_SESSION['id_usuario'];
    $pagina->fecha_modificacion = "NOW()";
    $pagina->estado = 1;
    if($is_insert && !is_null($metodo)){
        $pagina->fecha_creacion = "NOW()";
    }
}
?>

<div class="container" id="crearPagina">
    <div class="row">
        <div class="page-header">
            <h1 id="tituloOP">Crear p&#225;gina</h1>
        </div>
        <div class="col-md-12">
            <script type="text/javascript" src="editor/ckeditor.js"></script>
            <form method="POST" style="width:70%; margin:auto;" >
                <div class="form-group" style="padding-left: 0px">
                    <label for="">Titulo</label>
                    <input type="text" name="txtTitulo" required class="form-control"  placeholder="Titulo" value="<?php echo $pagina->titulo?>">
                </div>
                <textarea name="entradas" id="entradas" rows="10" cols="80" ><?php echo $pagina->contenido?></textarea>

                <script>
                    CKEDITOR.replace( 'entradas',
                        {
                            filebrowserBrowseUrl :'editor/filemanager/browser/default/browser.html?Connector=http://kodemaster.co.cc/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
                            filebrowserImageBrowseUrl : 'editor/filemanager/browser/default/browser.html?Type=Image&Connector=http://kodemaster.co.cc/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
                            filebrowserFlashBrowseUrl :'editor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://kodemaster.co.cc/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
                            filebrowserUploadUrl  :'editor/filemanager/connectors/php/upload.php?Type=File',
                            filebrowserImageUploadUrl : 'editor/filemanager/connectors/php/upload.php?Type=Image',
                            filebrowserFlashUploadUrl : 'editor/filemanager/connectors/php/upload.php?Type=Flash'
                        });
                </script>
                <br>
                <br>
                <button style="width:20%;" type="submit" class="btn btn-primary"><?php echo ($op=="d")?"Crear" : $op; ?></button>


                <button style="width:20%;" type="button" class="btn btn-primary" id="cancelar">Cancelar</button>
                <input type="hidden" value="<?php echo $op ?>" name="op" id = "op">
                <input type="hidden" value="<?php echo $is_actualizar ?>" name="actualiza" id = "actualiza">

            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>P&#225;ginas</h1>
        </div>
    </div>
    <div class="row">
        <p>
            <a class="btn btn-primary" id="btnCrear">Crear</a>
        </p>
        <table class="table table-striped table-bordered" style="margin: 0 auto">
            <thead>
            <tr>
                <th>T&#237;tulo</th>
                <th>Fecha Creaci&#243;n</th>
                <th>Fecha Modificaci&#243;n</th>
                <th>Usuario</th>
                <th>Acci&#243;n</th>
            </tr>
            </thead>
            <tbody >
            <?php
            $pagina = $dbHandler->query("pagina");
            if(!empty($pagina->datos)){
                foreach ($pagina->datos as $row) {
                    echo '<tr>';
                    echo '<td>'. $row->titulo . '</td>';
                    echo '<td>'. $row->fecha_creacion . '</td>';
                    echo '<td>'. $row->fecha_modificacion . '</td>';
                    echo '<td>'. $row->nombre . '</td>';
                    echo '<td width=250>';
                    echo '<a id="btnActualizarPagina" class="btn btn-success" href="admin_paginas.php?op=Actualizar&id='.$row->id_titulo.'">Actualizar</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="admin_paginas.php?op=d&id='.$row->id_titulo.'">Eliminar</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    var tituloOp = $("#tituloOP");
    var op = $("#op");

    var btnCrear = $("#btnCrear");
    btnCrear.click(function() {
        formCrear.show(true);
        btnCrear.hide(true);
    });

    var formCrear = $("#crearPagina");
    if($("#actualiza").val() != 1){
        formCrear.hide(true);
    }else{
        btnCrear.hide(true);
        tituloOp.html("Actualizar p&#225;gina");
        op.val("Actualizar");
    }

    var btnCancelar = $("#cancelar");
    btnCancelar.click(function(){
        btnCrear.show(true);
        formCrear.hide(true);
    });

    var btnActualizar = $("#btnActualizarPagina");
    btnActualizar.click(function() {
        formCrear.show(true);
        tituloOp.html("Crear p&#225;gina");
        op.val("Crear");
        btnCrear.hide(true);
    });

</script>