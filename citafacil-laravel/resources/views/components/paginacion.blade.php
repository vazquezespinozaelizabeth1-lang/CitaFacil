@props(['coleccion'])

@if ($coleccion instanceof \Illuminate\Pagination\AbstractPaginator && $coleccion->hasPages())
    <nav aria-label="Navegación de páginas" class="mt-3">
        {{ $coleccion->links('pagination::bootstrap-5') }}
    </nav>
@endif