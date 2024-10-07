<?php 
session_start();
date_default_timezone_set('America/Caracas');
$fecha_actual = date("Y-m-d");

include "../clases/Conexion.php";
include "../clases/Crud.php";

$crud = new crud();
$id = $_POST['id'];
$registrar=$crud->obtenerDocumentoMaquinaria($id);
$respuesta = $crud->eliminarMaquinaria($id);

if($respuesta->getDeletedCount()>0){
    $_SESSION['mensaje_crud']='delete';
    $datos = array(
        "nombre"=> $registrar->nombre . ' '. $registrar->apellido,
        "tipo"=> "maquinaria",
        "fechaEliminacion"=> $fecha_actual,
        "responsable"=>$_SESSION['user']
    );

    $respuesta2 = $crud->insertarDatosEliminados($datos);
    if ($respuesta2->getInsertedId()>0) {
            
    } else {
        print_r($respuesta2);
    }
    header("location:../vistas/maquinaria.php");        
} else{
    print_r($respuesta);
}

?>