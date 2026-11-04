<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitaController extends Controller
{
    private const ESTADOS = ['Pendiente', 'Confirmada', 'Cancelada'];

    /** Citas guardadas en sesión (con datos de ejemplo la primera vez). */
    private function citas(): array
    {
        if (!session()->has('citas')) {
            session(['citas' => [
                1 => ['id' => 1, 'paciente' => 'Ana López', 'fecha' => '2026-11-10', 'hora' => '09:00', 'motivo' => 'Consulta general', 'estado' => 'Pendiente'],
                2 => ['id' => 2, 'paciente' => 'Luis Pérez', 'fecha' => '2026-11-11', 'hora' => '11:30', 'motivo' => 'Revisión de resultados', 'estado' => 'Confirmada'],
                3 => ['id' => 3, 'paciente' => 'María Torres', 'fecha' => '2026-11-12', 'hora' => '16:00', 'motivo' => 'Limpieza dental', 'estado' => 'Cancelada'],
            ]]);
        }

        return session('citas');
    }

    private function guardar(array $citas): void
    {
        session(['citas' => $citas]);
    }

    private function reglas(): array
    {
        return [
            'paciente' => ['required', 'string', 'min:3', 'max:80'],
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'motivo' => ['required', 'string', 'min:3', 'max:150'],
            'estado' => ['required', 'in:Pendiente,Confirmada,Cancelada'],
        ];
    }

    private function mensajes(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max' => 'El campo :attribute no puede superar :max caracteres.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'date_format' => 'El campo :attribute debe tener el formato HH:MM.',
            'in' => 'El valor elegido en :attribute no es válido.',
        ];
    }

    // =====================================================
    // ZONA GET (responsable: Aram)
    // =====================================================

    public function index()
    {
        return view('citas.index', ['citas' => $this->citas()]);
    }

    public function create()
    {
        return view('citas.create', ['estados' => self::ESTADOS]);
    }

    public function show($id)
    {
        $citas = $this->citas();

        abort_unless(isset($citas[$id]), 404);

        return view('citas.show', ['cita' => $citas[$id]]);
    }

    public function edit($id)
    {
        $citas = $this->citas();

        abort_unless(isset($citas[$id]), 404);

        return view('citas.edit', ['cita' => $citas[$id], 'estados' => self::ESTADOS]);
    }

    // =====================================================
    // ZONA POST / PUT / DELETE (responsable: Victor)
    // =====================================================

    public function store(Request $request)
    {
        abort(501);
    }

    public function update(Request $request, $id)
    {
        abort(501);
    }

    public function destroy($id)
    {
        abort(501);
    }
}