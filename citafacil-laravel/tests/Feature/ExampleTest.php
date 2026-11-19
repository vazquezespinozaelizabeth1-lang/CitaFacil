<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_la_raiz_redirige_al_panel(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/panel');
    }
}
