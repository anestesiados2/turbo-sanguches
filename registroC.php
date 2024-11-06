<?php
session_start();
include '../Conexion.php'; // Asegúrate de que esta ruta sea correcta

// Verifica si la conexión fue exitosa
if (!$conn) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    // Verificar si el email ya existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Error: Usuario ya existente.";
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $contraseña);

        if ($stmt->execute()) {
            $_SESSION['usuario_id'] = $conn->insert_id; // Guarda el ID del nuevo usuario
            $_SESSION['rol'] = 'cliente'; // Asigna el rol por defecto
            header("Location: index.php"); // Redirige a index.php
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../CSS/LoginForm.css">
</head>
<body>
    <div class="wrapper">
        <h1>Registro</h1>
        <form method="POST" action="registroC.php">
            <div class="input-box">
                <input type="text" name="nombre" required placeholder="Nombre">
            </div>
            <div class="input-box">
                <input type="email" name="email" required placeholder="Email">
                <span class="icon"></span>
            </div>
            <div class="input-box">
                <input type="password" name="contraseña" required placeholder="Contraseña">
                <span class="icon"></span>
            </div>
            <button type="submit">Registrar</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="register-link">
            <p>¿Ya tienes cuenta? <a href="loginC.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>
