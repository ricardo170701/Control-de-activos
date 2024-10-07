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
                <div class="card mt-4">
                    <div class="card-body">
                        <h1 class="mb-4 text-center">Miscelaneos</h1> <!-- Encabezado de título -->
                        <div class="d-flex justify-content-between mb-2"> <!-- Contenedor para los botones -->
                            <a href="./index.php" class="btn btn-outline-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                                    <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                                    <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                </svg> Menú Principal</a>
                            <?php
                            if (!$_SESSION['visualizacion']) {
                                echo '<a href="./agregarMiscelaneos.php" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                </svg> Agregar Miscelaneo</a>';
                            }
                            ?>
                        </div>
                        <div class="main-content-miscelaneos">
                            <input type="text" id="search" class="form-control mb-4" placeholder="Buscar por nombre...">
                            <?php
                            // Array para almacenar los registros de misceláneos
                            $miscelaneos = iterator_to_array($crud->mostrarDatosMiscelaneos());
                            // Función para generar el HTML de cada elemento de la lista
                            function generarListItem($item)
                            {
                                echo '<div class="list-item-miscelaneos row" data-name="' . $item->nombre . '">'; // Añade la clase 'row' de Bootstrap
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
                                if (isset($item->modelo)) {
                                    echo '<p> Modelo: ' . $item->modelo . '</p>';
                                } else {
                                    echo '<p>Descripción no disponible</p>';
                                }
                                if (isset($item->marca)) {
                                    echo '<p> Marca: ' . $item->marca . '</p>';
                                } else {
                                    echo '<p>Descripción no disponible</p>';
                                }
                                if (isset($item->cantidad)) {
                                    echo '<p> Cantidad: ' . $item->cantidad . '</p>';
                                } else {
                                    echo '<p>Descripción no disponible</p>';
                                }

                                echo '</div>'; // Cierra el contenedor para el contenido

                                echo '<div class="mt-auto d-flex justify-content-end">'; // Contenedor para los botones
                                echo '<a href="./verMiscelaneo.php?id=' . $item->_id . '" class="btn btn-outline-primary margenBoton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                              </svg> Ver más</a>';  // Botón de eliminar
                                echo '</div>'; // Cierra el contenedor de los botones

                                echo '</div>'; // Cierra la columna de la información
                                echo '</div>'; // Cierra el div de la lista
                            }



                            // Generar el HTML de la lista
                            echo '<div class="list-container-miscelaneos">';
                            foreach ($miscelaneos as $item) {
                                generarListItem($item);
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

    // Agrega un controlador de eventos 'input' a la barra de búsqueda
    search.addEventListener('input', function() {
        // Obtén el texto de búsqueda en minúsculas
        var searchText = search.value.toLowerCase();

        // Itera sobre cada elemento de la lista
        for (var i = 0; i < items.length; i++) {
            // Obtén el nombre del elemento en minúsculas
            var itemName = items[i].getAttribute('data-name').toLowerCase();

            // Si el texto de búsqueda está en el nombre del elemento, muestra el elemento, de lo contrario, ocúltalo
            if (itemName.includes(searchText)) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    });
</script>
<?php include "../scripts.php"; ?>