<?php
session_start();
include '../Conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header("Location: loginC.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM mensajes WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Mensaje eliminado con éxito.";
    } else {
        echo "Error al eliminar el mensaje.";
    }

    $stmt->close();
}
$conn->close();
header("Location: ver-mensajes.php"); // Redirigir de vuelta a la página de mensajes
exit();
?>
