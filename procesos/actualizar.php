<?php session_start();
    include "../clases/conexion.php";
    include "../clases/crud.php";

    $crud = new crud();

    $id = $_POST['id'];
    $datos = array(
        "apellido"=> $_POST['apellido'],
        "nombre"=> $_POST['nombre'],
        "correo"=> $_POST['correo'],
        "cargo"=> $_POST['cargo'],
        "nivel"=> $_POST['nivel'],
    );
    $respuesta=$crud->actualizar($id,$datos);

    if ($respuesta->getModifiedCount()>0||$respuesta->getMatchedCount()>0) {
        $_SESSION['mensaje_crud']='update';
        header("location:../vistas/verUser.php");        
    }else {
        print_r($respuesta);
    }
?>