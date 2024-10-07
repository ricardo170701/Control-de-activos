<?php
include "../clases/Conexion.php";
include "../clases/Crud.php";
include "../header.php";

$crud = new Crud();
$id = $_POST['id'];
$datos = $crud->obtenerDocumento($id);
?>
<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <a href="./verUser.php" class="btn btn-outline-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-btn" viewBox="0 0 16 16">
                            <path d="M11.21 5.093A.5.5 0 0 1 12 5.5v5a.5.5 0 0 1-.79.407L8.5 8.972V10.5a.5.5 0 0 1-.79.407L5 8.972V10.5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 1 0v1.528l2.71-1.935a.5.5 0 0 1 .79.407v1.528z" />
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                        </svg> Regresar
                    </a>
                    <h2>Eliminar registro</h2>
                    <table class="table table-bordered table-danger">
                        <thead>
                            <th>Apellido</th>
                            <th>nombre</th>
                            <th>Correo</th>
                            <th>Fecha de Registro</th>
                            <th>Cargo</th>
                            <th>Nivel</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <?php echo $datos->apellido; ?> </td>
                                <td> <?php echo $datos->nombre; ?> </td>
                                <td> <?php echo $datos->correo; ?> </td>
                                <td> <?php echo $datos->fechaRegistro; ?> </td>
                                <td> <?php echo $datos->cargo; ?> </td>
                                <td> <?php echo $datos->nivel; ?> </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="alert alert-danger" role="alert">
                        <p>¿Estas seguro de eliminar este registro?</p>
                        <p>Una vez eliminado no podra ser recuperado</p>
                    </div>
                    <form action="../procesos/eliminar.php" method="POST">
                        <input type="text" name="id" hidden value="<?php echo $datos->_id; ?>">
                        <button class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                            </svg> Eliminar
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include "../scripts.php"; ?>