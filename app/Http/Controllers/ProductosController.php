<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Categorias;
use App\Models\Notification;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['proveedor', 'categoria'])->get();
        // Productos en stock
        $productosEnStock = Producto::where('cantidad', '>', 0)->count();
        // Productos sin stock
        $productosSinStock = Producto::where('cantidad', 0)->count();
        // Producto más vendido (suma la cantidad total vendida)
        $productoMasVendido = Producto::withSum('detalleVentas as total_vendido', 'cantidad')
            ->orderBy('total_vendido', 'desc')
            ->first();
        // Productos inactivos
        $productosInactivos = Producto::where('estado', 'Inactivo')->count();

        // Verificar productos con bajo stock
        $productosConStockBajo = Producto::where('cantidad', '<=', 5)->get();
        foreach ($productosConStockBajo as $producto) {
            // Crear una notificación solo si no existe
            Notification::firstOrCreate(
                ['producto_id' => $producto->id, 'is_read' => false],
                ['message' => "El producto '{$producto->descripcion}' tiene un stock bajo ({$producto->cantidad})."]
            );
        }

        //Para hacer P000-0001 (Autoincrementable)
        $ultimoProducto = Producto::latest('id')->first();
        $nuevoCodigo = 'P000-' . str_pad(($ultimoProducto ? $ultimoProducto->id + 1 : 1), 4, '0', STR_PAD_LEFT);
        // Obtener las notificaciones no leídas
        $notificaciones = Notification::where('is_read', false)->get();

        return view('productos.index', compact(
            'productos',
            'productosEnStock',
            'productosSinStock',
            'productoMasVendido',
            'productosInactivos',
            'notificaciones',
            'nuevoCodigo'
        ));
    }
    public function marcarNotificacionesLeidas()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Todas las notificaciones han sido marcadas como leídas.');
    }

    public function registrarProducto()
    {
        // Obtener proveedores y categorías
        $proveedores = Proveedores::all(); // Asumiendo que tienes un modelo llamado Proveedor
        $categorias = Categorias::all();  // Asumiendo que tienes un modelo llamado Categoria

        $ultimoProducto = Producto::latest('id')->first();
        $nuevoCodigo = 'P000-' . str_pad(($ultimoProducto ? $ultimoProducto->id + 1 : 1), 4, '0', STR_PAD_LEFT);
        return view('productos.registrarProducto', compact('proveedores', 'categorias', 'nuevoCodigo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required',
            'descripcion' => 'required',
            'presentacion' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock_minimo' => 'required',
            'laboratorio' => 'required',
            'fecha_vencimiento' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',
            'id_proveedor' => 'required|exists:proveedores,id',
            'id_categoria' => 'required|exists:categorias,id',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $fotoPath = null;
        if($request->hasFile('foto')){
            $fotoPath = $request->file('foto')->store('productos', 'public');
        }else{
            $fotoPath = 'productos/producto_defecto.jpg';
        }

        // Crear un nuevo producto
        Producto::create([
            'codigo' => $validated['codigo'],
            'descripcion' => $validated['descripcion'],
            'presentacion' => $validated['presentacion'],
            'precio_compra' => $validated['precio_compra'],
            'precio_venta' => $validated['precio_venta'],
            'cantidad' => 0, // Por defecto 0
            'stock_minimo' => $validated['stock_minimo'],
            'laboratorio' => $validated['laboratorio'],
            'fecha_vencimiento' => $validated['fecha_vencimiento'],
            'foto' => $fotoPath,
            'id_proveedor' => $validated['id_proveedor'],
            'id_categoria' => $validated['id_categoria'],
            'estado' => $validated['estado'] // Asumimos que estado 1 es activo
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function editarProducto($id)
    {
        // Obtener el producto por ID y las listas de proveedores y categorías
        $producto = Producto::findOrFail($id);
        $proveedores = Proveedores::all();
        $categorias = Categorias::all();

        // Retornar la vista con el producto y las listas
        return view('productos.editarProducto', compact('producto', 'proveedores', 'categorias'));
    }

    public function actualizarProducto(Request $request, $id)
    {
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

    public function eliminarProducto($id)
    {
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);

        // Cambiar su estado a "Inactivo"
        $producto->update([
            'estado' => 'Inactivo'
        ]);

        // Redirigir al índice de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto desactivado exitosamente');
    }

    public function reingresarProducto($id)
    {
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);

        // Cambiar su estado a "Activo"
        $producto->update([
            'estado' => 'Activo'
        ]);

        // Redirigir al índice de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto reactivado exitosamente');
    }

    public function verDetalles(){

        $productos = Producto::all();

        return view('productos.detalles', compact('productos'));
    }
}
