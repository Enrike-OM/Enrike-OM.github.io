<?php

require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

function validateInput($precio_venta, $cantidad) {
    $errors = [];

    // Validar que el precio de venta sea un número positivo
    if (!is_numeric($precio_venta) || $precio_venta <= 0) {
        $errors[] = "El precio de venta debe ser un número positivo.";
    }

    // Validar que la cantidad sea un número entero positivo
    if (!filter_var($cantidad, FILTER_VALIDATE_INT) || $cantidad <= 0) {
        $errors[] = "La cantidad debe ser un número entero positivo.";
    }

    return $errors;
}

function redirectWithMessage($location, $message) {
    session_start();
    $_SESSION['message'] = $message;
    header("Location: $location");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $_POST['nombre_producto'];
    $marca = $_POST['marca'];
    $numero_serie = $_POST['numero_serie'];
    $fecha = $_POST['fecha'];
    $unidad_medida = $_POST['unidad_medida'];
    $precio_venta = $_POST['precio_venta'];
    $cantidad = $_POST['cantidad'];

    // Validaciones
    $errors = validateInput($precio_venta, $cantidad);
    if (!empty($errors)) {
        redirectWithMessage('ingreso.php', implode("<br>", $errors));
    }

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "inventario");
    if ($conn->connect_error) {
        redirectWithMessage('ingreso.php', "Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO ingreso (NombreProducto, Marca, NumeroSerie, Fecha, UnidadMedida, PrecioVenta, Cantidad) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssds", $nombre_producto, $marca, $numero_serie, $fecha, $unidad_medida, $precio_venta, $cantidad);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Recuperar el código del producto usando el número de serie
        $stmt_select = $conn->prepare("SELECT codigo FROM ingreso WHERE NumeroSerie = ?");
        $stmt_select->bind_param("s", $numero_serie);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $codigo = $row['codigo']; // Obtener el código

            // Generar el contenido del código QR
            $qrContent = json_encode([
                'codigo' => $codigo,
                'NombreProducto' => $nombre_producto,
                'Marca' => $marca,
                'NumeroSerie' => $numero_serie,
            ]);

            // Configuración de opciones para el código QR
            $options = new QROptions([
                'version' => 5,
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel' => QRCode::ECC_L,
            ]);

            // Generar el código QR
            $qrFilePath = 'qrcodes/' . $codigo . '.png';
            $qrcode = new QRCode($options);
            $qrcode->render($qrContent, $qrFilePath);

            // Guardar la ruta del código QR en la base de datos
            $stmt_update = $conn->prepare("UPDATE ingreso SET QR = ? WHERE codigo = ?");
            $stmt_update->bind_param("ss", $qrFilePath, $codigo);
            $stmt_update->execute();

            // Mensaje de éxito
            redirectWithMessage('ingreso.php', "Código QR generado y guardado correctamente en: " . $qrFilePath);
        } else {
            redirectWithMessage('salida.php', "No se pudo recuperar el código del producto usando el número de serie.");
        }
    } else {
        redirectWithMessage('salida.php', "Error al insertar el registro: " . $stmt->error);
    }

    // Cerrar las conexiones
    $stmt->close();
    $conn->close();
}
?>