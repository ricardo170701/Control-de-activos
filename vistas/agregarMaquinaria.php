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
<?php include "../header.php"; ?>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <a href="./maquinaria.php" class="btn btn-outline-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                        </svg> Regresar
                    </a>
                    <h2>Agregar Nueva Maquinaria</h2>
                    <form action="../procesos/insertarMaquinaria.php" method="post" enctype="multipart/form-data">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                        <label for="ubicacion">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" required>

                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                        <label for="tipo">Tipo</label>
                        <input type="text" id="tipo" class="form-control" name="tipo" required>
                        <label for="año">Año</label>
                        <input type="text" class="form-control" id="año" name="año" required>
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" required>
                        <label for="peso">Categoria</label>
                        <select id="peso" class="form-control" name="peso" required>
                            <option value="" disabled selected>Selecciona una opcion</option>
                            <option value="maquinaria_pesada">Maquinaria Pesada</option>
                            <option value="vehiculos">Vehiculos</option>
                            <option value="equipo_pesado">Equipo Pesado</option>

                        </select>
                        <label for="tiempo_mantenimiento">Periodo de Mantenimiento (En Meses)</label>
                        <input type="number" class="form-control" id="tiempo_mantenimiento" name="tiempo_mantenimiento" min="0" step="1" required>

                        <label for="Fecha_mantenimiento">Fecha del Ultimo Mantenimiento</label>
                        <input type="date" class="form-control" id="Fecha_mantenimiento" name="Fecha_mantenimiento" required>
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" required>



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