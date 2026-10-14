// getElementById: el campo de contraseña y el botón tienen un id único
const campoClave = document.getElementById('clave');
const botonVerClave = document.getElementById('btnVerClave');

// querySelector: busca solo el ícono que está dentro del botón
const iconoClave = botonVerClave.querySelector('i');

// Función con nombre: alterna entre mostrar y ocultar la contraseña
function alternarClave() {
    const estaOculta = campoClave.type === 'password';

    campoClave.type = estaOculta ? 'text' : 'password';

    // classList: cambia el ícono con clases de Bootstrap Icons
    iconoClave.classList.toggle('bi-eye', !estaOculta);
    iconoClave.classList.toggle('bi-eye-slash', estaOculta);

    botonVerClave.setAttribute('aria-label', estaOculta ? 'Ocultar contraseña' : 'Mostrar contraseña');
}

botonVerClave.addEventListener('click', alternarClave);