<?php
include_once('plantilla.php');

?>

<form method="post" action=""> 
	<div style="border: 1px solid #CCCCCC; margin-left: 4%; margin-right: 50%; text-align: center; position: relative;">
		<table class="table" style="margin:0 auto;">
			<tr>
				<th style="padding: 0px 8px; border-top: 0;">T&#237;tulo del sitio</th>
			</tr>	
			<tr>
				<td style="border: 0px; padding: 0px 8px;"> <input type="text" name="txtTitulo" required class="form-control" style="width: 100%; margin:0 auto; margin-top: 2px;"/></td>
			</tr> <br/> 
			<tr>
				<th style="padding: 0px 8px; border: 0px; padding-top: 6px;">Dirección IP</th>
			</tr>
			<tr>
				<td style="border: 0px; padding: 0px 8px;"> <input type="text" id="clave" required name="txtDireccionIp" class="form-control" style="width: 100%; margin:0 auto; margin-top: 2px;"/></td>
			</tr> 
			<tr>
				<th style="padding: 0px 8px; border: 0px; padding-top: 6px;">Descripción</th>
			</tr>
			<tr>
				<td style="border: 0px; padding: 0px 8px;"> <input type="textarea" required name="txtDescripcion" class="form-control" style="width: 100%; margin:0 auto; margin-top: 2px; height: 50px;"/></td>
			</tr>
			<tr>
				<td align="center" style="padding-bottom: 10px; border: 0;"><button type="submit" class="btn btn-primary" style="width: 100%; margin:0 auto;">Aceptar</button></td>
			</tr>
			<!-- <tr>
				<td style="padding-left:12px;"><label><a href="registrar.php">No tienes cuenta? Registrate!</a></label></td>
			</tr> -->
		</table>
		<!-- <label>Titulo</label>
		<input type="text" name="txtTitulo" class="form-control"/>
		<label>Dirección IP</label>
		<input type="text" name="txtTitulo" class="form-control"/>
		<label>Descripción</label>
		<input type="textarea" name="txtTitulo" class="form-control"/>
		<button type="submit" name="btnAceptar" class="btn btn-primary">Aceptar</button> -->
	</div>
</form>