<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $servicios = Servicio::buscar($request->query('q'))
            ->withCount('citas')
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(StoreServicioRequest $request)
    {
        Servicio::create($request->validated());

        return redirect()->route('servicios.index')
            ->with('exito', 'Servicio registrado correctamente.');
    }

    public function show(Servicio $servicio)
    {
        $servicio->loadCount('citas');

        return view('servicios.show', compact('servicio'));
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    public function update(UpdateServicioRequest $request, Servicio $servicio)
    {
        $servicio->update($request->validated());

        return redirect()->route('servicios.index')
            ->with('exito', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio)
    {
        if ($servicio->citas()->exists()) {
            return redirect()->route('servicios.index')
                ->with('error', 'No se puede eliminar "'.$servicio->nombre.'" porque tiene citas asociadas. Puedes desactivarlo en su lugar.');
        }

        $servicio->delete();

        return redirect()->route('servicios.index')
            ->with('exito', 'Servicio eliminado correctamente.');
    }
}
