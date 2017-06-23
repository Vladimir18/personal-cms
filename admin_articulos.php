<?php
include_once('libreria/motor.php');
include_once ('plantilla.php');
include_once ('db_handler.php');

$dbHandler = new DBHandler();

    $articulo = getArticuloArray(null, false);


    $op = "Crear";
    $is_actualizar = false;


    if (!empty($_GET['op']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $op = $_GET['op'];
    }

    if (isset($op) && isset($id) && $op == "d") {
        $dbHandler->delete("articulo", "id = '".$id."'");
        header("Location:admin_articulos.php");
    }else if(isset($op) && isset($id) && $op == "Actualizar"){

        $articulos = $dbHandler->query("articulo", null, "id = ".$id);
        if(!empty($articulos->datos)){
            $articulo = cargarArticulo($articulos->datos[0]);
        }
        $op = "Actualizar";
        $is_actualizar = true;
    }

    if($_POST){
        if($_POST['op']=="Crear"){
            $dbHandler->insert("articulo",getArticuloArray($_POST, true));
        }else if($_POST['op']=="Actualizar"){
            $dbHandler->update("articulo",getArticuloArray($_POST, true), "id = ".$id);
        }
        header("Location:admin_articulos.php");
    }

    function cargarArticulo($articulo){
        $fieldAndValue = array("titulo" => $articulo->titulo,
            "contenido" => $articulo->contenido);
        return $fieldAndValue;
    }

    function getArticuloArray($metodo, $guardar){
        $comillas = ($guardar) ? "'" : "";

        $fieldAndValue = array("titulo" => is_null($metodo)? "" : $comillas.$metodo['txtTitulo'].$comillas,
            "contenido" => is_null($metodo)? "" : $comillas.$metodo['entradas'].$comillas,
            "id_usuario" => is_null($metodo)? "" : $comillas.$_SESSION['id_usuario'].$comillas,
            "fecha_creacion" => is_null($metodo)? "" : "NOW()",
            "fecha_modificacion" => is_null($metodo)? "" : "NOW()");
        return $fieldAndValue;
    }
?>

<div class="container" id="crearArticulo">
    <div class="row">
        <div class="page-header">
            <h1 id="tituloOP">Crear articulo</h1>
        </div>
        <div class="col-md-12">
            <script type="text/javascript" src="editor/ckeditor.js"></script>
            <form method="POST" style="width:70%; margin:auto;">
                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" name="txtTitulo" required class="form-control"  placeholder="Titulo" value="<?php echo $articulo["titulo"]?>">
                </div>
                <textarea name="entradas" id="entradas" rows="10" cols="80" ><?php echo $articulo["contenido"]?></textarea>

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
            <h1>Articulos</h1>
        </div>
    </div>
    <div class="row">
        <p>
            <a class="btn btn-primary" id="btnCrear">Crear</a>
        </p>
        <table class="table table-striped table-bordered" style="margin: 0 auto">
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Usuario</th>
                <th>Fecha Creacion</th>
                <th>Fecha Modificacion</th>
                <th>Accion</th>
            </tr>
            </thead>
            <tbody >
            <?php
            $_SESSION['id_usuario'] = 1;
                $articulos = $dbHandler->query("articulo", null, "id_usuario = ".$_SESSION['id_usuario']);
                if(!empty($articulos->datos)){
                    foreach ($articulos->datos as $row) {
                        echo '<tr>';
                        echo '<td>'. $row->titulo . '</td>';
                        echo '<td>'. $row->id_usuario . '</td>';
                        echo '<td>'. $row->fecha_creacion . '</td>';
                        echo '<td>'. $row->fecha_modificacion . '</td>';
                        echo '<td width=250>';
                        echo '<a id="btnActualizarArticulo" class="btn btn-success" href="admin_articulos.php?op=Actualizar&id='.$row->id.'">Actualizar</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="admin_articulos.php?op=d&id='.$row->id.'">Eliminar</a>';
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

    var formCrear = $("#crearArticulo");
    if($("#actualiza").val() != 1){
        formCrear.hide(true);
    }else{
        btnCrear.hide(true);
        tituloOp.html("Actualizar articulo");
        op.val("Actualizar");
    }

    var btnCancelar = $("#cancelar");
    btnCancelar.click(function(){
        btnCrear.show(true);
        formCrear.hide(true);
    });

    var btnActualizar = $("#btnActualizarArticulo");
    btnActualizar.click(function() {
        formCrear.show(true);
        tituloOp.html("Crear articulo");
        op.val("Crear");
        btnCrear.hide(true);
    });

</script>