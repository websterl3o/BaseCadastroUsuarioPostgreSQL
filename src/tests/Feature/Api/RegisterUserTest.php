<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with name less than 2 characters')]
    public function test_register_user_with_name_less_than_2_characters()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'a',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
        $response->assertJson([
            'message' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'errors' => [
                'name' => [
                    'O campo nome deve ter no mínimo 3 caracteres.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with name more than 50 characters')]
    public function test_register_user_with_name_more_than_50_characters()
    {
        $response = $this->postJson('/api/register', [
            'name' => str_repeat('a', 51),
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
        $response->assertJson([
            'message' => 'O campo nome deve ter no máximo 50 caracteres.',
            'errors' => [
                'name' => [
                    'O campo nome deve ter no máximo 50 caracteres.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with invalid email address')]
    public function test_register_user_with_invalid_email_address()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
        $response->assertJson([
            'message' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'errors' => [
                'email' => [
                    'O campo e-mail deve ser um endereço de e-mail válido.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with email more than 255 characters')]
    public function test_register_user_with_email_more_than_255_characters()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => str_repeat('a', 256).'@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
        $response->assertJson([
            'message' => 'O campo e-mail deve ter no máximo 255 caracteres.',
            'errors' => [
                'email' => [
                    'O campo e-mail deve ter no máximo 255 caracteres.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with password less than 6 characters')]
    public function test_register_user_with_password_less_than_6_characters()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => '12345',
            'password_confirmation' => '12345',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
        $response->assertJson([
            'message' => 'O campo senha deve ter no mínimo 6 caracteres.',
            'errors' => [
                'password' => [
                    'O campo senha deve ter no mínimo 6 caracteres.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with password more than 20 characters')]
    public function test_register_user_with_password_more_than_20_characters()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => str_repeat('a', 21),
            'password_confirmation' => str_repeat('a', 21),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
        $response->assertJson([
            'message' => 'O campo senha deve ter no máximo 20 caracteres.',
            'errors' => [
                'password' => [
                    'O campo senha deve ter no máximo 20 caracteres.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with password confirmation mismatch')]
    public function test_register_user_with_password_confirmation_mismatch()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'different_password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('password');
        $response->assertJson([
            'message' => 'O campo senha não confere com a confirmação.',
            'errors' => [
                'password' => [
                    'O campo senha não confere com a confirmação.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Try register user with duplicate email')]
    public function test_register_user_with_duplicate_email()
    {
        User::factory()->create(['email' => 'test@test.com']);

        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
        $response->assertJson([
            'message' => 'O campo e-mail já está em uso.',
            'errors' => [
                'email' => [
                    'O campo e-mail já está em uso.',
                ]
            ]
        ]);
    }

    #[Test]
    #[Group('api_register_user')]
    #[Group('api')]
    #[TestDox('Successfully register user with valid data')]
    public function test_successfully_register_user_with_valid_data()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Valid User',
            'email' => 'validuser@test.com',
            'password' => 'validpassword',
            'password_confirmation' => 'validpassword',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'user' => [
                'name',
                'email',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
