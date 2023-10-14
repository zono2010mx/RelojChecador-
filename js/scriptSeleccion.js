document.addEventListener("DOMContentLoaded", function() {
    const select = document.getElementById("contrato");
    const input = document.getElementById("contrato_user");

    // Agregar un evento change al select
    select.addEventListener("change", function() {
        // Obtener el valor seleccionado del select
        const selectedOption = select.options[select.selectedIndex].value;

        // Llenar el campo de entrada con el valor seleccionado
        input.value = selectedOption;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const select = document.getElementById("sexo");
    const input = document.getElementById("txtSexo");

    // Agregar un evento change al select
    select.addEventListener("change", function() {
        // Obtener el valor seleccionado del select
        const selectedOption = select.options[select.selectedIndex].value;

        // Llenar el campo de entrada con el valor seleccionado
        input.value = selectedOption;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const select = document.getElementById("tipoTrabajador");
    const input = document.getElementById("txtTipoTrabajador");

    // Agregar un evento change al select
    select.addEventListener("change", function() {
        // Obtener el valor seleccionado del select
        const selectedOption = select.options[select.selectedIndex].value;

        // Llenar el campo de entrada con el valor seleccionado
        input.value = selectedOption;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const select = document.getElementById("Status");
    const input = document.getElementById("txtStatus");

    // Agregar un evento change al select
    select.addEventListener("change", function() {
        // Obtener el valor seleccionado del select
        const selectedOption = select.options[select.selectedIndex].value;

        // Llenar el campo de entrada con el valor seleccionado
        input.value = selectedOption;
    });
});