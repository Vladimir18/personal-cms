<?php
include_once('db_handler.php');
$dbHandler = new DBHandler();
$paginas = $dbHandler->query("pagina");

?>
<div class="well">
					<h4>Paginas</h4>
					<div class="row">
						<ul class="list-unstyled">
						</ul>
						<?php foreach ($paginas->datos as $row) {?>


    <li><a href="pagina.php?id=<?php echo $row->id_titulo ?>"><?php echo $row->titulo ?></a></a>
    </li>

<?php } ?>
<!-- /.col-lg-6 -->
</div>
<!-- /.row -->
</div>