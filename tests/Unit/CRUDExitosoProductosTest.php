<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Categorias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoProductosTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_exitoso_de_producto()
    {
        // Crear un proveedor y una categoría de prueba
        $proveedor = Proveedores::factory()->create([
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Prueba',
            'telefono' => '987654321',
            'correo' => 'proveedor@ejemplo.com',
            'direccion' => 'Calle Prueba 123',
            'estado' => 'Activo',
        ]);

        $categoria = Categorias::factory()->create();

        // Datos de prueba para el registro de un producto
        $data = [
            'codigo' => 'P001',
            'descripcion' => 'Producto de Prueba',
            'precio_compra' => 100.00,
            'precio_venta' => 150.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear un producto
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('productos.store'), $data);

        // Verificar que el producto fue creado exitosamente
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', $data);
    }

    public function test_actualizacion_exitosa_de_producto()
    {
        // Crear un proveedor, una categoría y un producto de prueba
        $proveedor = Proveedores::factory()->create([
            'ruc' => '10987654321',
            'nombre' => 'Proveedor Actual',
            'telefono' => '123456789',
            'correo' => 'actual@ejemplo.com',
            'direccion' => 'Calle Principal 456',
            'estado' => 'Activo',
        ]);

        $categoria = Categorias::factory()->create();

        $producto = Producto::factory()->create([
            'codigo' => 'P002',
            'descripcion' => 'Producto Inicial',
            'precio_compra' => 50.00,
            'precio_venta' => 75.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ]);

        // Nuevos datos para la actualización
        $data = [
            'codigo' => 'P002',
            'descripcion' => 'Producto Actualizado',
            'precio_compra' => 55.00,
            'precio_venta' => 80.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Inactivo',
        ];

        // Ejecutar la petición POST para actualizar el producto
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('productos.actualizar', $producto->id), $data);

        // Verificar que el producto fue actualizado correctamente
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', $data);
    }

    public function test_eliminar_producto_exitoso()
    {
        // Crear un proveedor, una categoría y un producto de prueba
        $proveedor = Proveedores::factory()->create([
            'correo' => 'eliminar@ejemplo.com',
        ]);

        $categoria = Categorias::factory()->create();

        $producto = Producto::factory()->create([
            'codigo' => 'P003',
            'descripcion' => 'Producto a Eliminar',
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ]);

        // Ejecutar la petición para eliminar el producto (marcar como inactivo)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('productos.eliminar', $producto->id));

        // Verificar que el producto fue marcado como inactivo
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'estado' => 'Inactivo',
        ]);
    }

    public function test_reingreso_producto_exitoso()
    {
        // Crear un proveedor, una categoría y un producto de prueba inactivo
        $proveedor = Proveedores::factory()->create([
            'correo' => 'reingreso@ejemplo.com',
        ]);

        $categoria = Categorias::factory()->create();

        $producto = Producto::factory()->create([
            'codigo' => 'P004',
            'descripcion' => 'Producto Inactivo',
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Inactivo',
        ]);

        // Ejecutar la petición para reingresar el producto (marcar como activo)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('productos.reingresar', $producto->id));

        // Verificar que el producto fue marcado como activo
        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
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
