<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;


class UserTest extends TestCase
{

    use InteractsWithDatabase;
    // use DatabaseMigrations;
    // use RefreshDatabase;
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
public function crear_usuario()
{
    $user = User::create([
        'name' => 'usuario',
        'email' => 'usuario@gmail.com',
        'password' => bcrypt('usuario'),
    ]);

    $this->assertNotNull($user); // verifica que el usuario no sea nulo
    $this->assertEquals('usuario', $user->name); // verifica que el nombre del usuario sea 'usuario'
    $this->assertEquals('usuario@gmail.com', $user->email); // verifica que el correo electrónico del usuario sea 'usuario@gmail.com'
}



        /** @test */
        public function registrar_usuario_existente()
        {
            $user = User::create([
                'name' => 'usuario',
                'email' => 'usuario@gmail.com',
                'password' => bcrypt('user'),
            ]);
    
            $this->assertNotNull($user); // verifica que el usuario no sea nulo
            $this->assertEquals('usuario', $user->name); // verifica que el nombre del usuario sea 'usuario'
            $this->assertEquals('usuario@gmail.com', $user->email); // verifica que el correo electrónico del usuario sea 'usuario@gmail.com'
         
        }

/** @test */
public function modificar_usuario()
{
    // Crea un usuario para modificar
    $user = User::where('email', 'usuario@gmail.com')->first();
    
    // Modifica el nombre y el correo electrónico del usuario
    $user->name = 'usuario_modificado';
    $user->email = 'usuario_modificado@gmail.com';
    $user->save();
    
    // Verifica que los cambios se hayan guardado correctamente
    $this->assertEquals('usuario_modificado', $user->name);
    $this->assertEquals('usuario_modificado@gmail.com', $user->email);
}    


/** @test */
public function eliminar_usuario()
{
    // Crea un usuario para eliminar
    $user = User::create([
        'name' => 'usuarioaeliminar',
        'email' => 'usuarioaeliminar@gmail.com',
        'password' => bcrypt('usuarioaeliminar'),
    ]);
    
    // Elimina el usuario
    $user->delete();
    
    // Verifica que el usuario se haya eliminado correctamente
    $this->assertNull(User::find($user->id));
}
    
}
