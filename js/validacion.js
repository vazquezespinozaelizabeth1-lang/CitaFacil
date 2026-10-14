// Obtener el formulario y los campos obligatorios
const formulario = document.getElementById("formPaciente");

const campos = document.querySelectorAll(".campo");

const barraProgreso = document.getElementById("barraProgreso");


// FUNCION PARA VALIDAR UN CAMPO
function validarCampo(campo) {

    if (campo.checkValidity()) {

        campo.classList.remove("is-invalid");
        campo.classList.add("is-valid");

    } else {

        campo.classList.remove("is-valid");
        campo.classList.add("is-invalid");

    }

    actualizarProgreso();

}


// FUNCION PARA ACTUALIZAR LA BARRA DE PROGRESO
function actualizarProgreso() {

    let camposValidos = 0;

    // Contar campos correctos
    campos.forEach(function(campo) {

        if (campo.checkValidity()) {
            camposValidos++;
        }

    });

    // Calcular porcentaje
    const porcentaje = (camposValidos / campos.length) * 100;

    // Eliminar clases anteriores
    barraProgreso.classList.remove(
        "w-25",
        "w-50",
        "w-75",
        "w-100"
    );

    // Agregar clase dependiendo del avance
    if (porcentaje >= 100) {

        barraProgreso.classList.add("w-100");

    } else if (porcentaje >= 75) {

        barraProgreso.classList.add("w-75");

    } else if (porcentaje >= 50) {

        barraProgreso.classList.add("w-50");

    } else if (porcentaje >= 25) {

        barraProgreso.classList.add("w-25");

    }

    // Actualizar información de accesibilidad
    const progreso = barraProgreso.parentElement;

    progreso.setAttribute(
        "aria-valuenow",
        Math.round(porcentaje)
    );

}


// FUNCION PARA VALIDAR TODO EL FORMULARIO
function validarFormulario(evento) {

    evento.preventDefault();

    let formularioValido = true;

    campos.forEach(function(campo) {

        validarCampo(campo);

        if (!campo.checkValidity()) {

            formularioValido = false;

        }

    });

    if (formularioValido) {

        alert("Todos los datos son correctos. Formulario validado.");

    }

}


// EVENTOS DE LOS CAMPOS
campos.forEach(function(campo) {

    // Validar mientras escribe
    campo.addEventListener("input", function() {

        validarCampo(campo);

    });

    // Validar al salir del campo
    campo.addEventListener("blur", function() {

        validarCampo(campo);

    });

});


// EVENTO DEL FORMULARIO
formulario.addEventListener("submit", validarFormulario);


// INICIAR LA BARRA EN CERO
actualizarProgreso();