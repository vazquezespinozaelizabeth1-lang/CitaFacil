
const formUsuario = document.getElementById('formUsuario');
const listaUsuarios = document.getElementById('listaUsuarios');

// Usamos getElementById porque el formulario y el tbody son elementos únicos.
const campoNombre = document.getElementById('u-nombre');
const campoUsuario = document.getElementById('u-usuario');
const campoRol = document.getElementById('u-rol');
const campoClave = document.getElementById('u-clave');
const campoClave2 = document.getElementById('u-clave2');

function agregarUsuario(evento) {
    evento.preventDefault();

    if (campoClave.value !== campoClave2.value) {
        alert('Las contraseñas no coinciden.');
        campoClave2.focus();
        return;
    }

    if (!formUsuario.checkValidity()) {
        formUsuario.reportValidity();
        return;
    }

    const fila = document.createElement('tr');

    const celdaNombre = document.createElement('td');
    celdaNombre.textContent = campoNombre.value.trim();

    const celdaUsuario = document.createElement('td');
    celdaUsuario.textContent = campoUsuario.value.trim();

    const celdaRol = document.createElement('td');
    celdaRol.textContent = campoRol.value;

    const celdaEstado = document.createElement('td');
    const badgeEstado = document.createElement('span');
    badgeEstado.classList.add('badge', 'chip', 'estado-exito');
    badgeEstado.textContent = 'Activo';
    celdaEstado.appendChild(badgeEstado);

    const celdaAccion = document.createElement('td');
    const botonEliminar = document.createElement('button');

    botonEliminar.type = 'button';
    botonEliminar.classList.add(
        'btn',
        'btn-outline-danger',
        'btn-sm',
        'eliminar'
    );
    botonEliminar.textContent = 'Eliminar';
    celdaAccion.appendChild(botonEliminar);

    fila.appendChild(celdaNombre);
    fila.appendChild(celdaUsuario);
    fila.appendChild(celdaRol);
    fila.appendChild(celdaEstado);
    fila.appendChild(celdaAccion);

    listaUsuarios.appendChild(fila);
    formUsuario.reset();
}

function eliminarUsuario(evento) {
    // Un solo listener en el tbody también detecta botones de filas nuevas.
    const boton = evento.target.closest('.eliminar');

    if (!boton || !listaUsuarios.contains(boton)) {
        return;
    }

    const fila = boton.closest('tr');

    if (fila) {
        fila.remove();
    }
}

formUsuario.addEventListener('submit', agregarUsuario);
listaUsuarios.addEventListener('click', eliminarUsuario);
