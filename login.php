<?php
error_reporting(0);
include_once('libreria/motor.php');
include_once('plantilla.php');
session_start();
$mensaje= "";
if($_POST){
	$login = new login();
	$login->usuario = $_POST['txtUsr'];
	$login->contrasena = $_POST['txtClv'];
	echo "from login.php";
	var_dump($login->contrasena);

	if($login->comprobar($usr,$clv)){
		// echo "<script>window.location('index.php');</script>";
		header("Location:index.php");
	}else{
		$mensaje = "Usuario o clave no validos";
	}
}
?>
<style type="text/css">
	body{
		background-color: #cccccc;
	}
	table{
		background-color: #fff;
	}
</style>
<br/> <br/> <br/> <br/>
<form method="post" action="" >
	<div style="border: 1px solid #CCCCCC; margin-left: 40%; margin-right: 40%; text-align: center; position: relative;">
		<table class="table" id="tblLogin" style="margin:0 auto;">
			<tr>
				<th style="padding: 0px 8px; border-top: 0; padding-top: 18px;">Usuario/Email  </th>
			</tr>
			<tr>
				<td style="border: 0px; padding: 0px 8px;"> <input type="text" name="txtUsr" required class="form-control" style="width: 100%; margin:0 auto; margin-top: 2px;"/></td>
			</tr> <br/>
			<tr>
				<th style="padding: 0px 8px; border: 0px; padding-top: 6px;">Contrase&#241;a</th>
			</tr>
			<tr>
				<td style="border: 0px; padding: 0px 8px;"> <input type="password" id="clave" required name="txtClv" class="form-control" style="width: 100%; margin:0 auto; margin-top: 2px;"/></td>
			</tr>
			<tr>
				<td align="center" style="padding-bottom: 10px; border: 0;"><button type="submit" class="btn btn-primary" style="width: 100%; margin:0 auto;">Entrar</button></td>
			</tr>
			<!-- <tr>
				<td style="padding-left:12px;"><label><a href="registrar.php">No tienes cuenta? Registrate!</a></label></td>
			</tr> -->
			<tr><th style="padding-left:12px; border: 0;"><?php echo $mensaje; ?></th></tr>
		</table>
    </div></br>
</form>
