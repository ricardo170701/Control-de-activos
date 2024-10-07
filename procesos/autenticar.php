<?php session_start();
include "../clases/Conexion.php";
include "../clases/Crud.php";
$crud = new crud();
$correo = strtolower($_POST['correo']);
$password = $_POST['password'];
$datos = iterator_to_array($crud->mostrarDatosMaquinariaVista());
$resultado = $crud->autenticarUsuario($correo, $password);
if ($resultado['autenticado']) {
    echo "El usuario ha iniciado sesión correctamente.";

    $_SESSION['autenticado'] = true;
    $_SESSION['user'] = $correo;
    if ($resultado['nivel'] == 2) {
        $_SESSION['admin'] = true;
        $_SESSION['visualizacion'] = false;
        foreach ($datos as $item) {
            $fechaTimestampmant = strtotime($item->Fecha_mantenimiento);
            // Suma $periodo_mantenimiento meses a la fecha
            $fechaTimestampmant = strtotime("+" . $item->tiempo_mantenimiento . " months", $fechaTimestampmant);
            $fechaTimestampUso = strtotime($item->fechaCulminacion);
            $ahoraTimestamp = strtotime(date("Y-m-d"));

            if ($fechaTimestampmant <= $ahoraTimestamp || ($fechaTimestampUso !== false && $fechaTimestampUso <= $ahoraTimestamp)) {
                $_SESSION['mensaje_crud'] = 'notificacion';
                break;
            }
        }
    } elseif ($resultado['nivel'] == 1) {
        $_SESSION['medio'] = true;
        $_SESSION['admin'] = false;
        $_SESSION['visualizacion'] = false;
        foreach ($datos as $item) {
            $fechaTimestampmant = strtotime($item->Fecha_mantenimiento);
            // Suma $periodo_mantenimiento meses a la fecha
            $fechaTimestampmant = strtotime("+" . $item->tiempo_mantenimiento . " months", $fechaTimestampmant);
            $fechaTimestampUso = strtotime($item->fechaCulminacion);
            $ahoraTimestamp = strtotime(date("Y-m-d"));

            if ($fechaTimestampmant <= $ahoraTimestamp || ($fechaTimestampUso !== false && $fechaTimestampUso <= $ahoraTimestamp)) {
                $_SESSION['mensaje_crud'] = 'notificacion';
                break;
            }
        }
    } else {
        $_SESSION['visualizacion'] = true;
        $_SESSION['medio'] = false;
        $_SESSION['admin'] = false;
    }

    header("location:../vistas/index.php");
} else {
    header("location:../vistas/login.php");
    $_SESSION['mensaje_crud'] = 'invalido';
}
