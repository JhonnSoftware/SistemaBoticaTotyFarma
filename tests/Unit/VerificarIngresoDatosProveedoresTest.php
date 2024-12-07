<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificarIngresoDatosProveedoresTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingreso_exitoso_de_proveedor()
    {
        // Datos válidos para crear un proveedor
        $data = [
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Prueba',
            'telefono' => '987654321',
            'correo' => 'proveedor@ejemplo.com',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un proveedor
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('proveedores.store'), $data);

        // Verificar que el proveedor fue creado exitosamente y redirecciona a la página de registro
        $response->assertRedirect(route('proveedores.registrar'));
        $this->assertDatabaseHas('proveedores', $data);
    }

    public function test_error_al_faltar_ruc()
    {
        // Datos sin el campo RUC
        $data = [
            'nombre' => 'Proveedor Sin RUC',
            'telefono' => '987654321',
            'correo' => 'sinruc@ejemplo.com',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un proveedor sin RUC
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('proveedores.store'), $data);

        // Verificar que se recibe un error de validación
        $response->assertSessionHasErrors('ruc');
    }

    public function test_error_ruc_invalido()
    {
        // Datos con un RUC inválido
        $data = [
            'ruc' => '12345',
            'nombre' => 'Proveedor RUC Invalido',
            'telefono' => '987654321',
            'correo' => 'invalido@ejemplo.com',
            'direccion' => 'Calle Nueva 456',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un proveedor con un RUC inválido
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('proveedores.store'), $data);

        // Verificar que se recibe un error de validación
        $response->assertSessionHasErrors('ruc');
    }

    public function test_error_al_faltar_estado()
    {
        // Datos sin el campo estado
        $data = [
            'ruc' => '10987654321',
            'nombre' => 'Proveedor Sin Estado',
            'telefono' => '987654321',
            'correo' => 'sinestado@ejemplo.com',
            'direccion' => 'Calle Nueva 456',
        ];

        // Ejecutar la petición POST para crear un proveedor sin estado
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('proveedores.store'), $data);

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
