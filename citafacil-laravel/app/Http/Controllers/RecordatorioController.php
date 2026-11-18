<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordatorioRequest;
use App\Http\Requests\UpdateRecordatorioRequest;
use App\Models\Cita;
use App\Models\Recordatorio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RecordatorioController extends Controller
{
    public function index(): View
    {
        $recordatorios = Recordatorio::with('cita.paciente')
            ->orderByDesc('fecha_envio')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('recordatorios.index', compact('recordatorios'));
    }

    public function create(): View
    {
        return view('recordatorios.create', [
            'recordatorio' => new Recordatorio,
            'citas' => $this->citasParaFormulario(),
        ]);
    }

    public function store(StoreRecordatorioRequest $request): RedirectResponse
    {
        $recordatorio = Recordatorio::create($request->validated());

        return to_route('recordatorios.show', $recordatorio)
            ->with('exito', 'Recordatorio creado correctamente.');
    }

    public function show(Recordatorio $recordatorio): View
    {
        $recordatorio->load('cita.paciente', 'cita.servicio');

        return view('recordatorios.show', compact('recordatorio'));
    }

    public function edit(Recordatorio $recordatorio): View
    {
        return view('recordatorios.edit', [
            'recordatorio' => $recordatorio,
            'citas' => $this->citasParaFormulario(),
        ]);
    }

    public function update(UpdateRecordatorioRequest $request, Recordatorio $recordatorio): RedirectResponse
    {
        $recordatorio->update($request->validated());

        return to_route('recordatorios.show', $recordatorio)
            ->with('exito', 'Recordatorio actualizado correctamente.');
    }

    public function destroy(Recordatorio $recordatorio): RedirectResponse
    {
        $recordatorio->delete();

        return to_route('recordatorios.index')
            ->with('exito', 'Recordatorio eliminado correctamente.');
    }

    private function citasParaFormulario(): Collection
    {
        return Cita::with('paciente')->orderByDesc('fecha')->orderBy('hora')->orderBy('id')->get();
    }
}
