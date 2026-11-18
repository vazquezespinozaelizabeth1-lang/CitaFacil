<?php

namespace Tests\Feature;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Recordatorio;
use App\Models\Servicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class RecordatorioTest extends TestCase
{
    use RefreshDatabase;

    public function test_guarda_consulta_edita_y_elimina_un_recordatorio(): void
    {
        $datos = $this->datos($this->cita());

        $this->post(route('recordatorios.store'), $datos)->assertSessionHas('exito');
        $recordatorio = Recordatorio::sole();
        $this->assertFalse($recordatorio->enviado);
        $this->get(route('recordatorios.show', $recordatorio))
            ->assertOk()
            ->assertSee('Paciente de prueba')
            ->assertSee($datos['mensaje']);
        $this->get(route('recordatorios.edit', $recordatorio))
            ->assertOk()
            ->assertSee('value="2026-12-01T09:15"', false);

        $this->put(route('recordatorios.update', $recordatorio), array_replace($datos, [
            'enviado' => '1',
            'mensaje' => 'Mensaje actualizado',
        ]))->assertRedirect(route('recordatorios.show', $recordatorio))->assertSessionHas('exito');
        $this->assertTrue($recordatorio->refresh()->enviado);
        $this->assertSame('Mensaje actualizado', $recordatorio->mensaje);

        $this->put(route('recordatorios.update', $recordatorio), $datos)
            ->assertSessionHas('exito');
        $this->assertFalse($recordatorio->refresh()->enviado);

        $this->get(route('recordatorios.index'))
            ->assertOk()
            ->assertSee(route('recordatorios.destroy', $recordatorio))
            ->assertSee('Sí, eliminar');
        $this->delete(route('recordatorios.destroy', $recordatorio))
            ->assertRedirect(route('recordatorios.index'))
            ->assertSessionHas('exito');
        $this->assertModelMissing($recordatorio);
        $this->get(route('recordatorios.show', $recordatorio))->assertNotFound();
    }

    public function test_rechaza_datos_invalidos_y_conserva_valores_del_formulario(): void
    {
        $datos = $this->datos($this->cita());
        $origen = route('recordatorios.create');
        $casos = [
            ['cita_id', 999999],
            ['mensaje', '1234'],
            ['mensaje', str_repeat('x', 256)],
            ['canal', 'paloma'],
            ['fecha_envio', '2026-02-30T09:15'],
            ['enviado', 'desconocido'],
        ];

        foreach ($casos as [$campo, $valor]) {
            $this->from($origen)->post(route('recordatorios.store'), array_replace($datos, [$campo => $valor]))
                ->assertRedirect($origen)
                ->assertSessionHasErrors($campo)
                ->assertSessionHasInput($campo, $valor);
        }

        $this->get($origen)
            ->assertOk()
            ->assertSee('El campo enviado debe ser verdadero o falso.')
            ->assertSee($datos['mensaje'])
            ->assertSee('value="2026-12-01T09:15"', false);
        $this->assertDatabaseCount('recordatorios', 0);
    }

    public function test_filtra_por_canal_y_estado_y_conserva_los_filtros_al_paginar(): void
    {
        $cita = $this->cita();
        $datos = $this->datos($cita);
        foreach (range(1, 11) as $numero) {
            $cita->recordatorios()->create(array_replace($datos, ['mensaje' => "Recordatorio pendiente $numero"]));
        }
        $cita->recordatorios()->create(array_replace($datos, ['canal' => 'sms']));
        $cita->recordatorios()->create(array_replace($datos, ['enviado' => true]));

        $this->get(route('recordatorios.index', ['canal' => 'correo']))
            ->assertViewHas('recordatorios', fn (LengthAwarePaginator $pagina) => $pagina->total() === 12);
        $this->get(route('recordatorios.index', ['enviado' => '0']))
            ->assertViewHas('recordatorios', fn (LengthAwarePaginator $pagina) => $pagina->total() === 12);
        $this->get(route('recordatorios.index', ['enviado' => '1']))
            ->assertViewHas('recordatorios', fn (LengthAwarePaginator $pagina) => $pagina->total() === 1);
        $filtros = ['canal' => 'correo', 'enviado' => '0'];
        $this->get(route('recordatorios.index', $filtros))->assertOk()->assertViewHas(
            'recordatorios',
            fn (LengthAwarePaginator $pagina) => $pagina->total() === 11
                && $pagina->count() === 10
                && str_contains($pagina->nextPageUrl(), 'canal=correo&enviado=0'),
        );
        $this->get(route('recordatorios.index', $filtros + ['page' => 2]))
            ->assertViewHas('recordatorios', fn (LengthAwarePaginator $pagina) => $pagina->count() === 1);
        $this->get(route('recordatorios.index', ['canal' => 'whatsapp']))
            ->assertSee('No hay recordatorios que coincidan con los filtros.');
    }

    public function test_elimina_recordatorios_en_cascada_y_el_formulario_avisa_si_no_hay_citas(): void
    {
        $cita = $this->cita();
        $recordatorio = $cita->recordatorios()->create($this->datos($cita));

        $cita->delete();

        $this->assertModelMissing($recordatorio);
        $this->get(route('recordatorios.create'))
            ->assertOk()
            ->assertSee('Debe haber al menos una cita registrada');
    }

    private function cita(): Cita
    {
        $paciente = Paciente::create(['nombre' => 'Paciente de prueba', 'telefono' => '0000000000']);
        $servicio = Servicio::create(['nombre' => 'Consulta de prueba', 'duracion_min' => 30, 'precio' => 100]);

        return Cita::create([
            'paciente_id' => $paciente->id,
            'servicio_id' => $servicio->id,
            'fecha' => '2026-12-02',
            'hora' => '10:00',
            'motivo' => 'Cita de prueba',
            'estado' => 'Pendiente',
        ]);
    }

    private function datos(Cita $cita): array
    {
        return [
            'cita_id' => $cita->id,
            'mensaje' => 'Tu cita es mañana.',
            'fecha_envio' => '2026-12-01T09:15',
            'canal' => 'correo',
        ];
    }
}
