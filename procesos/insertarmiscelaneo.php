<?php session_start();
    include "../clases/conexion.php";
    include "../clases/crud.php";

    $crud = new crud();

    // Procesar la imagen
    $imagen = $_FILES['imagen'];

    // Verificar si se subió una imagen
    if ($imagen['error'] === 0) {
        // Crear un nombre único para la imagen
        $nombreImagen = uniqid('', true) . "." . pathinfo($imagen['name'], PATHINFO_EXTENSION);

        // Definir la ruta donde se guardará la imagen
        $rutaImagen = "../public/img/" . $nombreImagen;

        // Mover la imagen a la carpeta img
        if (move_uploaded_file($imagen['tmp_name'], $rutaImagen)) {
            // Guardar la ruta de la imagen en la base de datos
            $datos = array(
                "nombre"=> $_POST['nombre'],
                "modelo"=> $_POST['modelo'],
                "marca"=> $_POST['marca'],
                "cantidad"=> $_POST['cantidad'],
                "serial"=> $_POST['serial'],
                "condicion"=> $_POST['condicion'],
                "ubicacion"=> $_POST['ubicacion'],
                "fecha_salida"=> $_POST['fecha_salida'],
                "cisesma_salida"=> $_POST['cisesma_salida'],
                "imagen" => $rutaImagen
            );

            $respuesta = $crud->insertarDatosMiscelaneos($datos);

            if ($respuesta->getInsertedId()>0) {
                $_SESSION['mensaje_crud']='insert';
                header("location:../vistas/miscelaneos.php");        
            } else {
                print_r($respuesta);
            }
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    } else {
        echo "No se subió ninguna imagen.";
    }
?>
