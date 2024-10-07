<?php 
session_start();

include "../clases/Conexion.php";
include "../clases/Crud.php";

$crud = new crud();
$id = $_POST['id'];

$respuesta = $crud->eliminarMiscelaneo($id);

if ($respuesta->getDeletedCount() > 0) {
    $_SESSION['mensaje_crud']='delete';
    header("location:../vistas/miscelaneos.php");        
} else {
    print_r($respuesta);
}
?>