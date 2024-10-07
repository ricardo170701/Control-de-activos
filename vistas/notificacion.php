<?php
session_start();
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$crud = new crud();
$mensaje = '';
if (isset($_SESSION['mensaje_crud'])) {
    $mensaje = $crud->mensajesCrud($_SESSION['mensaje_crud']);
    unset($_SESSION['mensaje_crud']);
}
include "../header.php";
// Verificar si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
if ($mensaje != '') {
    echo "<script>
document.addEventListener('DOMContentLoaded', function() {
" . $mensaje . "
});
</script>";
}
?>

<body class="body_miscelaneos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <h1 class="mb-4 text-center">Notificaciones</h1> <!-- Encabezado de título -->
                        <div class="d-flex justify-content-between mb-2"> <!-- Contenedor para los botones -->
                            <a href="./index.php" class="btn btn-outline-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                                    <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                                    <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                </svg> Menú Principal</a>
                            <select id="filter" class="form-select" style="width: 150px">
                                <option value="">Filtro</option>
                                <option value="">Todos</option>
                                <option value="uso">Uso</option>
                                <option value="mantenimiento">Mantenimiento</option>
                                <option value="disponible">Disponible</option>
                            </select>
                        </div>
                        <div class="main-content-miscelaneos">
                            <input type="text" id="search" class="form-control mb-4" placeholder="Buscar por nombre...">
                            <?php
                            // Array para almacenar los registros de misceláneos
                            $miscelaneos = iterator_to_array($crud->mostrarDatosMaquinariaVista());
                            // Función para generar el HTML de cada elemento de la lista
                            function generarListItem($item)
                            {

                                echo '<div class="list-item-miscelaneos row" data-name="' . $item->nombre . ', ' . $item->estatus . '">'; // Añade la clase 'row' de Bootstrap
                                echo '<div class="col-4">'; // Crea una columna para la imagen que ocupa el 30% del ancho
                                if (isset($item->imagen)) {
                                    echo '<img class="miscelaneo-img img-fluid" src="' . $item->imagen . '" alt="Imagen de miscelaneo">'; // Añade la clase 'img-fluid' de Bootstrap para hacer la imagen responsive
                                } else {
                                    echo '<img class="miscelaneo-img img-fluid" src="..\public\img\Lovepik_com-611647791-Mobile phone product login interface.png" alt="Imagen de maquinaria">';
                                }
                                echo '</div>'; // Cierra la columna de la imagen
                                echo '<div class="col-8 d-flex flex-column">'; // Crea una columna para la información que ocupa el 70% del ancho
                                echo '<div>'; // Contenedor para el contenido

                                if (isset($item->nombre)) {
                                    echo '<h2>' . $item->nombre . '</h2>';
                                } else {
                                    echo '<h2>Nombre no disponible</h2>';
                                }
                                if (isset($item->ubicacion)) {
                                    echo '<p> Ubicacion: ' . $item->ubicacion . '</p>';
                                } else {
                                    echo '<p>Descripción no disponible</p>';
                                }
                                if ($item->peso == 'maquinaria_pesada') {
                                    echo '<p>Categoria: Maquinaria pesada</p>';
                                } elseif ($item->peso == 'equipo_pesado') {
                                    echo '<p>Categoria: Equipo pesado</p>';
                                } else {
                                    echo '<p>Categoria: Vehiculo</p>';
                                }
                                if ($item->estatus == "disponible") {
                                    echo '<p> Estatus: Requiere Mantenimiento</p>';
                                } else {
                                    echo '<p> Estatus: ' . $item->estatus . '</p>';
                                }
                                if (isset($item->fechaCulminacion)) {
                                    echo '<p> Culminacion de asignacion: ' . $item->fechaCulminacion . '</p>';
                                }
                                echo '</div>'; // Cierra el contenedor para el contenido
                                echo '<div class="mt-auto d-flex justify-content-end">'; // Contenedor para los botones
                                if ($item->estatus == "Mantenimiento") {
                                    echo '<form id="formMantenimiento" method="POST" action="../procesos/liberarMaquinariaNoti.php">';
                                    echo '<input type="hidden" name="id" value="' . $item->_id . '">';
                                    echo '<input type="hidden" class="form-control" id="estatus" name="estatus" value="disponible">';
                                    echo '<button type="submit" class="btn btn-outline-success margenBoton me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
<path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
</svg> Terminar Mantenimiento</button>';
                                } elseif ($item->estatus == "uso") {

                                    echo '<form id="formTerminar" method="POST" action="../procesos/liberarMaquinaria.php">';
                                    echo '<input type="hidden" name="id" value="' . $item->_id . '">';
                                    echo '<button type="submit" class="btn btn-outline-warning margenBoton me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
<path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
</svg> Terminar Uso</button>';
                                    echo '</form>';
                                } else {

                                    echo '</form>';
                                    echo '<form id="" method="POST" action="./asignarMaquinaria.php">';
                                    echo '<input type="hidden" name="id" value="' . $item->_id . '">';
                                    echo '<input type="hidden" class="form-control" id="estatus" name="estatus" value="">';
                                    echo '<button type="submit" class="btn btn-outline-warning margenBoton me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-bottom" viewBox="0 0 16 16">
<path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2z"/>
</svg> Asignar</button>';
                                    echo '</form>';
                                }
                                // Botón de eliminar                               
                                echo '</div>'; // Cierra el contenedor de los botones
                                echo '</div>'; // Cierra la columna de la información
                                echo '</div>'; // Cierra el div de la lista

                            }
                            echo '<div class="list-container-miscelaneos">';
                            foreach ($miscelaneos as $item) {
                                $fechaTimestampmant = strtotime($item->Fecha_mantenimiento);
                                // Suma $periodo_mantenimiento meses a la fecha
                                $fechaTimestampmant = strtotime("+" . $item->tiempo_mantenimiento . " months", $fechaTimestampmant);
                                $fechaTimestampUso = strtotime($item->fechaCulminacion);
                                $ahoraTimestamp = strtotime(date("Y-m-d"));

                                if ($fechaTimestampmant <= $ahoraTimestamp || ($fechaTimestampUso !== false && $fechaTimestampUso <= $ahoraTimestamp)) {
                                    generarListItem($item);
                                }
                            }
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    // Obtén la barra de búsqueda y los elementos de la lista
    var search = document.getElementById('search');
    var items = document.getElementsByClassName('list-item-miscelaneos');
    var filter = document.getElementById('filter');

    function applyFilters() {
        // Obtén el texto de búsqueda en minúsculas
        var searchText = search.value.toLowerCase();
        var filterText = filter.value.toLowerCase();

        // Itera sobre cada elemento de la lista
        for (var i = 0; i < items.length; i++) {
            // Obtén el nombre del elemento en minúsculas
            var itemName = items[i].getAttribute('data-name').toLowerCase();

            // Si el texto de búsqueda y el texto del filtro están en el nombre del elemento, muestra el elemento, de lo contrario, ocúltalo
            if (itemName.includes(searchText) && itemName.includes(filterText)) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
    // Agrega un controlador de eventos 'input' a la barra de búsqueda y al filtro
    search.addEventListener('input', applyFilters);
    filter.addEventListener('input', applyFilters);


    //Funcionalidad del boton mantenimiento (cuando esta disponible)
    document.getElementById('formMantenimiento').addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;
        swal({
            title: "¿A terminado el mantenimiento a este activo?",
            text: "",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "¡Sí!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            }
        }).then((value) => {
            if (value) {
                form.submit();
            }
        });
    });
    document.getElementById('formTerminar').addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;
        swal({
            title: "¿A Culminado el Uso de este Activo?",
            text: "",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "¡Sí!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            }
        }).then((value) => {
            if (value) {
                form.submit();
            }
        });
    });

    document.getElementById('formDisponible').addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;
        swal({
            title: "¿Iniciar el mantenimiento a este activo?",
            text: "",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "¡Sí!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            }
        }).then((value) => {
            if (value) {
                form.submit();
            }
        });
    });
</script>
<?php include "../scripts.php"; ?>