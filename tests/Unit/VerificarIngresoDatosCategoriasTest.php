<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificarIngresoDatosCategoriasTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingreso_exitoso_de_categoria()
    {
        // Datos válidos para crear una categoría
        $data = [
            'nombre' => 'Categoria Valida',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear una categoría
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('categorias.store'), $data);

        // Verificar que la categoría fue creada exitosamente y redirecciona a la página de registro
        $response->assertRedirect(route('categorias.registrar'));
        $this->assertDatabaseHas('categorias', $data);
    }

    public function test_error_al_faltar_nombre()
    {
        // Datos sin el campo nombre
        $data = [
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear una categoría con datos incompletos
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('categorias.store'), $data);

        // Verificar que se recibe un error de validación
        $response->assertSessionHasErrors('nombre');
    }

    public function test_error_al_faltar_estado()
    {
        // Datos sin el campo estado
        $data = [
            'nombre' => 'Categoria Sin Estado',
        ];

        // Ejecutar la petición POST para crear una categoría con datos incompletos
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('categorias.store'), $data);

        // Verificar que se recibe un error de validación
        $response->assertSessionHasErrors('estado');
    }

    public function test_error_al_estado_incorrecto()
    {
        // Datos con un valor no válido en el campo estado
        $data = [
            'nombre' => 'Categoria Estado Invalido',
            'estado' => 'Pendiente',
        ];

        // Ejecutar la petición POST para crear una categoría con un estado no permitido
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('categorias.store'), $data);

        // Verificar que se recibe un error de validación
        $response->assertSessionHasErrors('estado');
    }

    private function actingAsAdmin()
    {
        // Crear un usuario con rol de administrador y autenticarse
        $user = User::factory()->create([
            'role' => 'admin',
        ]);
        return $this->actingAs($user);
    }
}
