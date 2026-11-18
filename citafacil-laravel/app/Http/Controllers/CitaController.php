<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Servicio;

class CitaController extends Controller
{
    private function catalogos(): array
    {
        return [
            'pacientes' => Paciente::orderBy('nombre')->get(),
            'servicios' => Servicio::where('activo', true)->orderBy('nombre')->get(),
            'estados' => Cita::ESTADOS,
        ];
    }

    public function index()
    {
        $citas = Cita::with(['paciente', 'servicio'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        return view('citas.create', $this->catalogos());
    }

    public function store(StoreCitaRequest $request)
    {
        Cita::create($request->validated());

        return redirect()->route('citas.index')
            ->with('exito', 'Cita registrada correctamente.');
    }

    public function show(Cita $cita)
    {
        $cita->load(['paciente', 'servicio']);

        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        return view('citas.edit', ['cita' => $cita] + $this->catalogos());
    }

    public function update(UpdateCitaRequest $request, Cita $cita)
    {
        $cita->update($request->validated());

        return redirect()->route('citas.index')
            ->with('exito', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')
            ->with('exito', 'Cita eliminada correctamente.');
    }
}