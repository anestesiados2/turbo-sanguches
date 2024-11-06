<?php
$servername = "localhost"; // Cambia esto si es necesario
$username = "root"; // Tu nombre de usuario
$password = ""; // Tu contraseña
$dbname = "turbo_sanguches"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

