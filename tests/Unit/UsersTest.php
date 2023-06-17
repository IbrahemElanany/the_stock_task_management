<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function testUserCanLogin()
    {
        // Create a new user
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('123456'),
        ]);

        // Make a POST request to the login API with the user's credentials
        $response = $this->postJson('/api/v1/login', [
            'email' => 'user@example.com',
            'password' => '123456',
        ]);

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        $response->assertJsonStructure([
        'msg',
        'data'  => [
            'user' => [
                'id',
                'name',
                'email',
                'tasks',
            ]
        ],
    ]);
    }

    public function testUserCannotLoginWithInvalidCredentials()
    {
        // Make a POST request to the login API with invalid credentials
        $response = $this->postJson('/api/v1/login', [
            'email' => 'invalid@example.com',
            'password' => 'password',
        ]);

        // Assert that the response has a 422 status code
        $response->assertStatus(422);

        // Assert that the response contains an error message
        $response->assertJsonStructure([
            'data',
            'msg'
        ]);
    }

    public function testUserCanRegister()
    {
        // Generate random user data
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'secret',
        ];

        // Make a POST request to the register API with the user data
        $response = $this->postJson('/api/v1/register', $userData);

        // Assert that the response has a 201 status code
        $response->assertStatus(200);

        // Assert that the user was created
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);

        // Assert that the user's password was hashed
        $user = User::where('email', $userData['email'])->first();
        $this->assertTrue(Hash::check('secret', $user->password));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'msg',
            'data'  => [
                'id',
                'name',
                'email',
                'tasks',
            ],
        ]);

        // Assert that the created user matches the expected data
        $response->assertJson([
            'data'  => [
                'name' => $userData['name'],
                'email' => $userData['email'],
            ]
        ]);
    }
}
