<?php

namespace Tests\Unit\Api\Controllers;

use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AuthControllerTest extends TestCase {

    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_register_a_new_user() {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
        ];

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $this->assertTrue($validator->passes());

        $response = $this->postJson(route('api.register'), $data);

        $this->assertEquals(201, $response->status());

        $user = User::where('email', $data['email'])->first();

        $this->assertNotNull($user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
    }

}