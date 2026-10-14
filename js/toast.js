// getElementById: el toast tiene un id único, es la forma más directa de obtener un solo elemento
// querySelector: el cuerpo del mensaje se identifica por su clase (.toast-body) dentro del toast
function mostrarToast(mensaje, tipo) {
    const toastEl = document.getElementById('toastAviso');
    const cuerpo = toastEl.querySelector('.toast-body');

    cuerpo.textContent = mensaje;

    // Quito los colores anteriores para que no se acumulen
    toastEl.classList.remove('text-bg-success', 'text-bg-danger');
    toastEl.classList.add(tipo);

    bootstrap.Toast.getOrCreateInstance(toastEl).show();
}

function manejarSubmitAgendar(evento) {
    evento.preventDefault();
    const form = evento.currentTarget;

    if (form.checkValidity()) {
        // getElementById: cada campo tiene un id único
        const paciente = document.getElementById('c-paciente').value;
        const hora = document.getElementById('c-hora').value;
        mostrarToast('Cita agendada para ' + paciente + ' a las ' + hora, 'text-bg-success');
    } else {
        form.reportValidity();
    }
}

function manejarSubmitCancelar(evento) {
    evento.preventDefault();
    const form = evento.currentTarget;

    if (form.checkValidity()) {
        mostrarToast('Cita cancelada', 'text-bg-danger');
    } else {
        form.reportValidity();
    }
}

// getElementById: cada formulario tiene su id único.
// El mismo archivo se carga en las dos páginas, por eso reviso que el formulario exista antes de escucharlo.
const formAgendar = document.getElementById('formAgendar');
const formCancelar = document.getElementById('formCancelar');

if (formAgendar) {
    formAgendar.addEventListener('submit', manejarSubmitAgendar);
}
if (formCancelar) {
    formCancelar.addEventListener('submit', manejarSubmitCancelar);
}