<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    // Teste de listagem de usuários
    public function test_index_returns_users(): void
    {
        $admin = User::factory()->create();
        $user1 = User::factory()->create(['name' => 'João']);
        $user2 = User::factory()->create(['name' => 'Maria']);

        $response = $this->actingAs($admin)->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertSee('João');
        $response->assertSee('Maria');
    }

    // Teste de criação de usuário (com dados válidos)
    public function test_store_creates_new_user(): void
    {
        $admin = User::factory()->create();

        $formData = [
            'name' => 'Carlos',
            'email' => 'carlos@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ];

        $response = $this->actingAs($admin)->post(route('users.store'), $formData);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'carlos@example.com',
            'name' => 'Carlos',
        ]);
    }

    // Teste de erro de validação ao tentar criar um usuário com dados inválidos
    public function test_store_fails_with_invalid_data(): void
    {
        $admin = User::factory()->create();

        $formData = [
            'name' => '',
            'email' => 'not-an-email',
            'password' => '123',
            'password_confirmation' => '456',
        ];

        $response = $this->actingAs($admin)->post(route('users.store'), $formData);

        // Espera erro de validação
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertDatabaseMissing('users', ['email' => 'not-an-email']);
    }

    // Teste de visualização de detalhes de um usuário
    public function test_show_displays_user_details(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create(['name' => 'Ana']);

        $response = $this->actingAs($admin)->get(route('users.show', $user->id));

        $response->assertStatus(200);
        $response->assertSee('Ana');
    }

    // Teste de atualização de dados do usuário (sem alterar a senha)
    public function test_update_user_data(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com'
        ]);

        $response = $this->actingAs($admin)->put(route('users.update', $user->id), [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'password' => '', // sem alteração de senha
        ]);

        $response->assertRedirect(route('users.show', $user->id));
        $this->assertDatabaseHas('users', ['name' => 'New Name', 'email' => 'new@example.com']);
    }

    // Teste de atualização de senha do usuário
    public function test_update_user_password(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create([
            'password' => bcrypt('old-password'),
        ]);

        $response = $this->actingAs($admin)->put(route('users.update', $user->id), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect(route('users.show', $user->id));
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    // Teste de exclusão de usuário
    public function test_destroy_deletes_user(): void
    {
        $admin = User::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->delete(route('users.destroy', $user->id));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    // Teste de acesso não autorizado para criar usuário (usuário não autenticado)
    public function test_store_requires_authentication(): void
    {
        $formData = [
            'name' => 'Carlos',
            'email' => 'carlos@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ];

        $response = $this->post(route('users.store'), $formData);

        // Espera redirecionar para a página de login (não autenticado)
        $response->assertRedirect(route('login'));
    }

    // Teste de acesso não autorizado para editar usuário (usuário não autenticado)
    public function test_edit_requires_authentication(): void
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.edit', $user->id));

        // Espera redirecionar para a página de login (não autenticado)
        $response->assertRedirect(route('login'));
    }
}
