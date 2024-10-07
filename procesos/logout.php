<?php
// Inicia la sesión
session_start();

// Verifica si el botón de cerrar sesión ha sido presionado
if (isset($_POST['cerrar_sesion'])) {
    // Destruye la sesión
    session_destroy();

    // Redirige al usuario a la página de inicio de sesión
    header("Location: ..\\..\\vistas\\login.php");
    exit();
}
?>