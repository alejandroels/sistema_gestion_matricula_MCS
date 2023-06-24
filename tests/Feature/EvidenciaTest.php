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
use App\Matricula;
use App\Evidencia;
use Illuminate\Foundation\Testing\Concerns\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class EvidenciaTest extends TestCase
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
    public function autenticar_usuario()
    {
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user',
        ]);

        $this->get('/login')->assertSee('Autenticar');
        $credentials = [
            "email" => "user@gmail.com",
            "password" => "user",
        ];

        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/');
        $this->assertCredentials($credentials);
    }


/** @test */
public function crear_evidencia()
{

    $user = User::create([
        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => 'user',
    ]);

    // Autenticar el usuario en la aplicación
    $this->get('/login')->assertSee('Autenticar');
    $credentials = [
        "email" => "user@gmail.com",
        "password" => "user",
    ];

    $response = $this->post('/login', $credentials);
    $response->assertRedirect('/');
    $this->assertCredentials($credentials);

    // // Autenticar el usuario en la aplicación
    //$this->actingAs($user);

    // Crear una nueva instancia de Evidencia utilizando el método store de EvidenciaController
    $newData = [
        'Nombre' => 'Juan',
        'Apellido' => 'Pérez',
        'AnnoGraduado' => '2020',
        'Direccion' => 'Calle 123',
        'AreaTrabajo' => 'Desarrollo de software',
        'EdicionMaestria' => '2020-2022',
    ];

    // Simular una petición POST para crear la nueva instancia de Evidencia
    $response = $this->post(route('evidencias.store'), $newData);

    // Obtener la instancia de Evidencia creada
    $evidencia = Evidencia::orderBy('created_at', 'desc')->first();

    // Verificar que la Evidencia se haya creado correctamente
    $this->assertNotNull($evidencia, 'La instancia de Evidencia no se ha creado correctamente.');
    $this->assertDatabaseHas('evidencias', $newData + ['id' => $evidencia->id]);
}

/** @test */
public function autenticar_usuario_y_crear_evidencia()
{
    // Crear un usuario de prueba
    $user = User::create([
        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => 'user',
    ]);

    // Autenticar el usuario
    $credentials = [
        "email" => "user@gmail.com",
        "password" => "user",
    ];
    $response = $this->post('/login', $credentials);
    $response->assertRedirect('/');
    $this->assertCredentials($credentials);

    // Crear una nueva instancia de Evidencia
    $evidencia = Evidencia::create([
        'Nombre' => 'Juan',
        'Apellido' => 'Pérez',
        'AnnoGraduado' => '2020',
        // 'FotocopiaTitulo'=>'image.jpg',
        // 'ActaSolicitud' => 'imagen3.jpg',
        'Direccion' => 'Calle 123',
        'AreaTrabajo' => 'Desarrollo de software',
        'EdicionMaestria' => '2020-2022',
        'user_id' => $user->id,
    ]);

    // Verificar que la Evidencia se haya creado correctamente
    $this->assertDatabaseHas('evidencias', [
        'Nombre' => 'Juan',
        'Apellido' => 'Pérez',
        'AnnoGraduado' => 2020,
        'Direccion' => 'Calle 123',
        // 'FotocopiaTitulo'=>'image.jpg',
        // 'ActaSolicitud' => 'imagen3.jpg',
        'AreaTrabajo' => 'Desarrollo de software',
        'EdicionMaestria' => '2020-2022',
        'user_id' => $user->id,
    ]);
}

/** @test */
public function crear_evidencia_campos_vacios()
{
    // Crear un usuario de prueba
    $user = User::create([
        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => 'user',
    ]);

    // Autenticar el usuario
    $credentials = [
        "email" => "user@gmail.com",
        "password" => "user",
    ];
    $response = $this->post('/login', $credentials);
    $response->assertRedirect('/');
    $this->assertCredentials($credentials);

    // Crear una nueva instancia de Evidencia
    $evidencia = Evidencia::create([
        // 'Nombre' => 'Juan',
        'Apellido' => 'Pérez',
        'AnnoGraduado' => '2020',
        // 'FotocopiaTitulo'=>'image.jpg',
        // 'ActaSolicitud' => 'imagen3.jpg',
        'Direccion' => 'Calle 123',
        'AreaTrabajo' => 'Desarrollo de software',
        'EdicionMaestria' => '2020-2022',
        'user_id' => $user->id,
    ]);

    // Verificar que la Evidencia se haya creado correctamente
    $this->assertDatabaseHas('evidencias', [
        'Nombre' => 'Juan',
        'Apellido' => 'Pérez',
        'AnnoGraduado' => 2020,
        'Direccion' => 'Calle 123',
        // 'FotocopiaTitulo'=>'image.jpg',
        // 'ActaSolicitud' => 'imagen3.jpg',
        'AreaTrabajo' => 'Desarrollo de software',
        'EdicionMaestria' => '2020-2022',
        'user_id' => $user->id,
    ]);
}

