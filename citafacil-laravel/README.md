# CitaFácil · Módulo de Citas (Laravel 12)
*Tu tiempo también importa.*

## Descripción
CRUD de citas para consultorios pequeños; solo frontend con vistas Blade y Bootstrap 5, rutas y un controlador mínimo; los datos viven en la sesión (no hay base de datos).

## Tecnologías
Laravel 12, PHP 8.2 o superior, Blade, Bootstrap 5.3.3 y Bootstrap Icons (CDN), sesión de Laravel en archivos, Git y GitHub (ramas, Pull Requests y tablero Kanban).

## Integrantes
| Integrante | Rol | Usuario de GitHub | Rama |
|---|---|---|---|
| Elizabeth Vázquez Espinoza | Líder | vazquezespinozaelizabeth1-lang | feature/base-laravel |
| Jonathan Corona Téllez | Analista | jonathancorona-rgb | feature/readme-docs |
| Aram Jael Morales Peña | Backend | arammorales | feature/rutas-controller-get |
| Victor Hugo Ramírez | Backend | petevictor1-maker | feature/controller-post-put-delete |
| Luis Ángel Ruiz Bautista | Frontend | angelrb2531126237 | feature/vistas-index-show |
| Liam Tonatihu Villanueva Cerón | Frontend | LiamVillanueva777 | feature/vistas-create-edit |

## Instalación
```bash
git clone [https://github.com/vazquezespinozaelizabeth1-lang/CitaFacil.git](https://github.com/vazquezespinozaelizabeth1-lang/CitaFacil.git)
cd CitaFacil/citafacil-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan serve