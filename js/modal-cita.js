document.addEventListener('DOMContentLoaded', () => {
  document.addEventListener('click', (e) => {
    // Detectar si el clic fue en un botón de ver detalles
    const btn = e.target.closest('[data-bs-toggle="modal"]');
    if (!btn) return;

    const tr = btn.closest('tr');
    const contenido = document.getElementById('modalCitaContenido');

    if (tr && contenido) {
      const celdas = tr.children; // Captura tanto <th> como <td>
      const hora = celdas[0] ? celdas[0].innerText.trim() : '';
      const paciente = celdas[1] ? celdas[1].innerText.trim() : '';
      const medico = celdas[2] ? celdas[2].innerText.trim() : '';
      const motivo = celdas[3] ? celdas[3].innerText.trim() : '';
      const estado = celdas[4] ? celdas[4].innerText.trim() : '';

      contenido.innerHTML = `
        <p class="mb-2"><strong>Hora:</strong> ${hora}</p>
        <p class="mb-2"><strong>Paciente:</strong> ${paciente}</p>
        <p class="mb-2"><strong>Médico:</strong> ${medico}</p>
        <p class="mb-2"><strong>Motivo:</strong> ${motivo}</p>
        <p class="mb-2"><strong>Estado:</strong> ${estado}</p>
      `;
    }
  });
});