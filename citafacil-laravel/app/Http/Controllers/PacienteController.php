<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Paciente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PacienteController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = $request->query('buscar');

        $pacientes = Paciente::query()
            ->buscar($buscar)
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('pacientes.index', compact('pacientes', 'buscar'));
    }

    public function create(): View
    {
        return view('pacientes.create');
    }

    public function store(StorePacienteRequest $request): RedirectResponse
    {
        Paciente::create($request->validated());

        return redirect()
            ->route('pacientes.index')
            ->with('exito', 'Paciente registrado correctamente.');
    }

    public function show(Paciente $paciente): View
    {
        $paciente->load(['citas' => function ($query) {
            $query->with('servicio')->orderByDesc('fecha')->orderByDesc('hora');
        }]);

        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente): View
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente): RedirectResponse
    {
        $paciente->update($request->validated());

        return redirect()
            ->route('pacientes.index')
            ->with('exito', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente): RedirectResponse
    {
        if ($paciente->citas()->exists()) {
            return redirect()
                ->route('pacientes.index')
                ->with('error', 'No se puede eliminar: el paciente tiene citas registradas.');
        }

        $paciente->delete();

        return redirect()
            ->route('pacientes.index')
            ->with('exito', 'Paciente eliminado correctamente.');
    }
}