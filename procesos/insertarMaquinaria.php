<?php session_start();
include "../clases/conexion.php";
include "../clases/crud.php";
$crud = new crud();
$imagen = $_FILES['imagen'];
if ($imagen['error'] === 0) {
    $nombreImagen = uniqid('', true) . "." . pathinfo($imagen['name'], PATHINFO_EXTENSION);
    $rutaImagen = "../public/img/" . $nombreImagen;
    if (move_uploaded_file($imagen['tmp_name'], $rutaImagen)) {
        $datos = array(
            "nombre" => $_POST['nombre'],
            "ubicacion" => $_POST['ubicacion'],
            "marca" => $_POST['marca'],
            "estatus" => "disponible",
            "modelo" => $_POST['modelo'],
            "tipo" => $_POST['tipo'],
            "año" => $_POST['año'],
            "placa" => $_POST['placa'],
            "peso" => $_POST['peso'],
            "tiempo_mantenimiento" => $_POST['tiempo_mantenimiento'],
            "Fecha_mantenimiento" => $_POST['Fecha_mantenimiento'],
            "imagen" => $rutaImagen,
            "fechaCulminacion" => null
        );
        $respuesta = $crud->insertarDatosMaquinaria($datos);
        if ($respuesta->getInsertedId() > 0) {
            $_SESSION['mensaje_crud'] = 'insert';
            header("location:../vistas/maquinaria.php");
        } else {
            print_r($respuesta);
        }
    } else {
        echo "Hubo un error al subir la imagen.";
    }
} else {
    echo "No se subió ninguna imagen.";
}
