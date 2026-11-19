<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Servicio;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $citas = Cita::with(['paciente', 'servicio'])
            ->when($request->query('paciente'), fn ($q, $texto) => $q->whereHas('paciente', fn ($p) => $p->where('nombre', 'ilike', '%'.$texto.'%')))
            ->when(in_array($request->query('estado'), Cita::ESTADOS, true), fn ($q) => $q->where('estado', $request->query('estado')))
            ->when($request->query('fecha'), fn ($q, $fecha) => $q->whereDate('fecha', $fecha))
            ->orderBy('fecha')
            ->orderBy('hora')
            ->paginate(10)
            ->withQueryString();

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
