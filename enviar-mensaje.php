<?php
session_start();
include '../Conexion.php'; // Conexión a la base de datos

if (!isset($_SESSION['usuario_id'])) {
    header("Location: loginC.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $mensaje = $_POST['mensaje'];
    $usuario_id = $_SESSION['usuario_id']; // Asegúrate de que la sesión contiene usuario_id

    // Insertar en la base de datos
    $sql = "INSERT INTO mensajes (nombre, mensaje, usuario_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $mensaje, $usuario_id);

    if ($stmt->execute()) {
        $_SESSION['mensaje_exito'] = "Mensaje enviado con éxito.";
    } else {
        $_SESSION['mensaje_exito'] = "Error al enviar el mensaje.";
    }

    $stmt->close();
}
$conn->close();
header("Location: contact.php"); // Redirigir de vuelta a la página de contacto
exit();
?>
