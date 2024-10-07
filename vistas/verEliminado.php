<?php session_start();
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$crud = new crud();
$datos = $crud->mostrarDatosEliminados();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ./login.php');
    exit;
}
?>
<?php include "../header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-body">
                    <h2>Visualizador de Eliminados</h2>
                    <a href="./index.php" class="btn btn-outline-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                        </svg> Menu Principal
                    </a>
                    <hr>
                    <table id="miTabla" class="table table-sm table-hover">
                        <thead>
                            <tr>

                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Fecha de Eliminacion</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($datos as $item) {
                            ?>
                                <tr>

                                    <td> <?php echo $item->nombre; ?> </td>
                                    <td> <?php echo $item->tipo; ?> </td>
                                    <td> <?php echo $item->fechaEliminacion; ?> </td>
                                    <td> <?php echo $item->responsable; ?> </td>
                                </tr>
                            <?php } ?>
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
                                }
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "../scripts.php"; ?>