<?php
include "../clases/Conexion.php";
include "../clases/Crud.php";
$crud = new crud();
$id = $_POST['id'];
$datos = $crud->obtenerDocumentoMiscelaneo($id);
$idMongo = $datos->_id;

?>
<?php include "../header.php"; ?>
<div class="container">
<div class="row">
<div class="col">
<div class="card mt-4">
<div class="card-body">
    <?php
echo '<a href="./verMiscelaneo.php?id=' . $datos->_id . '" class="btn btn-outline-info">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-btn" viewBox="0 0 16 16">
<path d="M11.21 5.093A.5.5 0 0 1 12 5.5v5a.5.5 0 0 1-.79.407L8.5 8.972V10.5a.5.5 0 0 1-.79.407L5 8.972V10.5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 1 0v1.528l2.71-1.935a.5.5 0 0 1 .79.407v1.528z" />
<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
</svg> Regresar
</a>';
?>
<h2>Actualizar registro</h2>
<form action="../procesos/actualizarMiscelaneos.php" method="post" enctype="multipart/form-data">
<input type="text" hidden value="<?php echo $idMongo ?>" name="id">
<label for="nombre">Nombre</label>
<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos->nombre ?>">
<label for="modelo">Modelo</label>
<input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $datos->modelo ?>">
<label for="marca">Marca</label>
<input type="text" class="form-control" id="marca" name="marca" value="<?php echo $datos->marca ?>">
<label for="cantidad">Cantidad</label>
<input type="text" class="form-control" id="cantidad" name="cantidad" value="<?php echo $datos->cantidad ?>">
<label for="serial">Serial</label>
<input type="text" class="form-control" id="serial" name="serial" value="<?php echo $datos->serial ?>">
<label for="condicion">Condición</label>
<input type="text" class="form-control" id="condicion" name="condicion" value="<?php echo $datos->condicion ?>">
<label for="ubicacion">Ubicación</label>
<input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo $datos->ubicacion ?>">
<label for="fecha_salida">Fecha de salida</label>
<input type="text" class="form-control" id="fecha_salida" name="fecha_salida" value="<?php echo $datos->fecha_salida ?>">
<label for="cisesma_salida">Cisesma de salida</label>
<input type="text" class="form-control" id="cisesma_salida" name="cisesma_salida" value="<?php echo $datos->cisesma_salida ?>">
<label for="imagen">Imagen</label>
<input type="file" class="form-control" id="imagen" name="imagen">
<button class="btn btn-warning mt-3">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
<path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
<path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
</svg> Actualizar
</button>
</form>
</div>
</div>
</div>
</div>
</div>
<?php include "../scripts.php"; ?>