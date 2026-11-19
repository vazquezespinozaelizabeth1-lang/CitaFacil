<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHorarioRequest;
use App\Http\Requests\UpdateHorarioRequest;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index(Request $request)
    {
        $horarios = Horario::query()
            ->when($request->filled('dia'), fn ($q) => $q->where('dia_semana', (int) $request->query('dia')))
            ->orderBy('dia_semana')
            ->orderBy('hora_inicio')
            ->paginate(15)
            ->withQueryString();

        // Se agrupa por día la página actual para mostrarla en tarjetas
        $porDia = $horarios->getCollection()->groupBy('dia_semana');

        return view('horarios.index', [
            'horarios' => $horarios,
            'porDia' => $porDia,
            'dias' => Horario::DIAS,
        ]);
    }

    public function create()
    {
        return view('horarios.create', ['dias' => Horario::DIAS]);
    }

    public function store(StoreHorarioRequest $request)
    {
        Horario::create($request->validated());

        return redirect()->route('horarios.index')
            ->with('exito', 'Horario registrado correctamente.');
    }

    public function edit(Horario $horario)
    {
        return view('horarios.edit', ['horario' => $horario, 'dias' => Horario::DIAS]);
    }

    public function update(UpdateHorarioRequest $request, Horario $horario)
    {
        $horario->update($request->validated());

        return redirect()->route('horarios.index')
            ->with('exito', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.index')
            ->with('exito', 'Horario eliminado correctamente.');
    }
}
