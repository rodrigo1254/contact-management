<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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

        //email unico
        $response->assertStatus(500)
                 ->assertJson(['status' => false]);

        $email = 'rodrigo' . rand(0, 100) . '@gmail.com';
        $response = $this->post('/contacts', [
            'nome' => 'Novo Contato aleatorio',
            'contato' => rand(100000000, 999999999),
            'email' => $email
        ]);

        //email unico
        $response->assertStatus(200)
                 ->assertJson(['status' => true]);
    }
}
