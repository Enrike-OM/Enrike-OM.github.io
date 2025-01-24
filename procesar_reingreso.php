<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo']; // Asegúrate de que el formulario permita seleccionar el código existente
    $nombre_producto = $_POST['nombre_producto'];
    $marca = $_POST['marca'];
    $numero_serie = $_POST['numero_serie'];
    $precio_venta = $_POST['precio_venta'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "inventario");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Inserción del reingreso
    $sql = "INSERT INTO reingreso (Codigo, NombreProducto, Marca, NumeroSerie, PrecioVenta, Estado, Fecha)
            VALUES ('$codigo', '$nombre_producto', '$marca', '$numero_serie', '$precio_venta', '$estado', '$fecha')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto reingresado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
