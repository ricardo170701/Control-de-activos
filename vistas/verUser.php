<?php session_start();
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$crud = new crud();
$datos = $crud->mostrarDatos();

$mensaje = '';

if (isset($_SESSION['mensaje_crud'])) {
    $mensaje = $crud->mensajesCrud($_SESSION['mensaje_crud']);

    unset($_SESSION['mensaje_crud']);
}


if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {

    header('Location: ./login.php');
    exit;
}

?>

<?php include "../header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <h2>Manejo de Usuarios</h2>

                    <a href="./index.php" class="btn btn-outline-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                        </svg> Menu Principal
                    </a>
                    <a href="./agregar.php" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                        </svg> Agregar nuevo registro
                    </a>
                    <hr>
                    <table id="miTabla" class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Apellido</th>
                                <th>nombre</th>
                                <th>Correo</th>
                                <th>Fecha de Registro</th>
                                <th>Cargo</th>
                                <th>Nivel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($datos as $item) {
                            ?>
                                <tr>
                                    <td><input type="radio" name="selectedRow" value="<?php echo $item->_id ?>"></td>
                                    <td> <?php echo $item->apellido; ?> </td>
                                    <td> <?php echo $item->nombre; ?> </td>
                                    <td> <?php echo $item->correo; ?> </td>
                                    <td> <?php echo $item->fechaRegistro; ?> </td>
                                    <td> <?php echo $item->cargo; ?> </td>
                                    <td> <?php echo $item->nivel; ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div style="display: flex; justify-content: center;">
                        <button class="btn btn-warning" id="editButton" style="margin-right: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-exclamation" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            </svg> Editar</button>
                        <button class="btn btn-dark" id="changeButton" style="margin-right: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg> Cambiar Contraseña</button>
                        <button class="btn btn-danger" id="deleteButton" style="margin-right: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                            </svg> Eliminar</button>
                    </div>
                    <script>
                        var table;
                        $(document).ready(function() {
                            var table = $('#miTabla').DataTable({
                                "ordering": true, // Habilita el ordenamiento
                                "order": [
                                    [0, 'asc']
                                ],
                                "pageLength": 10,
                                "language": {
                                    "decimal": "",
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",

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
                        document.getElementById('deleteButton').addEventListener('click', function() {
                            // Obtener el botón de radio seleccionado
                            var selectedRow = document.querySelector('input[name="selectedRow"]:checked');

                            // Verificar si se seleccionó un botón de radio
                            if (selectedRow) {
                                var idToDelete = selectedRow.value;

                                // Crear un formulario
                                var form = document.createElement('form');
                                form.action = './eliminar.php';
                                form.method = 'POST';

                                // Crear un input oculto para el ID
                                var input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'id';
                                input.value = idToDelete;

                                // Añadir el input al formulario
                                form.appendChild(input);

                                // Añadir el formulario al body
                                document.body.appendChild(form);

                                // Enviar el formulario
                                form.submit();
                            } else {
                                // Mostrar un mensaje si no se seleccionó un botón de radio
                                alert('Por favor, selecciona un registro para eliminar.');
                            }

                        });
                        document.getElementById('editButton').addEventListener('click', function() {
                            // Obtener el botón de radio seleccionado
                            var selectedRow = document.querySelector('input[name="selectedRow"]:checked');

                            // Verificar si se seleccionó un botón de radio
                            if (selectedRow) {
                                var idToEdit = selectedRow.value;

                                // Crear un formulario
                                var form = document.createElement('form');
                                form.action = './actualizar.php';
                                form.method = 'POST';

                                // Crear un input oculto para el ID
                                var input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'id';
                                input.value = idToEdit;

                                // Añadir el input al formulario
                                form.appendChild(input);

                                // Añadir el formulario al body
                                document.body.appendChild(form);

                                // Enviar el formulario
                                form.submit();
                            } else {
                                // Mostrar un mensaje si no se seleccionó un botón de radio
                                alert('Por favor, selecciona un registro para editar.');
                            }
                        });
                        document.getElementById('changeButton').addEventListener('click', function() {
                            // Obtener el botón de radio seleccionado
                            var selectedRow = document.querySelector('input[name="selectedRow"]:checked');

                            // Verificar si se seleccionó un botón de radio
                            if (selectedRow) {
                                var idToChange = selectedRow.value;

                                // Crear un formulario
                                var form = document.createElement('form');
                                form.action = './recuperar.php';
                                form.method = 'POST';

                                // Crear un input oculto para el ID
                                var input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'id';
                                input.value = idToChange;

                                // Añadir el input al formulario
                                form.appendChild(input);

                                // Añadir el formulario al body
                                document.body.appendChild(form);

                                // Enviar el formulario
                                form.submit();
                            } else {
                                // Mostrar un mensaje si no se seleccionó un botón de radio
                                alert('Por favor, selecciona un registro para cambiar contraseña.');
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "../scripts.php"; ?>
<script>
    let mensaje = <?php echo $mensaje; ?>;
    console.log(mensaje);
</script>