<?php
session_start();
include '../Conexion.php'; // Conexión a la base de datos

// Verificar si el usuario ha iniciado sesión y es administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header("Location: loginC.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];
    $ruta_imagen = '../img/' . basename($imagen); // Define la ruta donde se guardará la imagen

    // Mover la imagen a la carpeta deseada
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        // Insertar en la base de datos
        $sql = "INSERT INTO productos (nombre, precio, imagen) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sds", $nombre, $precio, $ruta_imagen);
        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error al añadir el producto.";
        }
        $stmt->close();
    } else {
        echo "Error al subir la imagen.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navadmin.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/styles.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/agregarprod.css">
</head>
<body>
    <header>
            <?php include 'navbar-admin.php'; ?>
    </header>

    <section>
        <div class="container">
            <h1>Agregar Producto</h1>
            <form action="agregar-productos.php" method="post" enctype="multipart/form-data" class="form">
                <label for="nombre">Nombre del producto:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" required>
                
                <label for="imagen">Imagen del producto:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
                
                <button type="submit" class="btn">Añadir Producto</button>
            </form>
    </section>

    </div>
</body>
</html>
