<?php
include_once ('plantilla.php');
session_start();
if(!isset($_SESSION['usuario'])){
	header("Location:login.php");
}
?>

<div align="center">
	<br/><br/>
	<div class="row">
	  <div class="col-md-3">
		<div class="thumbnail">
		  <a href="admin_usuarios.php">
		  <img src="img/usuarios.png">
		  <div class="caption">
			<h3>Usuarios</a></h3>
		  </div>
		</div>
	  </div>
	  <div class="col-md-3">
		<div class="thumbnail">
		  <a href="admin_paginas.php">
		  <img src="img/paginas.png" height="128" width="128">
		  <div class="caption">
			<h3>P&#225;ginas</a>
		  </div>
		</div>
	  </div>
	  <div class="col-md-3">
		<div class="thumbnail">
		  <a href="admin_articulos.php">
		  <img src="img/articulos.jpg" height="128" width="128">
		  <div class="caption">
			<h3>Art&#237;culos</a></h3>
		  </div>
		</div>
	  </div>
	  <div class="col-md-3">
		<div class="thumbnail">
		  <a href="admin_config.php">
		  <img src="img/configuracion.png" height="128" width="128">
		  <div class="caption">
			<h3>Configuraci&#243;n</a></h3>
		  </div>
		</div>
	  </div>
	</div>
</div>