<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class LoginTest extends TestCase
{

    use InteractsWithDatabase;
    /**
     * A basic feature test example.
     * 
     * @return void
     */


    /** @test */
    public function it_visit_page_of_login(){

        $this->get('/login')
            ->assertStatus(200)   
            ->assertSee('Autenticacion');
    }

    /** @test */
    public function autenticar_usuario()
    {
        $user = create('App\User', [
            "email" => "user@mail.com"
        ]);

        $this->get('/login')->assertSee('Autenticar');
        $credentials = [
            "email" => "user@mail.com",
            "password" => "secret"
        ];

        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/home');
        $this->assertCredentials($credentials);
    }

     /** @test */
     public function no_autenticar_con_credenciales_incorrectas()
     {
         $user = \App\Models\User::factory()->create([
             "email" => "user@mail.com"
         ]);
         $credentials = [
             "email" => "users@mail.com",
             "password" => "secret"
         ];
 
         $this->assertInvalidCredentials($credentials);
     }

  

/** @test */
    public function an_authenticated_user_can_create_statuses()
    {

            // 1. Given => Teniendo un usuario autenticado
            $user = factory (User::class)->create();
            $this->actingAs($user);
            // 2. When => Cuando hace un post request a status 
            $this->post(route('status.store'), ['body' => 'Mi primer status']);

            // 3. Then => Entonces veo un nuevo estado en la base de datos 

            $this->assertDatabaseHas('statuses', [

            'body' => 'Mi primer status'
            ]);
    }
}
