<?php
include_once('libreria/motor.php');
include_once ('plantilla.php');
include_once ('db_handler.php');
    $dbHandler = new DBHandler();

    if($_POST){

        if(!empty($_POST['opcion'])){
            $opcionid = $_POST['opcionid'];
            $value = $_POST[$_POST['opcion']];
            $fieldAndValue = array("valor_opcion" => "'".$value."'");
            $dbHandler->update("configuracion",$fieldAndValue, "id = ".$opcionid);
        }
        header("Location:admin_config.php");
    }

?>

<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>Parametros del Sistema</h1>
        </div>
    </div>
    <div class="row">
        <form method="POST" style="margin:auto;" id="paramform" >
            <table class="table table-striped table-bordered" style="margin: 0 auto">
                <thead>
                <tr>
                    <th>Opcion</th>
                    <th>Valor</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody >
                <?php
                    $configuracion = $dbHandler->query("configuracion");
                    if(!empty($configuracion->datos)){

                        foreach ($configuracion->datos as $row) {
                            echo '<tr>';
                            echo '<td>'. $row->nombre_opcion . '</td>';
                            echo '<td>';
                            echo '<p id="'.str_replace(" ", "",$row->nombre_opcion).'campo">'. $row->valor_opcion . '</p>';
                            echo '<input id="'.str_replace(" ", "",$row->nombre_opcion).'campoedit" type="text" name="'.str_replace(" ", "",$row->nombre_opcion).'" value="'.$row->valor_opcion.'" class="form-control hidden"></td>';
                            echo '<input type="hidden" id="'.str_replace(" ", "",$row->nombre_opcion).'campoid" value="'.$row->id.'"></td>';
                            echo '<td width=250>';
                            echo '<button id="'.str_replace(" ", "",$row->nombre_opcion).'" type="button" class="btn btn-success btnEditar">Editar</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
            </table>
            <input type="hidden" value="" name="opcion" id = "opcion">
            <input type="hidden" value="" name="opcionid" id = "opcionid">
        </form>
    </div>
</div>


<script type="text/javascript">
    var btnEditar = $(".btnEditar");

    btnEditar.click(function(){
        var campo = '#'+this.id+'campo';
        var campoEdit = campo+'edit';

        if($(this).html()=="Editar"){
            $(campo).addClass("hidden");
            $(campoEdit).removeClass("hidden");
            $(this).html("Grabar");
            $("#opcion").val(this.id);

            var campoid = '#'+this.id+'campoid';
            $("#opcionid").val($(campoid).val());
        }else if($(this).html()=="Grabar"){
            $("#paramform").submit();
        }
    });
</script>