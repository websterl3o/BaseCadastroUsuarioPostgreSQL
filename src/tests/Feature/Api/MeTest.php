<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('api_me')]
    #[Group('api')]
    #[TestDox('Try get user profile without authentication')]
    public function test_get_user_profile_without_authentication()
    {
        $response = $this->getJson('/api/me');

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    #[Test]
    #[Group('api_me')]
    #[Group('api')]
    #[TestDox('Try get user profile with authentication')]
    public function test_get_user_profile_with_authentication()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/me');

        $response->assertStatus(200);
        $response->assertJson([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }
}
