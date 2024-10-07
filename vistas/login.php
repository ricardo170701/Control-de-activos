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

?>

<body class="login-page">
<div class="login-container">
        <div class="login-form">
            <h1>Bienvenido a Paldaca</h1>
            <form action="../procesos/autenticar.php" method="post">
                <input type="correo" name="correo" placeholder="Nombre de usuario">
                <input type="correo" name="password" placeholder="Contraseña">
                <div class="button-container">
                    <input type="submit" value="Iniciar sesión">
                </div>
            </form>
            <?php 
            echo "<script>console.log('".$mensaje."')</script>";
            if ($mensaje != '') {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    ".$mensaje."
                });
                </script>";
            }
            ?>
        </div>
        <div class="image-container">
            <img src="../public//img//Lovepik_com-611647791-Mobile phone product login interface.png" alt="Imagen">
        </div>
    </div>

</body>

<?php include "../scripts.php"; ?>
