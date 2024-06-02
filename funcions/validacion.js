document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registroForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe

        // Obtener valores de las contraseñas
        const contrasena = document.getElementById('contrasena').value;
        const confirmarContrasena = document.getElementById('confirmarContrasena').value;

        // Verificar si las contraseñas son idénticas
        if (contrasena !== confirmarContrasena) {
            alert('Las contraseñas no coinciden.');
            //Whait
        } else {
            // Aquí iría el código para enviar el formulario
            alert('Registro exitoso!');

            // AQUI Colocar el codigo o API Create para BD
        }
    });
});
