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


class MatriculaTest extends TestCase
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
public function crear_matricula()
{



    // Envía una solicitud POST al controlador para crear una nueva matrícula
    $matricula = Matricula::create([
        'Estado' => 'en proceso',
        'NoRegistro' => 12345,
        'AreaTrabajo' => 'Desarrollo web',
        'FechaInicio' => '2023-07-01',
        'FechaFin' => '2023-12-31',
        'evidencia_id' => 3,
    ]);
    // Verifica que la matrícula se haya creado correctamente
    
    $this->assertNotNull($matricula); // verifica que la matrícula no sea nula
    $this->assertEquals('en proceso', $matricula->Estado); // verifica el estado de la matrícula
    $this->assertEquals(12345, $matricula->NoRegistro); // verifica el número de registro de la matrícula
    $this->assertEquals('Desarrollo web', $matricula->AreaTrabajo); // verifica el área de trabajo de la matrícula
    $this->assertEquals('2023-07-01', $matricula->FechaInicio); // verifica la fecha de inicio de la matrícula
    $this->assertEquals('2023-12-31', $matricula->FechaFin); // verifica la fecha de fin de la matrícula
    $this->assertEquals(3, $matricula->evidencia_id); // verifica el id de la evidencia asociada a la matrícula
}

/** @test */
public function modificar_matricula()
{
    // Crea una nueva matrícula
    $matricula = Matricula::create([
        'Estado' => 'en proceso',
        'NoRegistro' => 12345,
        'AreaTrabajo' => 'Desarrollo web',
        'FechaInicio' => '2023-07-01',
        'FechaFin' => '2023-12-31',
        'evidencia_id' => 3,
    ]);

    // Modifica la matrícula
    $matricula->update([
        'Estado' => 'terminado',
        'AreaTrabajo' => 'Diseño gráfico',
    ]);

    // Verifica que la matrícula se haya modificado correctamente
    $this->assertEquals('terminado', $matricula->Estado); // verifica el estado de la matrícula
    $this->assertEquals('Diseño gráfico', $matricula->AreaTrabajo); // verifica el área de trabajo de la matrícula
}

/** @test */
public function eliminar_matricula()
{
    // Crea una nueva matrícula
    $matricula = Matricula::create([
        'Estado' => 'en proceso',
        'NoRegistro' => 12345,
        'AreaTrabajo' => 'Desarrollo web',
        'FechaInicio' => '2023-07-01',
        'FechaFin' => '2023-12-31',
        'evidencia_id' => 3,
    ]);

    // Elimina la matrícula
    $matricula->delete();

    // Verifica que la matrícula haya sido eliminada correctamente
    $this->assertNull(Matricula::find($matricula->id)); // verifica que no se pueda encontrar la matrícula eliminada en la base de datos
}

}
