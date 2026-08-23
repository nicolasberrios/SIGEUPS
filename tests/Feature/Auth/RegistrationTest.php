<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * El registro público debe permanecer deshabilitado.
     */
    public function test_public_registration_is_disabled(): void
    {
        $response = $this->get('/register');

        $response->assertNotFound();
    }
}