<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $users = User::all();
        
        // Pasar los clientes a la vista
        return view('users.index', compact('users'));
    }

    public function registrarUsers(){
        return view('users.registrarUsers');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        // Crear el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('users.registrar')->with('success', 'Usuario creado correctamente');
    }

    public function eliminarUser($id)
    {
        // Cambiar el estado a "Inactivo" en lugar de eliminar
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado con exito');
    }

    public function editarUser($id)
    {
        $user = User::findOrFail($id);
        return view('users.editarUsers', compact('user'));
    }

    public function actualizarUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }
}
