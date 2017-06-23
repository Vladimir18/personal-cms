<?php
//error_reporting();
session_start();

class user{
	public $id_usuario;
	public $nombre;
	public $usuario;
	public $contrasena;
	public $email;
	public $is_superuser;
	public $dbHandler;

	function __construct()
	{
		$this->dbHandler = new DBHandler();
	}

	function guardar(){
		$usuarios = $this->dbHandler->query("user");
		if($usuarios->datos == null){
			$this->is_superuser = 1;
		}else{
			$this->is_superuser = 0;
		}
		$sql = "INSERT INTO user (nombre,usuario,contrasena,email,is_superuser) VALUES ('{$this->nombre}','{$this->usuario}',MD5('{$this->contrasena}'),'{$this->email}', '{$this->is_superuser}')";
		$con = conexion::get();
		mysqli_query($con, $sql);
		if($this->is_superuser == 1){
			$_SESSION['usuario'] = $this->usuario;
			$_SESSION['nombre'] = $this->nombre;
			$_SESSION['id_usuario'] = $this->id;
		}
	}
}

 ?>