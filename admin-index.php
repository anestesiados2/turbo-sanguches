<?php
session_start();
include '../Conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header("Location: loginC.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navadmin.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/styles.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/adminStyles.css">
</head>
<body>
    <header>
        <?php include 'navbar-admin.php'; ?>
    </header>
    <section>
        
    </section>
    <h1 class="title">Bienvenido, Administrador</h1>
    <div class="admin-options">
        <a href="agregar-productos.php" class="btn">Agregar Producto</a>
        <a href="eliminar-prod.php" class="btn">Eliminar Producto</a>
        <a href="registrar-admin.php" class="btn">Registrar Nuevo Admin</a>
        <a href="ver-mensajes.php" class="btn">Ver Mensajes Disponibles</a>
    </div>
</body>
</html>