/** @test */
public function crear_evidencia_campos_invalidos()
{
    // Crear un usuario de prueba
    $user = User::create([
        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => 'user',
    ]);

    // Autenticar el usuario
    $credentials = [
        "email" => "user@gmail.com",
        "password" => "user",
    ];
    $response = $this->post('/login', $credentials);
    $response->assertRedirect('/');
    $this->assertCredentials($credentials);

    // Crear una nueva instancia de Evidencia
    $evidencia = Evidencia::create([
        'Nombre' => '12312',
        'Apellido' => 'Pérez',
        'AnnoGraduado' => '2020',
        // 'FotocopiaTitulo'=>'image.jpg',
        // 'ActaSolicitud' => 'imagen3.jpg',
        'Direccion' => 'Calle 123',
        'AreaTrabajo' => 'Desarrollo de software',
        'EdicionMaestria' => '2020-2022',
        'user_id' => $user->id,
    ]);

    // Verificar que la Evidencia se haya creado correctamente
    $this->assertDatabaseHas('evidencias', [
        'Nombre' => 'Juan',
        'Apellido' => 'Pérez',
        'AnnoGraduado' => 2020,
        'Direccion' => 'Calle 123',
        // 'FotocopiaTitulo'=>'image.jpg',
        // 'ActaSolicitud' => 'imagen3.jpg',
        'AreaTrabajo' => 'Desarrollo de software',
        'EdicionMaestria' => '2020-2022',
        'user_id' => $user->id,
    ]);
}


 /** @test */
 public function registrar_una_evidencia_metodo_store()
 {
     // Obtener el usuario predefinido de la base de datos
     $user = User::where('email', 'user@gmail.com')->first();
     
     $this->get('/login')->assertSee('Autenticar');
     $credentials = [
         "email" => "user@gmail.com",
         "password" => "user",
     ];

     $response = $this->post('/login', $credentials);
     $response->assertRedirect('/');
     $this->assertCredentials($credentials);

    
    //  // Crear una nueva instancia de Evidencia
    //  $evidenciaData = Evidencia::create([
    //      'Nombre' => 'Juan',
    //      'Apellido' => 'Pérez',
    //      'AnnoGraduado' => '2020',
    //      'FotocopiaTitulo'=>'image.jpg',
    //      'ActaSolicitud' => 'imagen3.jpg',
    //      'Direccion' => 'Calle 123',
    //      'AreaTrabajo' => 'Desarrollo de software',
    //      'EdicionMaestria' => '2020-2022',
    //      'user_id' => $user->id,
    //  ]);
 
     // Crear una nueva instancia de Evidencia
     $evidenciaData = [
        'Nombre' => 'Juan',
        'Apellido' => 'Perez',
        'AnnoGraduado' => 2020,
        'Direccion' => 'Calle 123',
        'AreaTrabajo' => 'Desarrollo de software',
        // 'FotocopiaTitulo' => 'Titulo.png',
        // 'ActaSolicitud' => 'Acta.jpeg', 
        'EdicionMaestria' => '2020-2022',
        // 'user_id' => $user->id,
     ];

     $response = $this->post(route('evidencias.store'), $evidenciaData);
     
     
     // Verificar que la Evidencia se haya creado correctamente
    
        $this->assertDatabaseHas('evidencias', $evidenciaData + ['Estado' => 'nuevo', 'user_id' => $user->id]);

    // $this->assertDatabaseHas('evidencias', [
    //     'Nombre' => 'Juan',
    //     'Apellido' => 'Pérez',
    //     'AnnoGraduado' => 2020,
    //     'Direccion' => 'Calle 123',
    //     'AreaTrabajo' => 'Desarrollo de software',
    //     // 'FotocopiaTitulo'=>'image.jpg',
    //     // 'ActaSolicitud' => 'imagen3.jpg',
    //     'EdicionMaestria' => '2020-2022',
    //     'user_id' => $user->id,
    // ]);
}

 

 



/** @test */
public function eliminar_evidencia()
{
    // Obtener un usuario predefinido de la base de datos
    $user = User::where('email', 'user@gmail.com')->first();

    // Crear manualmente una sesión de usuario
    $this->session(['user_id' => $user->id]);

    // Obtener una instancia existente de Evidencia para el usuario predefinido
    $evidencia = Evidencia::where('user_id', $user->id)->first();

    // Llamar al método destroy de EvidenciaController para eliminar la Evidencia
    $response = $this->delete(route('evidencias.destroy', $evidencia));

    // Verificar que la Evidencia haya sido eliminada correctamente
    $this->assertDatabaseMissing('evidencias', ['id' => $evidencia->id]);
}



}
