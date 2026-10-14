# CitaFácil
*Tu tiempo también importa*

## Sitio publicado
https://vazquezespinozaelizabeth1-lang.github.io/CitaFacil/

## Integrantes
| Integrante | Rol |
|---|---|
| Elizabeth Vázquez Espinoza | Líder de equipo |
| Corona Téllez Jonathan | Analista |
| Aram Jael Morales Peña | Backend |
| Victor Hugo Ramírez | Backend |
| Luis Ángel Ruiz Bautista | Frontend |
| Liam Tonatihu Villanueva Cerón | Frontend |

## Descripción de la aplicación
CitaFácil es una aplicación web para que consultorios pequeños gestionen sus citas: agendar, cancelar, reprogramar, consultar horarios disponibles y recibir recordatorios.

## Objetivo
Evitar citas duplicadas, olvidadas o mal organizadas mediante una interfaz simple y accesible, pensada también para personas mayores o con poca experiencia tecnológica.

## Tecnologías utilizadas
- HTML5
- CSS3
- JavaScript (DOM, eventos y funciones con nombre)
- Bootstrap 5.3 y Bootstrap Icons
- Git y GitHub (control de versiones y tablero Kanban)
- LaTeX (SRS y Guía de diseño)

## Características principales
- Sitio multipágina: 4 páginas públicas (Inicio, Nosotros, Servicios y Contacto) y un panel para el consultorio (pacientes, citas, horarios, recordatorios y usuarios)
- Interacciones dinámicas con JavaScript: validación en tiempo real, barra de progreso, modal con información dinámica, toast, filtrado de pacientes, agregar y eliminar usuarios y mostrar/ocultar contraseña
- Diseño responsive para computadora, tableta y móvil
- Formularios con validación de Bootstrap
- Interfaz sencilla y accesible

## Componentes de Bootstrap utilizados
Navbar responsive, sistema de rejilla (container, row, col), cards, carousel, accordion, modal, toast, progress, input-group, tablas, validación de formularios (`is-valid`, `is-invalid`, `invalid-feedback`), botones, badges y utilidades.

## Estructura del proyecto
```
CitaFacil/
├── index.html
├── nosotros.html
├── servicios.html
├── contacto.html
├── login.html
├── panel.html
├── pacientes-registro.html
├── pacientes-buscar.html
├── citas-agendar.html
├── citas-consulta.html
├── citas-modificar.html
├── citas-cancelar.html
├── citas-duplicada.html
├── horarios.html
├── recordatorios.html
├── usuarios.html
├── README.md
├── css/
│   └── estilos.css
├── js/
│   ├── app.js
│   ├── validacion.js
│   ├── modal-cita.js
│   ├── toast.js
│   ├── filtro.js
│   ├── usuarios.js
│   └── password.js
├── img/
│   └── (capturas e imágenes del proyecto)
└── docs/
    ├── SRS.pdf (fuente en LaTeX: SRS.tex)
    └── Guia_Diseno.pdf (fuente en LaTeX: Guia_Diseno.tex)
```

## Instrucciones para visualizarlo
1. Clonar el repositorio:
```
   git clone https://github.com/vazquezespinozaelizabeth1-lang/CitaFacil.git
```
2. Abrir la carpeta `CitaFacil`.
3. Abrir `index.html` en el navegador (doble clic) o usar la extensión Live Server en VS Code.

## Tabla de Interacciones JavaScript

