<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * La página inicial redirige al Dashboard.
     */
    public function test_home_redirects_to_dashboard(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(
            route('dashboard', absolute: false)
        );
    }
}