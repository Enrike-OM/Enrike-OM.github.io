$(document).ready(function() {
    $('#formularioIngreso').on('submit', function(event) {
        event.preventDefault(); // Evita el envío normal del formulario

        $.ajax({
            url: 'procesar_ingreso.php', // URL del archivo que procesa el ingreso
            type: 'POST',
            data: $(this).serialize(), // Serializa los datos del formulario
            success: function(response) {
                $('#mensaje').html('<p>Producto registrado exitosamente.</p>'); // Muestra el mensaje
                $('#formularioIngreso')[0].reset(); // Limpia el formulario
            },
            error: function() {
                $('#mensaje').html('<p>Error al registrar el producto. Intenta de nuevo.</p>');
            }
        });
    });
});