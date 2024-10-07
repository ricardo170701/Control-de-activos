<?php
session_start();
include "../clases/conexion.php";
include "../clases/crud.php";

$crud = new crud();
$id = $_POST['id'];
$datos = $crud->obtenerDocumentoMaquinaria($id);

if ($_POST['estatus'] == 'Mantenimiento') {
    $datos = array(
        "estatus" => $_POST['estatus'],
        "fechaCulminacion" => $_POST['fechaCulminacion'],
        "ubicacion" => $_POST['ubicacion'],
        "Fecha_mantenimiento" => date("Y-m-d") // Esto establecerá la fecha de hoy
    );
} else {
    $datos = array(
        "estatus" => $_POST['estatus'],
        "fechaCulminacion" => $_POST['fechaCulminacion'],
        "ubicacion" => $_POST['ubicacion']
    );
}

$respuesta = $crud->actualizarMaquinaria($id, $datos);

if ($respuesta->getModifiedCount() > 0 || $respuesta->getMatchedCount() > 0) {
    $_SESSION['mensaje_crud'] = 'update';
} else {
    print_r($respuesta);
}

if ($_POST['estatus'] == 'Mantenimiento') {
    $mantenimiento = array(
        "Fecha_mantenimiento" => date("Y-m-d"), // Esto establecerá la fecha de hoy
        "descripcion" => $_POST['descripcion'] // reemplaza esto con la descripción del mantenimiento
    );



    $respuesta = $crud->agregarMantenimiento($id, $mantenimiento);

    if ($respuesta->getModifiedCount() > 0 || $respuesta->getMatchedCount() > 0) {
        $_SESSION['mensaje_crud'] = 'update';
        header("location:../vistas/maquinaria.php");
    } else {
        print_r($respuesta);
    }
} else {
    $_SESSION['mensaje_crud'] = 'update';
    header("location:../vistas/maquinaria.php");
}
