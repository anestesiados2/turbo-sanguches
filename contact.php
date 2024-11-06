<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: loginC.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/contact.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navbar.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main>
        <h1>Contáctanos</h1>
        <form action="enviar-mensaje.php" method="post" class="contact-form">
            <label for="nombre">Nombre/s:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>
            
            <button type="submit" class="btn">Enviar</button>
        </form>
    </main>
    <?php include 'footerClient.php'; ?>

    <?php if (isset($_SESSION['mensaje_exito'])): ?>
        <script>
            alert('<?php echo $_SESSION['mensaje_exito']; ?>');
            <?php unset($_SESSION['mensaje_exito']); ?>
        </script>
    <?php endif; ?>
</body>
</html>
