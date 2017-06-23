<?php
error_reporting(0);
session_start();
class login{
	public $usuario;
	public $contrasena;

	function comprobar(){

		$con = conexion::get();

		$usuario = mysqli_real_escape_string($con, $this -> usuario);
		$contrasena = mysqli_real_escape_string($con, $this -> contrasena);

		$encryptedContrasena = MD5($contrasena);
		// var_dump($contrasena);

		// echo $contrasena;
		echo MD5($contrasena);
		// var_dump(MD5('{$contrasena}'));

		$sel_user = "SELECT * FROM user WHERE usuario = '{$usuario}' AND contrasena = '{$encryptedContrasena}'";
		echo "\n {$sel_user}\n";
		$run_user = mysqli_query($con, $sel_user) or die ("no traigo nada");

		$check_user = mysqli_num_rows($run_user);

		echo $check_user;

		if($check_user > 0){
			$usuario = mysqli_fetch_assoc($run_user);
			$_SESSION['usuario'] = $usuario['usuario'];
			$_SESSION['nombre'] = $usuario['nombre'];
			$_SESSION['id_usuario'] = $usuario['id'];
			// echo "<script>window.location('index.php')</script>";
			// return true;
			header("Location:./");
		} else {
			echo "<script>alert('Usuario o contrasena no es correcta, intentelo de nuevo!');</script>";
		}
	}
}

 ?>
