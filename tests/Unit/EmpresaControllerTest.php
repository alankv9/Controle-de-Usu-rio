<?php

namespace Tests\Feature;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaControllerTest extends TestCase
{
    use RefreshDatabase;

    // Teste de listagem de empresas
    public function test_index_returns_empresas(): void
    {
        $admin = User::factory()->create();
        $empresa1 = Empresa::factory()->create(['name' => 'Empresa A']);
        $empresa2 = Empresa::factory()->create(['name' => 'Empresa B']);

        $response = $this->actingAs($admin)->get(route('empresa.index'));

        $response->assertStatus(200);
        $response->assertSee('Empresa A');
        $response->assertSee('Empresa B');
    }

    // Teste de criação de empresa
    public function test_store_creates_empresa(): void
    {
        $admin = User::factory()->create();

        $formData = [
            'name' => 'Nova Empresa',
            'cnpj' => '12.345.678/0001-90',
            'email' => 'empresa@exemplo.com',
        ];

        $response = $this->actingAs($admin)->post(route('empresa.store'), $formData);

        $response->assertRedirect(route('empresa.index'));
        $this->assertDatabaseHas('empresas', [
            'name' => 'Nova Empresa',
            'cnpj' => '12.345.678/0001-90',
            'email' => 'empresa@exemplo.com',
        ]);
    }

    // Teste de erro de validação ao tentar criar uma empresa com dados inválidos
    public function test_store_fails_with_invalid_data(): void
    {
        $admin = User::factory()->create();

        $formData = [
            'name' => '',
            'cnpj' => 'invalid-cnpj',
            'email' => 'not-an-email',
        ];

        $response = $this->actingAs($admin)->post(route('empresa.store'), $formData);

        $response->assertSessionHasErrors(['name', 'cnpj', 'email']);
        $this->assertDatabaseMissing('empresas', ['email' => 'not-an-email']);
    }

    // Teste de exibição dos detalhes de uma empresa
    public function test_show_displays_empresa_details(): void
    {
        $admin = User::factory()->create();
        $empresa = Empresa::factory()->create(['name' => 'Empresa Exemplo']);

        $response = $this->actingAs($admin)->get(route('empresa.show', $empresa->id));

        $response->assertStatus(200);
        $response->assertSee('Empresa Exemplo');
    }

    // Teste de atualização de dados da empresa (sem alteração)
    public function test_update_empresa_data_no_changes(): void
    {
        $admin = User::factory()->create();
        $empresa = Empresa::factory()->create([
            'name' => 'Empresa Antiga',
            'email' => 'antiga@empresa.com',
            'cnpj' => '12.345.678/0001-90'
        ]);

        $response = $this->actingAs($admin)->put(route('empresa.update', $empresa->id), [
            'name' => 'Empresa Antiga',
            'email' => 'antiga@empresa.com',
            'cnpj' => '12.345.678/0001-90',
        ]);

        $response->assertRedirect(route('empresa.show', $empresa->id));
        $response->assertSessionHas('info', 'Nenhuma alteração foi feita nos dados da empresa.');
    }

    // Teste de atualização de dados da empresa (com alterações)
    public function test_update_empresa_data_with_changes(): void
    {
        $admin = User::factory()->create();
        $empresa = Empresa::factory()->create([
            'name' => 'Empresa Antiga',
            'email' => 'antiga@empresa.com',
            'cnpj' => '12.345.678/0001-90'
        ]);

        $response = $this->actingAs($admin)->put(route('empresa.update', $empresa->id), [
            'name' => 'Empresa Atualizada',
            'email' => 'atualizada@empresa.com',
            'cnpj' => '12.345.678/0001-91',
        ]);

        $response->assertRedirect(route('empresa.show', $empresa->id));
        $this->assertDatabaseHas('empresas', ['name' => 'Empresa Atualizada']);
    }

    // Teste de exclusão de empresa
    public function test_destroy_deletes_empresa(): void
    {
        $admin = User::factory()->create();
        $empresa = Empresa::factory()->create();

        $response = $this->actingAs($admin)->delete(route('empresa.destroy', $empresa->id));

        $response->assertRedirect(route('empresa.index'));
        $this->assertDatabaseMissing('empresas', ['id' => $empresa->id]);
    }

    // Teste de vinculação de usuário a empresa
    public function test_cadastra_usuario_empresa(): void
    {
        $admin = User::factory()->create();
        $empresa = Empresa::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('empresa.cadastraUsuarioEmpresa', $empresa->id), [
            'user_id' => $user->id,
            'empresa_id' => $empresa->id,
        ]);

        $response->assertRedirect()->with('success', 'Usuário vinculado à empresa com sucesso!');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'empresa_id' => $empresa->id]);
    }

    // Teste de erro ao tentar vincular usuário a empresa já existente
    public function test_cadastra_usuario_empresa_already_assigned(): void
    {
        $admin = User::factory()->create();
        $empresa = Empresa::factory()->create();
        $user = User::factory()->create(['empresa_id' => $empresa->id]);

        $response = $this->actingAs($admin)->post(route('empresa.cadastraUsuarioEmpresa', $empresa->id), [
            'user_id' => $user->id,
            'empresa_id' => $empresa->id,
        ]);

        $response->assertRedirect()->with('error', 'Este usuário já está vinculado a uma empresa.');
    }

    // Teste de erro de validação ao tentar vincular usuário a empresa com dados inválidos
    public function test_cadastra_usuario_empresa_validation_error(): void
    {
        $admin = User::factory()->create();
        $empresa = Empresa::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('empresa.cadastraUsuarioEmpresa', $empresa->id), [
            'user_id' => '',
            'empresa_id' => 'invalid-id',
        ]);

        $response->assertSessionHasErrors(['user_id', 'empresa_id']);
    }
}
