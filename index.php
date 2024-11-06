<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: loginC.php");
    exit();
}

include '../Conexion.php'; // Conexión a la base de datos

// Obtener los productos de la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Explora nuestra deliciosa variedad de sándwiches." />
    <title>TurboSanguches</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/styles.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navbar.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main>
    <section id="principal">
    <div id="tarjetasContainer">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='sandwich-container'>";
                echo "<div class='sandwich-frame producto' data-price='" . $row['precio'] . "'>";
                echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "'>";
                echo "<p>" . $row['nombre'] . "</p>";
                echo "<p>$" . number_format($row['precio'], 2) . "</p>";
                echo "<button class='add-to-cart'>Agregar al Carrito</button>";
                echo "</div></div>";
            }
        } else {
            echo "<p>No hay productos disponibles.</p>";
        }
        ?>
    </main>

    <section class="cart">
        <button class="cart-toggle" aria-label="Abrir/Cerrar Carrito">🛒</button>
        <div class="cart-content">
            <h2>Carrito de Compras</h2>
            <ul id="cart-items"></ul>
            <p>Total Gastado: $<span id="total">0.00</span></p>
            <button class="clear-cart">Eliminar Seleccionados</button>
            <button class="confirm-purchase">Confirmar Compra</button>
        </div>
    </section>


    <script src="../js/script.js"></script>


    <?php include 'footerClient.php'; ?>
</body>
</html>
