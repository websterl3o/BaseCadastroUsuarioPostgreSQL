<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('api_login')]
    #[Group('api')]
    #[TestDox('Try login user with invalid email address')]
    public function test_login_user_with_invalid_email_address()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'invalid-email',
            'password' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'errors' => [
                'email' => [
                    'O campo e-mail deve ser um endereço de e-mail válido.'
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_login')]
    #[Group('api')]
    #[TestDox('Try login user with invalid password')]
    public function test_login_user_with_invalid_password()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Credenciais inválidas.'
        ]);
    }

    #[Test]
    #[Group('api_login')]
    #[Group('api')]
    #[TestDox('Try login user with missing email')]
    public function test_login_user_with_missing_email()
    {
        $response = $this->postJson('/api/login', [
            'password' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
        $response->assertJson([
            'message' => "O campo e-mail é obrigatório.",
            'errors' => [
                'email' => [
                    'O campo e-mail é obrigatório.'
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_login')]
    #[Group('api')]
    #[TestDox('Try login user with missing password')]
    public function test_login_user_with_missing_password()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@test.com',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
        $response->assertJson([
            'message' => 'O campo senha é obrigatório.',
            'errors' => [
                'password' => [
                    'O campo senha é obrigatório.'
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_login')]
    #[Group('api')]
    #[TestDox('Successfully login user with valid credentials')]
    public function test_successfully_login_user_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'user' => [
                'name',
                'email',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
