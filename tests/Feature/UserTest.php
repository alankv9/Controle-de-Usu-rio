<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_example(): void{

        $user = User::factory()->create([
            'email_verified_at' => now()
        ]);
    
        $response = $this->actingAs($user)->followingRedirects()->get('/');
        $response->assertStatus(200);
    }

    public function test_interacting_with_the_session(){

        $user = User::factory()->create([
            'email_verified_at' => now()
        ]);

        $response = $this->withSession(['banned' => false])->get('/');
        $response->assertStatus(200);

    }
    
    
}
