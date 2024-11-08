<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Clientes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoClientesTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_exitoso_de_cliente()
    {
        // Datos de prueba
        $data = [
            'dni' => '12345678',
            'nombre' => 'Juan Pérez',
            'telefono' => '987654321',
            'direccion' => 'Calle Falsa 123',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un cliente
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.store'), $data);

        // Verificar que el cliente fue creado exitosamente
        $response->assertRedirect(route('clientes.registrar'));
        $this->assertDatabaseHas('clientes', $data);
    }

    public function test_actualizacion_exitosa_de_cliente()
    {
        // Crear un cliente de prueba
        $cliente = Clientes::factory()->create([
            'dni' => '87654321',
            'nombre' => 'Maria Lopez',
            'telefono' => '123456789',
            'direccion' => 'Avenida Siempre Viva 742',
            'estado' => 'Activo',
        ]);

        // Nuevos datos
        $data = [
            'dni' => '87654321',
            'nombre' => 'Maria Lopez Actualizada',
            'telefono' => '987654321',
            'direccion' => 'Calle Nueva 456',
            'estado' => 'Inactivo',
        ];

        // Ejecutar la petición POST para actualizar el cliente
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('clientes.actualizar', $cliente->id), $data);

        // Verificar que el cliente fue actualizado correctamente
        $response->assertRedirect(route('clientes.index'));
        $this->assertDatabaseHas('clientes', $data);
    }

    public function test_eliminar_cliente_exitoso()
    {
        // Crear un cliente de prueba
        $cliente = Clientes::factory()->create([
            'estado' => 'Activo',
        ]);

        // Ejecutar la petición para eliminar el cliente (marcar como inactivo)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('clientes.eliminar', $cliente->id));

        // Verificar que el cliente fue marcado como inactivo
        $response->assertRedirect(route('clientes.index'));
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'estado' => 'Inactivo',
        ]);
    }

    public function test_reingreso_cliente_exitoso()
    {
        // Crear un cliente de prueba inactivo
        $cliente = Clientes::factory()->create([
            'estado' => 'Inactivo',
        ]);

        // Ejecutar la petición para reingresar el cliente (marcar como activo)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('clientes.reingresar', $cliente->id));

        // Verificar que el cliente fue marcado como activo
        $response->assertRedirect(route('clientes.index'));
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
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
