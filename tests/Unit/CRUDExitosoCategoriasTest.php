<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Categorias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDExitosoCategoriasTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_exitoso_de_categoria()
    {
        // Datos de prueba para el registro de una categoría
        $data = [
            'nombre' => 'Categoria Prueba',
            'estado' => 'Activo',
        ];

        // Ejecutar la petición POST para crear una categoría
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('categorias.store'), $data);

        // Verificar que la categoría fue creada exitosamente
        $response->assertRedirect(route('categorias.registrar'));
        $this->assertDatabaseHas('categorias', $data);
    }

    public function test_actualizacion_exitosa_de_categoria()
    {
        // Crear una categoría de prueba
        $categoria = Categorias::factory()->create([
            'nombre' => 'Categoria Inicial',
            'estado' => 'Activo',
        ]);

        // Nuevos datos para la actualización
        $data = [
            'nombre' => 'Categoria Actualizada',
            'estado' => 'Inactivo',
        ];

        // Ejecutar la petición POST para actualizar la categoría
        $response = $this->withoutMiddleware()->actingAsAdmin()->post(route('categorias.actualizar', $categoria->id), $data);

        // Verificar que la categoría fue actualizada correctamente
        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', $data);
    }

    public function test_eliminar_categoria_exitoso()
    {
        // Crear una categoría de prueba
        $categoria = Categorias::factory()->create([
            'nombre' => 'Categoria a Eliminar',
            'estado' => 'Activo',
        ]);

        // Ejecutar la petición para eliminar la categoría (marcar como inactiva)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('categorias.eliminar', $categoria->id));

        // Verificar que la categoría fue marcada como inactiva
        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'estado' => 'Inactivo',
        ]);
    }

    public function test_reingreso_categoria_exitoso()
    {
        // Crear una categoría de prueba inactiva
        $categoria = Categorias::factory()->create([
            'nombre' => 'Categoria Inactiva',
            'estado' => 'Inactivo',
        ]);

        // Ejecutar la petición para reingresar la categoría (marcar como activa)
        $response = $this->withoutMiddleware()->actingAsAdmin()->get(route('categorias.reingresar', $categoria->id));

        // Verificar que la categoría fue marcada como activa
        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
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
