// getElementById: son elementos únicos con id, es la forma más directa de obtenerlos.
const buscador = document.getElementById('q');
const formulario = document.getElementById('formBuscar');
const resumen = document.getElementById('resumen');

// querySelectorAll: necesito todas las filas del tbody, no solo la primera.
const filas = document.querySelectorAll('tbody tr');

// Pasa a minúsculas y quita acentos para que "maria" encuentre "María".
function normalizar(texto) {
  return texto.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
}

function filtrarPacientes() {
  const buscado = normalizar(buscador.value.trim());
  const buscadoSinEspacios = buscado.replace(/\s/g, '');
  let visibles = 0;

  for (const fila of filas) {
    // Solo nombre y teléfono: así "agendar" o "correo" no coinciden con todas las filas.
    const contenido = normalizar(fila.cells[0].textContent + ' ' + fila.cells[1].textContent);
    const contenidoSinEspacios = contenido.replace(/\s/g, '');

    // El segundo caso permite buscar el teléfono sin espacios (7711234567).
    const coincide = contenido.includes(buscado) || contenidoSinEspacios.includes(buscadoSinEspacios);

    fila.classList.toggle('d-none', !coincide);
    if (coincide) {
      visibles++;
    }
  }

  actualizarResumen(visibles, buscador.value.trim());
}

function actualizarResumen(cantidad, texto) {
  if (texto === '') {
    resumen.textContent = cantidad + ' pacientes en total';
  } else if (cantidad === 1) {
    resumen.textContent = '1 resultado para «' + texto + '»';
  } else {
    resumen.textContent = cantidad + ' resultados para «' + texto + '»';
  }
}

function evitarRecarga(evento) {
  evento.preventDefault(); // sin esto el submit recarga la página y se pierde el filtro
}

buscador.addEventListener('input', filtrarPacientes);
formulario.addEventListener('submit', evitarRecarga);

filtrarPacientes(); // deja el conteo correcto al cargar