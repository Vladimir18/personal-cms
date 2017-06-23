<?php
    include('plantilla.php');
    include('libreria/motor.php');

    if($_POST){
        $user = new user;

        $user->nombre = $_POST['txtNombre'];
        $user->usuario = $_POST['txtUsuario'];
        $user->contrasena = $_POST['txtContrasena'];
        $user->email = $_POST['txtEmail'];
        $user->guardar();
        header("Location:admin_usuarios.php");
    }
?>

<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>Crear usuario</h1>
        </div>
        <div class="col-md-12">
            <form method="POST" style="width:70%; margin:auto;">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="txtNombre" required class="form-control"  placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" name="txtUsuario" required class="form-control"  placeholder="Nombre de usuario">
                </div>
                <div class="form-group">
                    <label for="">Contrase&#241;a</label>
                    <input type="password" name="txtContrasena" id="clave" required class="form-control" placeholder="Contrase&#241;a">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="txtEmail" required class="form-control"  placeholder="Email">
                </div>
                <button style="width:20%;" type="submit" class="btn btn-primary">Crear</button>
<!--                <button type="submit" class="btn btn-success">Create</button>-->
                <a class="btn" href="admin_usuarios.php">Volver</a>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var input = $("#clave");
    input.blur(function() {
        if(input.val().length < 6){
            alert('La clave debe tener un mínimo de 5 caracteres.');
        }
    });
</script>
