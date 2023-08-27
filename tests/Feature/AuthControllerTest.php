<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase {
    use RefreshDatabase; // This ensures that the database is reset after each test

    public function testUserCanRegister() {
        
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/register/', $userData);

        $response->assertStatus(201); // Ensures that the response has the code 201 (created)
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']); // Verify that the user has been saved in the database
    
    }
}
