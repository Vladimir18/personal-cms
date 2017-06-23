
<?php
include_once("../carga_ccs_js.php");
include ('../plantilla.php');


?>

    <script type="text/javascript" src="ckeditor.js"></script>

<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>Crear articulo.</h1>
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
        <form action="guardar.php" method="post">
            <textarea name="entradas" id="entradas" rows="10" cols="80"></textarea>
			
            <script>
                CKEDITOR.replace( 'entradas',
                    {
                        filebrowserBrowseUrl :'filemanager/browser/default/browser.html?Connector=http://kodemaster.co.cc/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
                        filebrowserImageBrowseUrl : 'filemanager/browser/default/browser.html?Type=Image&Connector=http://kodemaster.co.cc/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
                        filebrowserFlashBrowseUrl :'filemanager/browser/default/browser.html?Type=Flash&Connector=http://kodemaster.co.cc/filemanager_in_ckeditor/js/ckeditor/filemanager/connectors/php/connector.php',
                        filebrowserUploadUrl  :'filemanager/connectors/php/upload.php?Type=File',
                        filebrowserImageUploadUrl : 'filemanager/connectors/php/upload.php?Type=Image',
                        filebrowserFlashUploadUrl : 'filemanager/connectors/php/upload.php?Type=Flash'
                    });


            </script>
			<br>
			<br>
			<button class="btn btn-primary" type="submit" value="Publicar">Publicar</button>
        </form>
	<br>
	<br>

	<br>
	<br>
	<br>
