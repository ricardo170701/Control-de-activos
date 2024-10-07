<?php
session_start();
include "../clases/conexion.php";
include "../clases/crud.php";

$crud = new crud();
$id = $_POST['id'];
$datos = $crud->obtenerDocumentoMaquinaria($id);


            $datos = array(
           
                "estatus" => 'disponible',
                "ubicacion"=>'paldaca',
                'fechaCulminacion'=> null
     
            );
            $respuesta = $crud->actualizarMaquinaria($id, $datos);

            if ($respuesta->getModifiedCount() > 0 || $respuesta->getMatchedCount() > 0) {
                $_SESSION['mensaje_crud'] = 'update';
                header("location:../vistas/notificacion.php");
            } else {
                print_r($respuesta);
            }
       