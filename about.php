<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: loginC.php");
    exit();
}
?>

<!
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conoce más sobre nuestro emprendimiento, nuestra historia, misión y equipo dedicado a ofrecer los mejores sándwiches.">
    <title>Sobre Nosotros</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/about.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navbar.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main>
        <section class="intro">
            <h1>Sobre Nosotros</h1>
            <p>Somos un emprendimiento dedicado a ofrecer los mejores sándwiches. Nuestra pasión por la calidad y el sabor se refleja en cada uno de nuestros productos.</p>
        </section>
        
        <section class="about">
            <div class="about-text">
                <h2>Nuestra Historia</h2>
                <p>Fundado en el año 2024, comenzamos con la misión de crear sándwiches frescos y deliciosos utilizando ingredientes locales y de alta calidad.</p>
                <h2>Nuestra Misión</h2>
                <p>Brindar a nuestros clientes una experiencia culinaria única con cada bocado, mientras mantenemos nuestro compromiso con la sostenibilidad y el servicio al cliente.</p>
            </div>
            <div class="about-image">
                <img src="equipo.jpg" alt="Nuestro equipo trabajando con pasión">
            </div>
        </section>

        <section class="call-to-action">
            <h2>¡Síguenos en Redes Sociales!</h2>
            <p>¡Mantente al tanto de nuestras últimas noticias y ofertas especiales!</p>
            <a href="https://facebook.com" class="social-link" target="_blank" rel="noopener noreferrer">Facebook</a>
            <a href="https://www.instagram.com/turbosanguches" class="social-link" target="_blank" rel="noopener noreferrer">Instagram</a>
        </section>
    </main>


    <?php include 'footerClient.php'; ?>
</body>
</html>
