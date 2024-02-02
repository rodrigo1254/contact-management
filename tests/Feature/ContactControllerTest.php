<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Contact;

class ContactControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_store_a_contact_with_unique_email()
    {

        $response = $this->post('/contacts', [
            'nome' => 'Novo Contato',
            'contato' => '123456789',
            'email' => 'rodrigo1254@gmail.com',
        ]);

        // Deve retornar 500 indicando que o e-mail não é único
        $response->assertStatus(500)
                 ->assertJson(['status' => false]);

        /*// Agora tenta adicionar um contato com e-mail único
        $response = $this->post('/contacts', [
            'nome' => 'Outro Contato',
            'contato' => '987654321',
            'email' => 'novoemail@example.com',
        ]);

        // Deve retornar um status 200 indicando sucesso
        $response->assertStatus(200)
                 ->assertJson(['status' => true]);

        // Verifica se o novo contato foi adicionado ao banco de dados
        $this->assertDatabaseHas('contacts', [
            'nome' => 'Outro Contato',
            'contato' => '987654321',
            'email' => 'novoemail@example.com',
        ]);*/
    }
}
