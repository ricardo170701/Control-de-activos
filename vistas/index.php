<?php
session_start();
include "../header.php";
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$crud = new crud();
$mensaje = '';
if (isset($_SESSION['mensaje_crud'])) {
    $mensaje = $crud->mensajesCrud($_SESSION['mensaje_crud']);
    unset($_SESSION['mensaje_crud']);
}

?>

<body class="body_index">
    <div class="sidebar">
        <div class="logo">
            <img src="../public//img//paldaca_logo.png" alt="Imagen 1">
        </div>
        <?php
        if ($mensaje != '') {
            echo "<script>
document.addEventListener('DOMContentLoaded', function() {
" . $mensaje . "
});
</script>";
        }
        ?>
        <h1>Opciones</h1>
        <ul>
            <?php



            if (!$_SESSION['visualizacion']) {
                echo '<li><a href="./maquinaria.php" class="btn btn-outline-light">Gestionar Maquinaria</a></li>';
                echo '<li><a href="./miscelaneos.php" class="btn btn-outline-light">Gestionar Miscelaneos</a></li>';
                echo '<li><a href="./notificacion.php" class="btn btn-outline-light">Gestionar Notificaciones</a></li>';
            } else {
                echo '<li><a href="./maquinaria.php" class="btn btn-outline-light">Ver Maquinaria</a></li>';
                echo '<li><a href="./miscelaneos.php" class="btn btn-outline-light">Ver Miscelaneos</a></li>';
            }
            if ($_SESSION['admin'] == true) {

                echo '<li> <a href="./verUser.php" class="btn btn-outline-light">Gestionar Usuarios</a></li>';

                echo '<li><a href="./verEliminado.php" class="btn btn-outline-light">Visualizar Eliminados</a></li>';
            }
            ?>

        </ul>
        <div class="logout r">
            <form method="post" action="../procesos//logout.php">
                <button type="submit" class="btn btn-outline-danger" name="cerrar_sesion">Cerrar sesión</button>
            </form>
        </div> <!-- Añadido para el botón de cerrar sesión -->
    </div>
    </div>
    <div class="main-content">
        <?php
        // Arrays para almacenar los registros de cada categoría
        $enUso = iterator_to_array($crud->mostrarDatosMaquinaria('uso'));
        $mantenimiento = iterator_to_array($crud->mostrarDatosMaquinaria('Mantenimiento'));

        // Función para ordenar por fecha de culminación
        function ordenarPorFecha($a, $b)
        {
            return strtotime($a->fechaCulminacion) - strtotime($b->fechaCulminacion);
        }

        // Ordenar los arrays
        usort($enUso, 'ordenarPorFecha');
        usort($mantenimiento, 'ordenarPorFecha');

        // Función para generar el HTML de cada elemento de la cuadrícula
        function generarGridItem($item, &$contador)

        {
            if ($contador < 5) {
                if ($item->estatus == 'uso') {
                    echo '<div class="grid-item">';
                    if (isset($item->imagen)) {
                        echo '<img src="' . $item->imagen . '" alt="Imagen de maquinaria">';
                    } else {
                        echo '<img src="..\public\img\Lovepik_com-611647791-Mobile phone product login interface.png" alt="Imagen de maquinaria">';
                    }
                    if (isset($item->nombre)) {
                        echo '<p>Nombre: ' . $item->nombre . '</p>';
                    } else {
                        echo '<p>Descripción no disponible</p>';
                    }
                    if (isset($item->fechaCulminacion)) {
                        echo '<p>Fecha de culminación: ' . $item->fechaCulminacion . '</p>';
                    } else {
                        echo '<p>Descripción no disponible</p>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="grid-item">';
                    if (isset($item->imagen)) {
                        echo '<img src="' . $item->imagen . '" alt="Imagen de maquinaria">';
                    } else {
                        echo '<img src="..\public\img\Lovepik_com-611647791-Mobile phone product login interface.png" alt="Imagen de maquinaria">';
                    }
                    if (isset($item->nombre)) {
                        echo '<p>' . $item->nombre . '</p>';
                    } else {
                        echo '<p>Descripción no disponible</p>';
                    }
                    if (isset($item->fechaCulminacion)) {
                        echo '<p>Fecha de culminación: ' . $item->fechaCulminacion . '</p>';
                    } else {
                        echo '<p>Descripción no disponible</p>';
                    }
                    echo '</div>';
                }
            }
        }

        // Generar el HTML de la cuadrícula
        // Generar el HTML de la cuadrícula
        echo '<div class="column">';
        echo '<h2>Maquinaria en Uso</h2>';
        echo '<div class="grid-container">';

        $contador = 0;
        foreach ($enUso as $item) {
            generarGridItem($item, $contador);
        }
        echo '</div>';
        echo '</div>';

        echo '<div class="column">';
        echo '<h2>Maquinaria en Mantenimiento</h2>';
        echo '<div class="grid-container">';
        $contador = 0;
        foreach ($mantenimiento as $item) {
            generarGridItem($item, $contador);
        }
        echo '</div>';
        echo '</div>';

        ?>
    </div>
</body>


<?php include "../scripts.php"; ?>