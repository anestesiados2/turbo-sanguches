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
    <title>Checkout</title>
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/checkout.css">
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/about.css"> <!-- Estilos específicos para el checkout -->
    <link rel="stylesheet" href="/TURBOSANGUCHES/CSS/navbar.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main>
        <h1>Confirma Tu Compra</h1>
        <form id="checkout-form">
            <fieldset>
                <legend>Datos Del Comprador</legend>
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="form-group">
                    <label for="phone">Teléfono:</label>
                    <div class="phone-input-container">
                        <select id="country-code" name="country-code">
                            <option value="+54" data-flag="ar">🇦🇷 +54 Argentina</option>
                            <option value="+1" data-flag="us">🇺🇸 +1 USA</option>
                            <option value="+44" data-flag="gb">🇬🇧 +44 UK</option>
                            <option value="+34" data-flag="es">🇪🇸 +34 España</option>
                            <option value="+33" data-flag="fr">🇫🇷 +33 Francia</option>
                            <!-- Agrega más opciones aquí -->
                        </select>
                        <input type="tel" id="phone" name="phone" placeholder="Ingrese su número" pattern="[+][0-9]{1,3}[0-9]{10,13}" maxlength="15" required>
                    </div>
                </div>
                
                
                </div>

                <div class="form-group">
                    <label for="card-number">Número de Tarjeta:</label>
                    <input type="text" id="card-number" name="card-number" pattern="\d{4} \d{4} \d{4} \d{4}" maxlength="19" placeholder="1234 5678 9012 3456" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="expiry-date">Fecha de Expiración:</label>
                    <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/AA" pattern="\d{2}/\d{2}" maxlength="5" required>
                </div>

                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" pattern="\d{3}" maxlength="3" required>
                </div>

                <button type="submit">Finalizar Compra</button>
            </fieldset>
        </form>

        <!-- Modal de confirmación -->
        <div id="confirmation-modal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>¡Compra realizada con éxito!</h2>
                <p>Gracias por tu compra. Tu pedido ha sido recibido y está siendo procesado.</p>
            </div>
        </div>
    </main>

    <script src="../JS/checkout.js"></script> <!-- Archivo JS específico para el checkout -->

    <?php include 'footerClient.php'; ?>
</body>
</html>
