<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificarIngresoDatosClientesTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingreso_exitoso_de_cliente()
    {
        // Datos válidos para crear un cliente
        $data = [
            'dni' => '12345678',
            'nombre' => 'Cliente Prueba',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un cliente
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.store'), $data);

        // Verificar que el cliente fue creado exitosamente y redirecciona a la página de registro
        $response->assertRedirect(route('clientes.registrar'));
        $this->assertDatabaseHas('clientes', $data);
    }

    public function test_error_al_faltar_dni()
    {
        // Datos sin el campo dni
        $data = [
            'nombre' => 'Cliente Sin DNI',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un cliente sin DNI
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.store'), $data);

        // Verificar que se recibe un error de validación
        $response->assertSessionHasErrors('dni');
    }

    public function test_error_dni_duplicado()
    {
        // Crear un cliente con un DNI específico
        $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.store'), [
            'dni' => '87654321',
            'nombre' => 'Cliente Existente',
            'telefono' => '123456789',
            'direccion' => 'Avenida Principal 456',
            'estado' => 'Activo',
        ]);

        // Intentar crear un cliente con el mismo DNI
        $data = [
            'dni' => '87654321',
            'nombre' => 'Cliente Duplicado',
            'telefono' => '987654321',
            'direccion' => 'Calle Nueva 789',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.store'), $data);

        // Verificar que se recibe un error de validación por DNI duplicado
        $response->assertSessionHasErrors('dni');
    }

    public function test_error_al_faltar_nombre()
    {
        // Datos sin el campo nombre
        $data = [
            'dni' => '23456789',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un cliente sin nombre
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.store'), $data);

        // Verificar que se recibe un error de validación
        $response->assertSessionHasErrors('nombre');
    }

    public function test_error_al_faltar_estado()
    {
        // Datos sin el campo estado
        $data = [
            'dni' => '34567890',
            'nombre' => 'Cliente Sin Estado',
            'telefono' => '987654321',
            'direccion' => 'Calle Nueva 456',
        ];

        // Ejecutar la petición POST para crear un cliente sin estado
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.store'), $data);

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
