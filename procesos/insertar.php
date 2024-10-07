<?php session_start();
include "../clases/conexion.php";
include "../clases/crud.php";

$crud = new crud();
$correo =  strtolower($_POST['correo']);
$verificacion = $crud->verificarUsuario($correo);

if ($verificacion == true) {
    $datos = array(
        "apellido" => $_POST['apellido'],
        "nombre" => $_POST['nombre'],
        "correo" => strtolower($_POST['correo']),
        "fechaRegistro" => $_POST['fechaRegistro'],
        "cargo" => $_POST['cargo'],
        "nivel" => $_POST['nivel'],
        "password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
    );

    $respuesta = $crud->insertarDatos($datos);

    if ($respuesta->getInsertedId() > 0) {
        $_SESSION['mensaje_crud'] = 'insert';

        header("location:../vistas/verUser.php");
    } else {
        print_r($respuesta);
    }
} else {
    $_SESSION['mensaje_crud'] = 'exist';

    header("location:../vistas/agregar.php");
}
