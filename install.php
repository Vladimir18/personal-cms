<?php 
error_reporting(0);

include('libreria/configuracion.php');
if (mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)) {
	header("Location:./");
}else {
	session_start();
	session_destroy();


	if ($_POST) {
		$DB_HOST = $_POST['DB_HOST'];
		$DB_USER = $_POST['DB_USER'];
		$DB_PASS = $_POST['DB_PASS'];
		$DB_NAME = $_POST['DB_NAME'];

		$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS) or die("<script>alert('Revise la configuarion, tiene problemas.');window.location='install.php';</script>");
		mysqli_query($con, "drop database {$DB_NAME}");
		mysqli_query($con, "create database {$DB_NAME}");
		mysqli_query($con, "use {$DB_NAME}");
		mysqli_query($con, "CREATE TABLE IF NOT EXISTS `user` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `nombre` varchar(50) NOT NULL,
	  `usuario` varchar(50) NOT NULL,
	  `contrasena` varchar(50) NOT NULL,
	  `email` varchar(50) NOT NULL,
	  `is_superuser` tinyint(4) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

		mysqli_query($con, "CREATE TABLE IF NOT EXISTS articulo(
		id INT NOT NULL AUTO_INCREMENT,
		titulo VARCHAR(250),
		contenido BLOB,
		id_usuario INT NOT NULL,
		fecha_creacion DATE,
		fecha_modificacion DATE,
		estado INT,
		PRIMARY KEY (id),
		CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES USER(id));");

		mysqli_query($con, "CREATE TABLE IF NOT EXISTS `pagina` (
	  `id_titulo` int(11) NOT NULL AUTO_INCREMENT,
	  `titulo` varchar(20) DEFAULT NULL,
	   contenido BLOB,
	  `fecha_creacion` date DEFAULT NULL,
	  `fecha_modificacion` date DEFAULT NULL,
	  `estado` int(11) DEFAULT NULL,
	  `id_usuario` int(11) DEFAULT NULL,
	  PRIMARY KEY (`id_titulo`),
	  KEY `fk_idUsuario` (`id_usuario`),
	  CONSTRAINT `fk_idUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		mysqli_query($con, "CREATE TABLE IF NOT EXISTS configuracion(
		id INT NOT NULL AUTO_INCREMENT,
		nombre_opcion VARCHAR(250),
		valor_opcion BLOB,
		estado INT,
		PRIMARY KEY (id));");

		mysqli_query($con, "CREATE TABLE IF NOT EXISTS `comentario` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre` varchar(25) DEFAULT NULL,
		  `email` varchar(25) DEFAULT NULL,
		  `comentario` blob,
		  `fecha_creacion` datetime DEFAULT NULL,
		  `id_articulo` int(11) DEFAULT NULL,
		  PRIMARY KEY (`id`),
		  KEY `fk_comentario` (`id_articulo`),
		  CONSTRAINT `fk_comentario` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


		mysqli_query($con, "INSERT INTO configuracion(nombre_opcion, valor_opcion, estado)VALUES ('titulo','Acer+', 1)");
		mysqli_query($con, "INSERT INTO configuracion(nombre_opcion, valor_opcion, estado)VALUES ('descripcion','Esta es la descripcion general del proyecto', 1)");
		mysqli_query($con, "INSERT INTO configuracion(nombre_opcion, valor_opcion, estado)VALUES ('nombre','', 1)");

		$config = "<?php
		define('DB_HOST', '{$DB_HOST}');
		define('DB_NAME', '{$DB_NAME}');
		define('DB_USER', '{$DB_USER}');
		define('DB_PASS', '{$DB_PASS}');
		?>";
		file_put_contents('libreria/configuracion.php', $config);


		header("Location:registrar.php");

	}
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<title>OUR</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h3>Configurar el sistema.</h3>
			</div>
			<div class="col-md-12">
				<form method="POST" style="width:70%;margin:auto;">
				  <div class="form-group">
				    <label for="">Servidor</label>
				    <input type="text" name="DB_HOST" required  class="form-control"  placeholder="Ej: localhost">
				  </div>
				  <div class="form-group">
				    <label for="">Base de datos</label>
				    <input type="text" name="DB_NAME" required class="form-control"  placeholder="Ej: dbName">
				  </div>
				  <div class="form-group">
				    <label for="">Usuario</label>
				    <input type="text" name="DB_USER" required class="form-control"  placeholder="Ej: root">
				  </div>
				  <div class="form-group">
				    <label for="">Contraseña</label>
				    <input type="text" name="DB_PASS" class="form-control"  placeholder="Ej: ****">
				  </div>
				  <button style="width:100%;" onclick="return confirm('Si no existe la base de datos se creara, si existe destruira todos los datos y se recreara.')" type="submit" class="btn btn-primary">Enviar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>