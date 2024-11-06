<?php
session_start();
include '../Conexion.php';

// Seleccionar todos los mensajes y unir con la tabla usuarios para obtener el email
$sql = "SELECT m.id, m.nombre, m.mensaje, u.email FROM mensajes m JOIN usuarios u ON m.usuario_id = u.id";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensajes Recibidos</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/styles.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/mensajes.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navadmin.css">
</head>
<body>
    <header>
        <?php include 'navbar-admin.php'; ?>
    </header>
    <section class="messages-section">
        <div class="messages-container">
            <h1>Mensajes Recibidos</h1>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='mensaje' id='mensaje-".$row['id']."'>";
                    echo "<h3 class='mensaje-nombre'>" . htmlspecialchars($row['nombre']) . " (" . htmlspecialchars($row['email']) . ")</h3>";
                    echo "<p class='mensaje-texto'>" . htmlspecialchars($row['mensaje']) . "</p>";
                    echo "<button class='delete-button' onclick='confirmDelete(".$row['id'].")'>Eliminar</button>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-mensajes'>No hay mensajes.</p>";
            }
            ?>
        </div>
    </section>
    <script>
        function confirmDelete(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este mensaje?")) {
                window.location.href = "eliminar-mensaje.php?id=" + id;
            }
        }
        document.querySelectorAll('.mensaje-texto').forEach(function(element) {
            element.style.wordBreak = 'break-word';
        });
    </script>
</body>
</html>
