<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Categorias;

class ProductosController extends Controller
{
    public function index() {
        $productos = Producto::with(['proveedor', 'categoria'])->get();
        return view('productos.index', compact('productos'));
    }
    
    public function registrarProducto() {
        // Obtener proveedores y categorías
        $proveedores = Proveedores::all(); // Asumiendo que tienes un modelo llamado Proveedor
        $categorias = Categorias::all();  // Asumiendo que tienes un modelo llamado Categoria
        
        return view('productos.registrarProducto', compact('proveedores', 'categorias'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'codigo' => 'required',
            'descripcion' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'id_proveedor' => 'required|exists:proveedores,id',
            'id_categoria' => 'required|exists:categorias,id',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        // Crear un nuevo producto
        Producto::create([
            'codigo' => $validated['codigo'],
            'descripcion' => $validated['descripcion'],
            'precio_compra' => $validated['precio_compra'],
            'precio_venta' => $validated['precio_venta'],
            'cantidad' => 0, // Por defecto 0
            'id_proveedor' => $validated['id_proveedor'],
            'id_categoria' => $validated['id_categoria'],
            'estado' => $validated['estado'] // Asumimos que estado 1 es activo
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function editarProducto($id) {
        // Obtener el producto por ID y las listas de proveedores y categorías
        $producto = Producto::findOrFail($id);
        $proveedores = Proveedores::all();
        $categorias = Categorias::all();
        
        // Retornar la vista con el producto y las listas
        return view('productos.editarProducto', compact('producto', 'proveedores', 'categorias'));
    }
    
    public function actualizarProducto(Request $request, $id) {
        // Validar los datos ingresados
        $validated = $request->validate([
            'codigo' => 'required',
            'descripcion' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'id_proveedor' => 'required|exists:proveedores,id',
            'id_categoria' => 'required|exists:categorias,id',
            'estado' => 'required|in:Activo,Inactivo'
        ]);
    
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);
        
        // Actualizar los campos del producto
        $producto->update([
            'codigo' => $validated['codigo'],
            'descripcion' => $validated['descripcion'],
            'precio_compra' => $validated['precio_compra'],
            'precio_venta' => $validated['precio_venta'],
            'id_proveedor' => $validated['id_proveedor'],
            'id_categoria' => $validated['id_categoria'],
            'estado' => $validated['estado']
        ]);
    
        // Redirigir a la vista del índice de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }
    
    public function eliminarProducto($id) {
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);
        
        // Cambiar su estado a "Inactivo"
        $producto->update([
            'estado' => 'Inactivo'
        ]);
    
        // Redirigir al índice de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto desactivado exitosamente');
    }

    public function reingresarProducto($id) {
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);
        
        // Cambiar su estado a "Activo"
        $producto->update([
            'estado' => 'Activo'
        ]);
    
        // Redirigir al índice de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto reactivado exitosamente');
    }
}
