<?php
// Iniciar la sesión
session_start();
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$crud = new crud();
$mensaje = '';
if (isset($_SESSION['mensaje_crud'])) {
    $mensaje = $crud->mensajesCrud($_SESSION['mensaje_crud']);
    unset($_SESSION['mensaje_crud']);
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: login.php');
    exit;
}
?>

<?php include "../header.php";
if ($mensaje != '') {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
    " . $mensaje . "
    });
    </script>";
} ?>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <a href="./verUser.php" class="btn btn-outline-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                        </svg> Regresar

                    </a>
                    <h2>Agregar nuevo registro</h2>
                    <form action="../procesos/insertar.php" method="post">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                        <label for="correo">Correo</label>
                        <input type="text" class="form-control" id="correo" name="correo" required>
                        <label for="fechaRegistro">Fecha de Registro</label>
                        <input type="text" class="form-control" id="fechaRegistro" name="fechaRegistro" value=" <?php date_default_timezone_set('America/Caracas');
                                                                                                                $fecha_actual = date("Y-m-d");
                                                                                                                echo $fecha_actual; ?>" readonly>
                        <label for="cargo">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" required>
                        <label for="nivel">Nivel</label>
                        <select id="nivel" class="form-control" name="nivel" required>
                            <option value="" disabled selected>Selecciona un Nivel</option>
                            <option value="0">Usuario Medio</option>
                            <option value="1">Solo Visualizacion</option>
                            <option value="2">Administrador</option>
                        </select>

                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control" id="password" name="password" required>



                        <button class="btn btn-primary mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                                <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                                <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                            </svg> Agregar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "../scripts.php"; ?>