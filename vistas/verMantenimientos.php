<?php session_start();
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$crud = new crud();
$datos = $crud->mostrarDatosMaquinariaVista();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ./login.php');
    exit;
}
$id = $_POST['id'];
$mantenimiento = $crud->obtenerDocumentoMaquinaria($id);
?>
<?php include "../header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-body">
                    <?php
                    echo '<div class="d-flex align-items-center justify-content-between">'; // Contenedor flexbox
                    echo '<a href="./verMaquinaria.php?id=' . $mantenimiento->_id . '" class="btn btn-outline-primary margenBoton">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-btn" viewBox="0 0 16 16">
<path d="M11.21 5.093A.5.5 0 0 1 12 5.5v5a.5.5 0 0 1-.79.407L8.5 8.972V10.5a.5.5 0 0 1-.79.407L5 8.972V10.5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 1 0v1.528l2.71-1.935a.5.5 0 0 1 .79.407v1.528z" />
<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
</svg> Regresar
</a>';
                    echo '<h2>Visualizador de Mantenimientos </h2>';
                    echo '</div>'; // Fin del contenedor flexbox
                    ?>


                    <h2> <?Php echo $mantenimiento->nombre; ?></h2>

                    <hr>
                    <table id="miTabla" class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Fecha Mantenimiento</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($mantenimiento->mantenimientos as $mantenimientos) {
                            ?>
                                <tr>
                                    <td> <?php echo $mantenimientos->Fecha_mantenimiento; ?> </td>
                                    <td> <?php echo $mantenimientos->descripcion; ?> </td>
                                </tr>
                            <?php
                            }

                            ?>
                        </tbody>
                    </table>


                    <script>
                        var table;
                        $(document).ready(function() {
                            var table = $('#miTabla').DataTable({
                                "pageLength": 10,
                                "language": {
                                    "decimal": "",
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Entradas",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscar:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "columns": [{
                                        "width": "30%"
                                    }, // Ancho de la primera columna
                                    {
                                        "width": "70%"
                                    } // Ancho de la segunda columna
                                ]
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "../scripts.php"; ?>