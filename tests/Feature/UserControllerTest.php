<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase {
    use RefreshDatabase; // This ensures that the database is reset after each test

    public function testUserCanBeDeleted() {

        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/register/', $userData);

        $user = User::where('email', 'johndoe@example.com')->first(); // Get the newly created user from the database

        $response = $this->deleteJson("http://127.0.0.1:8000/api/delete/{$user->id}");

        $response->assertStatus(204); // Verify that the response has the code 204 (no content)
        $this->assertDatabaseMissing('users', ['id' => $user->id]); // Verify that the user has been removed from the database

    }
}
