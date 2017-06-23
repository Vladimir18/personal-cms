<?php 
include_once('libreria/motor.php');
include_once('plantilla.php');
include_once('carga_ccs_js.php');
include_once('db_handler.php');
error_reporting(0);
session_start();

if ($_SESSION['usuario']){
	header("Location:./");
}else{

if($_POST){

	$user = new user();

	$user->nombre = $_POST['txtNombre'];
	$user->usuario = $_POST['txtUsuario'];
	$user->contrasena = $_POST['txtContrasena'];
	$user->email = $_POST['txtEmail'];
	$user->guardar();
	header("Location:index.php");
}
 ?>
<div class="container">
	<div class="row">
	<div class="page-header">
		<h1>Crea tu usuario.</h1>
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
			    <label for="">Contraseña</label>
			    <input type="password" name="txtContrasena" id="clave" required class="form-control" placeholder="Contraseña">
			  </div>
			  <div class="form-group">
			    <label for="">Email</label>
			    <input type="email" name="txtEmail" required class="form-control"  placeholder="Email">
			  </div>
			  <button style="width:100%;" type="submit" class="btn btn-primary">Enviar</button>
			  <label for=""><a href="login.php">Ya tienes cuenta? Inicia Sesion!</a></label>
			  
			   <script type="text/javascript">
					var input = $("#clave");
					input.blur(function() {
						if(input.val().length < 6){
							alert('La clave debe tener un mínimo de 5 caracteres.');
						}
					});
			   </script>
		</form>
		</div>
	</div>
</div>
<?php } ?>