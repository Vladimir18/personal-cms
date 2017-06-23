<?php
include_once('libreria/motor.php');
    include_once ('plantilla.php');
include_once ('db_handler.php');

    $dbHandler = new DBHandler();

    $is_super = false;
    $result = $dbHandler->query("user", null, "is_superuser=1 and id=".$_SESSION['id_usuario']);
    if(!is_null($result->datos)){
        $is_super =true;
    }
    $user = new user;
    cargarUsuario(null, $user);

    $op = "Crear";
    $is_actualizar = false;


    if (!empty($_GET['op']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $op = $_GET['op'];
    }

    if (isset($op) && isset($id) && $op == "d") {
        $dbHandler->delete("user", "id = '".$id."'");
        header("Location:admin_usuarios.php");
    }else if(isset($op) && isset($id) && $op == "Actualizar"){
        $users = $dbHandler->query("user", null, "id = ".$id);
        if(!empty($users->datos)){
            $user = $users->datos[0];
        }
        $op = "Actualizar";
        $is_actualizar = true;
    }

    if($_POST){

        if($_POST['op']=="Crear"){
            $user = new user;
            cargarUsuario($_POST,$user);
            $user->guardar();
        }else if($_POST['op']=="Actualizar"){
            $user = new user;

            cargarUsuario($_POST,$user);
            $fieldAndValue = array("nombre" => "'".$user->nombre."'",
                "usuario" => "'".$user->usuario."'",
                "contrasena" => "MD5('".$user->contrasena."')",
                "email" => "'".$user->email."'");
//            var_dump($fieldAndValue);die;
            $dbHandler->update("user",$fieldAndValue, "id = ".$id);
        }
        header("Location:admin_usuarios.php");
    }

    function cargarUsuario($metodo, $user){
        $user->nombre = is_null($metodo)? "" : $metodo['txtNombre'];
        $user->usuario =is_null($metodo)? "" :  $metodo['txtUsuario'];
        $user->contrasena =is_null($metodo)? "" :  $metodo['txtContrasena'];
        $user->email =is_null($metodo)? "" :  $metodo['txtEmail'];
    }


?>

<div class="container" id="crearUsuario">
    <div class="row">
        <div class="page-header">
            <h1 id="tituloOP">Crear usuario</h1>
        </div>
        <div class="col-md-12">
            <form method="POST" style="width:70%; margin:auto;">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="txtNombre" required class="form-control"  placeholder="Nombre" value="<?php echo $user->nombre?>">
                </div>
                <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" name="txtUsuario" required class="form-control"  placeholder="Nombre de usuario" value="<?php echo $user->usuario?>">
                </div>
                <div class="form-group">
                    <label for="">Contrase&#241;a</label>
                    <input type="password" name="txtContrasena" id="clave" required class="form-control" placeholder="Contrase&#241;a" value="<?php echo $user->contrasena?>">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="txtEmail" required class="form-control"  placeholder="Email" value="<?php echo $user->email?>">
                </div>
                <button style="width:20%;" type="submit" class="btn btn-primary"><?php echo $op; ?></button>
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
            <h1>Usuarios</h1>
        </div>
    </div>
    <div class="row">
        <p>
            <a class="btn btn-primary" id="btnCrear">Crear</a>
        </p>
        <table class="table table-striped table-bordered" style="margin: 0 auto">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Constrase&#241;a</th>
                <th>Email</th>
                <th>Acci&#243;n</th>
            </tr>
            </thead>
            <tbody >
            <?php
                $user = $dbHandler->query("user");
//            var_dump($_SESSION['id_usuario']);
                if(!empty($user->datos)){

                    foreach ($user->datos as $row) {
                        echo '<tr>';
                        echo '<td>'. $row->nombre . '</td>';
                        echo '<td>'. $row->usuario . '</td>';
                        echo '<td>'. $row->contrasena . '</td>';
                        echo '<td>'. $row->email . '</td>';
                        echo '<td width=250>';

                        if(!$is_super && $row->id == $_SESSION['id_usuario'] || $is_super){
                            echo '<a id="btnActualizarUsuario" class="btn btn-success" href="admin_usuarios.php?op=Actualizar&id='.$row->id.'">Actualizar</a>';
                        }
                        if($is_super && $row->id != $_SESSION['id_usuario']){
                            echo ' ';
                            echo '<a class="btn btn-danger" href="admin_usuarios.php?op=d&id='.$row->id.'">Eliminar</a>';
                        }
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
    var input = $("#clave");
    var op = $("#op");

    input.blur(function() {
        if(input.val().length < 6){
            alert('La clave debe tener un m�nimo de 5 caracteres.');
        }
    });

    var btnCrear = $("#btnCrear");
    btnCrear.click(function() {
        formCrear.show(true);
        btnCrear.hide(true);
    });

    var formCrear = $("#crearUsuario");
    if($("#actualiza").val() != 1){
        formCrear.hide(true);
    }else{
        btnCrear.hide(true);
        tituloOp.html("Actualizar usuario");
        op.val("Actualizar");
    }

    var btnCancelar = $("#cancelar");
    btnCancelar.click(function(){
        btnCrear.show(true);
        formCrear.hide(true);
    });

    var btnActualizar = $("#btnActualizarUsuario");
    btnActualizar.click(function() {
        formCrear.show(true);
        tituloOp.html("Crear usuario");
        op.val("Crear");
        btnCrear.hide(true);
    });

</script>