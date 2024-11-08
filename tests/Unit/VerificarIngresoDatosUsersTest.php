<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class VerificarIngresoDatosUsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingreso_exitoso_de_usuario()
    {
        // Datos válidos para crear un usuario
        $data = [
            'name' => 'Usuario Prueba',
            'email' => 'usuario@ejemplo.com',
            'password' => 'password123',
        ];

        // Ejecutar la creación del usuario y verificar en la base de datos
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function test_error_al_faltar_nombre()
    {
        $data = [
            'email' => 'usuario@ejemplo.com',
            'password' => 'password123',
        ];

        $this->expectException(\Illuminate\Database\QueryException::class);
        
        User::create($data);
    }

    public function test_error_al_faltar_email()
    {
        $data = [
            'name' => 'Usuario Prueba',
            'password' => 'password123',
        ];

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::create($data);
    }

    public function test_error_email_duplicado()
    {
        User::factory()->create([
            'name' => 'Usuario Existente',
            'email' => 'usuario@ejemplo.com',
            'password' => Hash::make('password123'),
        ]);

        $data = [
            'name' => 'Nuevo Usuario',
            'email' => 'usuario@ejemplo.com',
            'password' => Hash::make('password456'),
        ];

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::create($data);
    }

    public function test_error_al_faltar_password()
    {
        $data = [
            'name' => 'Usuario Prueba',
            'email' => 'usuario@ejemplo.com',
        ];

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::create($data);
    }
}
