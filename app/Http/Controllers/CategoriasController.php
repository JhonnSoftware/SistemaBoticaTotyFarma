<?php

namespace App\Http\Controllers;
use App\Models\Categorias; 
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $categorias = Categorias::all();
        // Total de categorías registradas
        $categoriasRegistradas = Categorias::count();
        // Total de categorías activas
        $categoriasActivas = Categorias::where('estado', 'Activo')->count();
        // Total de categorías inactivas
        $categoriasInactivas = Categorias::where('estado', 'Inactivo')->count();
        // Categoría más utilizada (con más productos asociados)
        $categoriaMasUtilizada = Categorias::withCount('productos')
            ->orderBy('productos_count', 'desc')
            ->first();
            // Pasar los clientes a la vista
        
            return view('categorias.index', compact(
                'categorias',
                'categoriasRegistradas', 
                'categoriasActivas', 
                'categoriasInactivas', 
                'categoriaMasUtilizada'
            ));
    }

    public function registrarCategorias(){
        return view('categorias.registrarCategorias');
    }
    
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);
        
        // Crear un nuevo cliente en la base de datos
        Categorias::create([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        // Redirigir a una página con un mensaje de éxito
        return redirect()->route('categorias.registrar')->with('success', 'Categoria ingresado correctamente');
    }

    public function eliminarCategoria($id)
    {
        // Cambiar el estado a "Inactivo" en lugar de eliminar
        $categoria = Categorias::findOrFail($id);
        $categoria->update(['estado' => 'Inactivo']);

        return redirect()->route('categorias.index')->with('success', 'Categoria marcado como inactivo');
    }

    public function reingresarCategoria($id)
    {
        // Cambiar el estado a "Activo"
        $categoria = Categorias::findOrFail($id);
        $categoria->update(['estado' => 'Activo']);

        return redirect()->route('categorias.index')->with('success', 'Categoria reingresado correctamente');
    }

    public function editarCategoria($id)
    {
        $categoria = Categorias::findOrFail($id);
        return view('categorias.editarCategorias', compact('categoria'));
    }

    public function actualizarCategoria(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'estado' => 'required',
        ]);

        $categoria = Categorias::findOrFail($id);
        $categoria->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria actualizado correctamente');
    }
}
