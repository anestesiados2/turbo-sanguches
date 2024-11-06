<?php
session_start();
include '../Conexion.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    // Prepara la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verifica la contraseña
        if (password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['rol'] = $usuario['rol'];

            // Redirige según el rol del usuario
            if ($usuario['rol'] == 'admin') {
                header("Location: admin-index.php"); // Redirigir a la página de administración
            } else {
                header("Location: index.php"); // Redirigir a la página de cliente
            }
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No se encontró el usuario.";
    }

    // Cierra la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../CSS/LoginForm.css">
    <script>
        function showError(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <h1>Iniciar Sesión</h1>
        <form method="POST" action="loginC.php">
            <div class="input-box">
                <input type="email" name="email" required placeholder="Email">
                <span class="icon"></span>
            </div>
            <div class="input-box">
                <input type="password" name="contraseña" required placeholder="Contraseña">
                <span class="icon"></span>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
        <div class="register-link">
            <p>¿No tienes cuenta? <a href="registroC.php">Regístrate aquí</a></p>
        </div>
        <?php
        if (!empty($error)) {
            echo "<script>showError('$error');</script>";
        }
        ?>
    </div>
</body>
</html>
