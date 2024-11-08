<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Proveedores;
use App\Models\Categorias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificarIngresoDatosProductosTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingreso_exitoso_de_producto()
    {
        $proveedor = Proveedores::factory()->create([
            'ruc' => '12345678901',
            'nombre' => 'Proveedor Prueba',
            'telefono' => '987654321',
            'correo' => 'proveedor@ejemplo.com',
            'direccion' => 'Calle Prueba 123',
            'estado' => 'Activo',
        ]);

        $categoria = Categorias::factory()->create();

        $data = [
            'codigo' => 'P001',
            'descripcion' => 'Producto de Prueba',
            'precio_compra' => 100.00,
            'precio_venta' => 150.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('productos.store'), $data);

        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', $data);
    }

    public function test_error_al_faltar_codigo()
    {
        $proveedor = Proveedores::factory()->create(['correo' => 'sin_codigo@ejemplo.com']);
        $categoria = Categorias::factory()->create();

        $data = [
            'descripcion' => 'Producto Sin Codigo',
            'precio_compra' => 100.00,
            'precio_venta' => 150.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('productos.store'), $data);
        $response->assertSessionHasErrors('codigo');
    }

    public function test_error_al_faltar_precio_compra()
    {
        $proveedor = Proveedores::factory()->create(['correo' => 'sin_precio_compra@ejemplo.com']);
        $categoria = Categorias::factory()->create();

        $data = [
            'codigo' => 'P002',
            'descripcion' => 'Producto Sin Precio Compra',
            'precio_venta' => 150.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('productos.store'), $data);
        $response->assertSessionHasErrors('precio_compra');
    }

    public function test_error_precio_venta_no_numerico()
    {
        $proveedor = Proveedores::factory()->create(['correo' => 'precio_no_numerico@ejemplo.com']);
        $categoria = Categorias::factory()->create();

        $data = [
            'codigo' => 'P003',
            'descripcion' => 'Producto Precio Venta No Numerico',
            'precio_compra' => 100.00,
            'precio_venta' => 'no-numerico',
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Activo',
        ];

        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('productos.store'), $data);
        $response->assertSessionHasErrors('precio_venta');
    }

    public function test_error_al_estado_incorrecto()
    {
        $proveedor = Proveedores::factory()->create(['correo' => 'estado_incorrecto@ejemplo.com']);
        $categoria = Categorias::factory()->create();

        $data = [
            'codigo' => 'P005',
            'descripcion' => 'Producto Estado Incorrecto',
            'precio_compra' => 100.00,
            'precio_venta' => 150.00,
            'id_proveedor' => $proveedor->id,
            'id_categoria' => $categoria->id,
            'estado' => 'Pendiente',
        ];

        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('productos.store'), $data);
        $response->assertSessionHasErrors('estado');
    }

    private function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        return $this->actingAs($user);
    }
}
