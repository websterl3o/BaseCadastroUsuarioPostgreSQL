<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('api_logout')]
    #[Group('api')]
    #[TestDox('Try logout user without authentication')]
    public function test_logout_user_without_authentication()
    {
        $response = $this->postJson('/api/logout');

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    #[Test]
    #[Group('api_logout')]
    #[Group('api')]
    #[TestDox('Try logout user with authentication')]
    public function test_logout_user_with_authentication()
    {
        $user = User::factory()->create();

        $bearerToken = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withToken($bearerToken)->postJson('/api/logout');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Logout realizado com sucesso.'
        ]);
    }
}
