<?php session_start();
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
include "../header.php";
// Verificar si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
// Crear una nueva instancia de la clase crud
$crud = new crud();

// Obtener el ID del misceláneo de la URL
$id = $_GET['id'];

// Usar la función obtenerDocumentoMiscelaneo para obtener los datos del misceláneo
$miscelaneo = $crud->obtenerDocumentoMaquinaria($id);
?>

<body class="body_miscelaneos">
    <div class="container ">
        <div class="row ">
            <div class="col">
                <div class="card mt-4 shadow ">
                    <div class="card-body ">
                        <div class="container ">
                            <div class="row">
                                <div class="col">
                                    <div class="card mt-4 shadow">
                                        <div class="card-body">
                                            <?php
                                            if ($miscelaneo) {
                                                echo '<div class="d-flex justify-content-between align-items-center">';
                                                echo '<a href="./maquinaria.php" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-btn" viewBox="0 0 16 16">
                                                <path d="M11.21 5.093A.5.5 0 0 1 12 5.5v5a.5.5 0 0 1-.79.407L8.5 8.972V10.5a.5.5 0 0 1-.79.407L5 8.972V10.5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 1 0v1.528l2.71-1.935a.5.5 0 0 1 .79.407v1.528z" />
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                            </svg> Regresar</a>';
                                                echo '<h1>' . $miscelaneo->nombre . '</h1>';

                                                echo '</div>';
                                                echo '<hr>';
                                                // Mostrar los datos en un formulario
                                                echo '<div class="row">'; // Contenedor para las dos columnas
                                                echo '<div class="col-md-6">'; // Primera columna
                                                // Aquí van los primeros cuatro campos
                                                echo '<h3>Modelo: ' . $miscelaneo->modelo . '</h3>';
                                                echo '<hr>';
                                                echo '<h3>Ubicación: ' . $miscelaneo->ubicacion . '</h3>';
                                                echo '<hr>';
                                                echo '<h3>Marca: ' . $miscelaneo->marca . '</h3>';
                                                echo '<hr>';
                                                echo '<h3>Estatus: ' . $miscelaneo->estatus . '</h3>';
                                                echo '<hr>';
                                                echo '<h3>Tipo: ' . $miscelaneo->tipo . '</h3>';
                                                echo '<hr>';
                                                echo '<h3>Año: ' . $miscelaneo->año . '</h3>';
                                                echo '<hr>';
                                                echo '<h3>Placa: ' . $miscelaneo->placa . '</h3>';
                                                echo '<hr>';
                                                if ($miscelaneo->peso == 'maquinaria_pesada') {
                                                    echo '<h3>Categoria: Maquinaria pesada</h3>';
                                                } elseif ($miscelaneo->peso == 'equipo_pesado') {
                                                    echo '<h3>Categoria: Equipo pesado</h3>';
                                                } else {
                                                    echo '<h3>Categoria: Vehiculo</h3>';
                                                }
                                                echo '<hr>';
                                                echo '<h3>Periodo de mantenimiento: ' . $miscelaneo->tiempo_mantenimiento . ' meses</h3>';
                                                echo '<hr>';
                                                echo '<h3>Ultimo mantenimiento: ' . $miscelaneo->Fecha_mantenimiento . '</h3>';
                                                if (isset($miscelaneo->fechaCulminacion)) {
                                                    echo '<hr>';
                                                    echo '<h3>Culminacion de Asignacion: ' . $miscelaneo->fechaCulminacion . '</h3>';
                                                }
                                                if (isset($miscelaneo->editado)) {
                                                    echo '<hr>';
                                                    echo '<h3>Editado por: ' . $miscelaneo->editado . '</h3>';
                                                }
                                                echo '</div>'; // Fin de la primera columna
                                                echo '<div class="col-md-6 d-flex justify-content-end "style="max-height: 300px; overflow-y: auto;">'; // Segunda columna
                                                // Aquí va la imagen
                                                echo '<img src="' . $miscelaneo->imagen . '" class="img-fluid test "style="max-width: 100%; height: auto;">';
                                                echo '</div>'; // Fin de la segunda columna
                                                echo '</div>'; // Fin del contenedor de las dos columnas
                                                if (!$_SESSION['visualizacion']) {
                                                    echo '<div class="d-flex justify-content-end">'; // Contenedor para los botones

                                                    echo '<form id="formEditar" method="POST" action="./actualizarMaquinaria.php">';
                                                    echo '<input type="hidden" name="id" value="' . $miscelaneo->_id . '">';
                                                    echo '<button type="submit" class="btn btn-outline-warning margenBoton m-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                  </svg> Editar</button>';
                                                    echo '</form>';
                                                    // Botón de editar
                                                    echo '<form id="formEliminar" method="POST" action="../procesos/eliminarMaquinaria.php">';
                                                    echo '<input type="hidden" name="id" value="' . $miscelaneo->_id . '">';
                                                    echo '<button type="submit" class="btn btn-outline-danger margenBoton m-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                  </svg> Eliminar</button>';
                                                    echo '</form>';

                                                    if (isset($miscelaneo->mantenimientos)) {
                                                        echo '<div class="d-flex justify-content-end">'; // Contenedor para los botones

                                                        echo '<form id="formEditar" method="POST" action="./verMantenimientos.php">';
                                                        echo '<input type="hidden" name="id" value="' . $miscelaneo->_id . '">';
                                                        echo '<button type="submit" class="btn btn-outline-dark margenBoton m-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                                      </svg> Ver registro de mantenimiento</button>';
                                                        echo '</form>';
                                                    }

                                                    echo '</div>'; // Cierra el contenedor de los botones
                                                }
                                            } else {
                                                echo 'No se pudo obtener los datos del misceláneo.';
                                            }
                                            ?>
                                            <script>
                                                function goBack() {
                                                    window.history.back();
                                                }
                                            </script>
                                            <script>
                                                document.getElementById('formEliminar').addEventListener('submit', function(e) {
                                                    e.preventDefault();
                                                    var form = this;
                                                    swal({
                                                        title: "¿Estás seguro?",
                                                        text: "¡No podrás revertir esto!",
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
                                                                text: "¡Sí, bórralo!",
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include "../scripts.php"; ?>