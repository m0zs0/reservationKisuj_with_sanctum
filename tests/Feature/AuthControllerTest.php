<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_register()
    {
        // Arrange
        $payload = [
            'name' => 'Teszt Elek',
            'email' => 'teszt@example.com',
            'password' => 'jelszo123',
            'password_confirmation' => 'jelszo123',
        ];

        // Act
        $response = $this->postJson('/api/register', $payload);

        // Assert
        $response->assertStatus(201)
                 ->assertJsonStructure(['user', 'message']);
        $this->assertDatabaseHas('users', ['email' => 'teszt@example.com']);
    }

    #[Test]
    public function user_can_login_and_receive_token()
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'teszt@example.com',
            'password' => bcrypt('password'),
        ]);

        $credentials = [
            'email' => 'teszt@example.com',
            'password' => 'password',
        ];

        // Act
        $response = $this->postJson('/api/login', $credentials);

        // Assert
        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token', 'token_type']);
    }

    #[Test]
    public function user_can_logout()
    {
        // Arrange
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Act
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/logout');

        // Assert
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Sikeres kijelentkezés!']);
    }


}
