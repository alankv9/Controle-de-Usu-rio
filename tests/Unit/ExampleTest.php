<?php
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    public function test_with_session_data()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $response->assertStatus(200);
    }
}
