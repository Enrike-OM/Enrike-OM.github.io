<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control de Inventario</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    

    <?php include 'menu.php'; ?>

    <div id="content">
        <button id="toggle-button" onclick="toggleMenu()">
            <i class="fas fa-bars"></i> Menu
        </button><br><br><br><br>
        <h1>Stock Actual</h1>
        <?php
        include 'ver_stock.php';
        ?>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
