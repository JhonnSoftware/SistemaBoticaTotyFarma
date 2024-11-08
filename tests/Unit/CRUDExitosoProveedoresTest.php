<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Proveedores;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoProveedoresTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_exitoso_de_proveedor()
    {
        // Datos de prueba para el registro de un proveedor
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

        // Verificar que el proveedor fue creado exitosamente
        $response->assertRedirect(route('proveedores.registrar'));
        $this->assertDatabaseHas('proveedores', $data);
    }

    public function test_actualizacion_exitosa_de_proveedor()
    {
        // Crear un proveedor de prueba
        $proveedor = Proveedores::factory()->create([
            'ruc' => '10987654321',
            'nombre' => 'Proveedor Inicial',
            'telefono' => '123456789',
            'correo' => 'inicial@ejemplo.com',
            'direccion' => 'Avenida Siempre Viva 742',
            'estado' => 'Activo',
        ]);

        // Nuevos datos para la actualización
        $data = [
            'ruc' => '10987654321',
            'nombre' => 'Proveedor Actualizado',
            'telefono' => '987654321',
            'correo' => 'actualizado@ejemplo.com',
            'direccion' => 'Calle Nueva 456',
            'estado' => 'Inactivo',
        ];

        // Ejecutar la petición POST para actualizar el proveedor
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('proveedores.actualizar', $proveedor->id), $data);

        // Verificar que el proveedor fue actualizado correctamente
        $response->assertRedirect(route('proveedores.index'));
        $this->assertDatabaseHas('proveedores', $data);
    }

    public function test_eliminar_proveedor_exitoso()
    {
        // Crear un proveedor de prueba con todos los campos obligatorios, incluido 'correo'
        $proveedor = Proveedores::factory()->create([
            'ruc' => '12345678901',
            'nombre' => 'Proveedor de Prueba',
            'telefono' => '123456789',
            'correo' => 'proveedor@ejemplo.com',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ]);

        // Ejecutar la petición para eliminar el proveedor (marcar como inactivo)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('proveedores.eliminar', $proveedor->id));

        // Verificar que el proveedor fue marcado como inactivo
        $response->assertRedirect(route('proveedores.index'));
        $this->assertDatabaseHas('proveedores', [
            'id' => $proveedor->id,
            'estado' => 'Inactivo',
        ]);
    }

    public function test_reingreso_proveedor_exitoso()
    {
        // Crear un proveedor de prueba inactivo con todos los campos obligatorios, incluido 'correo'
        $proveedor = Proveedores::factory()->create([
            'ruc' => '10987654321',
            'nombre' => 'Proveedor Inactivo',
            'telefono' => '987654321',
            'correo' => 'inactivo@ejemplo.com',
            'direccion' => 'Calle Nueva 456',
            'estado' => 'Inactivo',
        ]);

        // Ejecutar la petición para reingresar el proveedor (marcar como activo)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('proveedores.reingresar', $proveedor->id));

        // Verificar que el proveedor fue marcado como activo
        $response->assertRedirect(route('proveedores.index'));
        $this->assertDatabaseHas('proveedores', [
            'id' => $proveedor->id,
            'estado' => 'Activo',
        ]);
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