| Interacción | Tipo | Responsable | Página | Selectores usados | Eventos usados | Componente Bootstrap |
|---|---|---|---|---|---|---|
| Filtrado de pacientes en tiempo real | Obligatoria | Jonathan | `pacientes-buscar.html` | `getElementById('q')`, `querySelectorAll('tbody tr')`, `querySelector('form')` | `input`, `submit` | Tabla (`table`) y utilidad `d-none` |
| Validación de formulario en tiempo real | Obligatoria | Angel | `pacientes-registro.html` | `getElementById`, `querySelectorAll` | `input`, `blur`, `submit`, `preventDefault()` | `is-valid`, `is-invalid`, `invalid-feedback` |
| Barra de progreso del registro | Libre | Angel | `pacientes-registro.html` | `getElementById` | `input` | Progress |
| Modal con información dinámica | Obligatoria | Liam | `citas-consulta.html` | `getElementById`, `querySelector` | `show.bs.modal`, `dataset` | Modal (`data-bs-*`) |
| Notificación tras una acción | Obligatoria | Victor | `citas-agendar.html`, `citas-cancelar.html` | `getElementById`, `querySelector` | `submit`, `preventDefault()` | Toast |
| Agregar y eliminar usuarios | Obligatoria | Aram | `usuarios.html` | `getElementById`, `querySelector` | `submit`, `click` (delegación de eventos) | Tabla, badge, botones |
| Mostrar/ocultar contraseña | Libre | Elizabeth | `login.html` | `getElementById`, `querySelector` | `click` | Input-group |

## Reflexión por integrante

Cada integrante responde: ¿qué fue lo más difícil de su interacción?, ¿qué aprendió al combinar JavaScript con Bootstrap? y, en el caso de la delegación de eventos, ¿qué ventaja ofrece?

### Elizabeth Vázquez Espinoza (Líder) · Mostrar/ocultar contraseña
Lo más difícil fue coordinar al equipo: repartir las interacciones, revisar los Pull Requests y hacer los merges sin conflictos. Mi interacción (mostrar/ocultar contraseña) me enseñó a cambiar el `type` del input y el ícono con `classList`, usando `input-group` de Bootstrap sin `style` en línea.

### Corona Téllez Jonathan (Analista) · Filtrado de pacientes
Implementar el filtro en tiempo real me ayudó a dominar la manipulación del DOM y el uso de eventos como `input` combinados con clases de Bootstrap. Adaptarme al flujo de trabajo con ramas en Git y el tablero Kanban fue clave para mantener la organización y coordinar entregas de calidad con el equipo.

### Aram Jael Morales Peña (Backend) · Agregar y eliminar usuarios
Lo más difícil fue implementar la función para agregar y eliminar usuarios, porque tenía que validar que las contraseñas coincidieran y asegurar que los botones funcionaran correctamente. Aprendí a combinar JavaScript con Bootstrap para crear filas dinámicamente y utilizar sus clases para dar estilo a los botones y estados. La ventaja de la delegación de eventos es que permite eliminar usuarios nuevos y existentes con un solo listener, sin agregar un evento a cada botón.

### Victor Hugo Ramírez (Backend) · Toast de notificación
Lo difícil fue recordar cada cosa (rama, commits, push y PR) y revisar que los ids del HTML coincidieran con los que usaba el JavaScript, porque si no coinciden el toast no muestra bien los datos. Aprendí que Bootstrap pone el estilo y la estructura, pero el JavaScript es el que lo activa (`bootstrap.Toast.getOrCreateInstance`) y que con `classList` puedo cambiar el color del toast sin usar `style` en línea.

### Luis Ángel Ruiz Bautista (Frontend) · Validación en tiempo real y barra de progreso
Lo más difícil fue lograr que la validación se viera en tiempo real y que la barra de progreso avanzara solo con los campos válidos, usando clases de Bootstrap (`w-25`, `w-50`, etc.) en lugar de `style` en línea. Aprendí que Bootstrap da los estados visuales (`is-valid`, `is-invalid`, `invalid-feedback`) y que JavaScript decide cuándo aplicarlos con `classList` y `checkValidity()`.

### Liam Tonatihu Villanueva Cerón (Frontend) · Modal con información dinámica
Lo más difícil fue que un solo modal mostrara información distinta según el botón, leyendo los datos con `dataset` y el evento `show.bs.modal`, cuidando que los `data-*` coincidieran con lo que leía el JavaScript. Aprendí que Bootstrap abre y cierra el modal, pero JavaScript es quien le da el contenido dinámico.

