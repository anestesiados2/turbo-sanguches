<?php 
session_start();
include '../Conexion.php';

// Verifica si el usuario es admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header("Location: loginC.php");
    exit();
}

// Verifica que la conexión esté abierta
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar producto si se ha especificado
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Producto eliminado exitosamente.";
        } else {
            echo "Error al eliminar el producto: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
}

// Obtener todos los productos
$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

if (!$resultado) {
    echo "Error al obtener productos: " . $conn->error;
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Productos</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navadmin.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/styles.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/styles-elim.css">
</head>
<body>
    <header>
        <?php include 'navbar-admin.php'; ?>
    </header>
    

    <div class="eliminar-productos">
        <h1>Eliminar Productos</h1>
        <div class="producto-container">
            <?php while ($producto = $resultado->fetch_assoc()): ?>
                <div class="producto">
                    <img src="../img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen del producto">
                    <p><?php echo htmlspecialchars($producto['nombre']); ?></p>
                    <p>$<?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?></p>
                    <a href="eliminar-prod.php?eliminar=<?php echo htmlspecialchars($producto['id']); ?>" class="boton-eliminar">Eliminar</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
