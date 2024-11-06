<?php
session_start();
include '../Conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header("Location: loginC.php");
    exit();
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
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, 'admin')");
        $stmt->bind_param("sss", $nombre, $email, $contraseña);

        if ($stmt->execute()) {
            $error = "Admin registrado exitosamente.";
        } else {
            $error = "Error al registrar el admin: " . $stmt->error;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Admin</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/regadmin.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navadmin.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/styles.css">
</head>
<body>
    <header>
        <?php include 'navbar-admin.php'; ?>
    </header>
    <section>
        <main>
            <form method="POST" action="registrar-admin.php" class="register-form">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <button type="submit" class="btn">Registrar Admin</button>
            </form>
            <?php if (!empty($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
        </main>
    </section>
</body>
</html>