## Capturas de pantalla

### Interacciones JavaScript (Práctica 1)

**Validación en tiempo real y barra de progreso**

<img width="1600" height="661" alt="WhatsApp Image 2026-10-14 at 1 49 33 PM" src="https://github.com/user-attachments/assets/3f5608d9-c232-49e5-9ef4-fe5afff8ab17" />

**Modal con información dinámica**

<img width="1599" height="644" alt="WhatsApp Image 2026-10-14 at 1 56 39 PM" src="https://github.com/user-attachments/assets/8657338a-02cd-4c4d-be98-bc74881a3243" />


**Toast tras una acción**

<img width="1600" height="863" alt="WhatsApp Image 2026-10-14 at 1 55 27 PM" src="https://github.com/user-attachments/assets/cfc17f53-3a51-4dff-b7a2-68d8984d6d9e" />
<img width="1600" height="873" alt="WhatsApp Image 2026-10-14 at 1 55 55 PM" src="https://github.com/user-attachments/assets/799bdbf6-32da-4d89-a834-e39e037955dc" />


**Filtrado de pacientes**

<img width="1600" height="777" alt="WhatsApp Image 2026-10-14 at 1 58 09 PM" src="https://github.com/user-attachments/assets/53e4ccd6-9568-4d68-8270-cdf8b8cb6416" />

**Agregar y eliminar usuarios**

<img width="1600" height="846" alt="WhatsApp Image 2026-10-14 at 1 59 33 PM" src="https://github.com/user-attachments/assets/eb67476c-874d-4488-812b-939262ef429d" />


**Mostrar/ocultar contraseña**

![Mostrar u ocultar contraseña](img/p1-mostrar-clave.png)

### Pruebas de diseño responsive (móvil)
<img width="1600" height="900" alt="respon1" src="https://github.com/user-attachments/assets/0c1d8615-42ad-49f5-82c7-d49378cc3954" />

<img width="1600" height="900" alt="respon2" src="https://github.com/user-attachments/assets/c613364b-a0bb-4fe7-9556-be9b6714b94e" />

<img width="1600" height="900" alt="respon3" src="https://github.com/user-attachments/assets/4a1591b2-6d1d-4675-9e12-f284ab344478" />

<img width="1600" height="900" alt="respon5" src="https://github.com/user-attachments/assets/79b6396f-e323-4686-bcf9-656f9acfd5bc" />

## Evidencias del proceso

### Repositorio en GitHub
<img width="1131" height="682" alt="cap1" src="https://github.com/user-attachments/assets/2192f005-0b56-41a0-b683-ca0a0b95f06d" />

### Tablero Kanban
<img width="1600" height="843" alt="image" src="https://github.com/user-attachments/assets/9d7a5cfe-bd9c-4a44-b18a-a45cef6fe52a" />

**Entrega anterior**

<img width="752" height="211" alt="cap2" src="https://github.com/user-attachments/assets/180ab2bc-87e9-4a3a-9a9d-bfa49da51b8e" /><img width="727" height="237" alt="cap3" src="https://github.com/user-attachments/assets/d4e32557-5220-4229-b883-40d61fd241d7" />

**Práctica 1 (interacciones con DOM y Bootstrap)**

<img width="1600" height="843" alt="WhatsApp Image 2026-10-14 at 2 02 19 PM" src="https://github.com/user-attachments/assets/ab7b01b5-0405-4959-8e85-d68d26f1927e" />

### Colaboradores del repositorio
<img width="1246" height="777" alt="colaboradores" src="https://github.com/user-attachments/assets/4ab3fca6-d580-461c-9fd5-0f5b22624d13" />

### Ramas
<img width="642" height="675" alt="ramas" src="https://github.com/user-attachments/assets/bda52cec-0aff-42b3-8423-09ac06a0a96b" />

### Historial de commits
<img width="1142" height="697" alt="commits" src="https://github.com/user-attachments/assets/b8b7d16c-9041-4c48-9a7d-03e68c00995a" />
