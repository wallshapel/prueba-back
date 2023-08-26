<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroy()
    {
        // Crear un usuario en la base de datos
        $user = User::factory()->create();

        // Enviar una solicitud DELETE al endpoint de eliminación
        $response = $this->deleteJson("/api/auth/delete/{$user->id}");

        // Verificar que la respuesta tenga el código de estado 204 (Sin contenido)
        $response->assertStatus(204);

        // Verificar que el usuario no existe en la base de datos
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
