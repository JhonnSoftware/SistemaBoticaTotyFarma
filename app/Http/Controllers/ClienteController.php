<?php

namespace App\Http\Controllers;
use App\Models\Clientes;
use Illuminate\Http\Request;


class ClienteController extends Controller
{
    public function index(){
        // Solo mostrar clientes activos
        $clientes = Clientes::all();
        return view('clientes.index', compact('clientes'));
    }

    public function registrarClientes(){
        return view('clientes.registrarClientes');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario, incluyendo la unicidad del DNI con mensaje personalizado
        $request->validate([
            'dni' => 'required|numeric|digits:8|unique:clientes,dni', // Asegura que el DNI sea único en la tabla 'clientes'
            'nombre' => 'required',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
            'estado' => 'required',
        ], [
            'dni.unique' => 'El DNI ya ha sido registrado.', // Mensaje personalizado
        ]);

        // Crear un nuevo cliente en la base de datos
        Clientes::create([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        // Redirigir a una página con un mensaje de éxito
        return redirect()->route('clientes.registrar')->with('success', 'Cliente ingresado correctamente');
    }

    public function eliminarCliente($id)
    {
        // Cambiar el estado a "Inactivo" en lugar de eliminar
        $cliente = Clientes::findOrFail($id);
        $cliente->update(['estado' => 'Inactivo']);

        return redirect()->route('clientes.index')->with('success', 'Cliente marcado como inactivo');
    }

    public function reingresarCliente($id)
    {
        // Cambiar el estado a "Activo"
        $cliente = Clientes::findOrFail($id);
        $cliente->update(['estado' => 'Activo']);

        return redirect()->route('clientes.index')->with('success', 'Cliente reingresado correctamente');
    }

    public function editarCliente($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.editarClientes', compact('cliente'));
    }

    public function actualizarCliente(Request $request, $id)
    {
        // Validar los datos del formulario, permitiendo que el mismo DNI no se considere duplicado
        $request->validate([
            'dni' => 'required|unique:clientes,dni,' . $id, // Excepción para el cliente actual
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'estado' => 'required',
        ], [
            'dni.unique' => 'El DNI ya ha sido registrado.', // Mensaje personalizado
        ]);

        // Actualizar el cliente en la base de datos
        $cliente = Clientes::findOrFail($id);
        $cliente->update([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }
}
