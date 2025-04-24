<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\TemporalDetalleCompra;
use App\Models\Movimientos;
use Barryvdh\DomPDF\Facade\Pdf;


class ComprasController extends Controller
{
    //Metodo para mostrar la pagina principal de las compras
    public function index(){
        $productos = Producto::all();
        $proveedores = Proveedores::all();
        $productosTemporales = TemporalDetalleCompra::with('producto')->get();  // Obtener productos temporales

        return view('compras.index', compact('productos', 'proveedores', 'productosTemporales'));
    }
    public function agregarProductoTemporal(Request $request) {
        // Validar la entrada
        $validated = $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
    
        // Obtener el producto seleccionado
        $producto = Producto::find($validated['id_producto']);
    
        // Calcular el sub_total
        $precio = $producto->precio_venta;
        $sub_total = $precio * $validated['cantidad'];
    
        // Insertar en la tabla temporal
        DB::table('temporal_detalles_compra')->insert([
            'id_producto' => $producto->id,
            'cantidad' => $validated['cantidad'],
            'precio' => $precio,
            'sub_total' => $sub_total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('compras.index')->with('success', 'Producto agregado temporalmente');
    }

    public function eliminarProductoTemporal($id) {
        // Eliminar el producto de la tabla temporal basado en el id
        DB::table('temporal_detalles_compra')->where('id', $id)->delete();
    
        return redirect()->route('compras.index')->with('success', 'Producto eliminado temporalmente');
    }
    
    public function guardarCompra(Request $request) {
        // Validar la selección del proveedor
        $validated = $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id',
        ]);
    
        // Calcular el total de la compra
        $productosTemporales = TemporalDetalleCompra::with('producto')->get();
        $total = $productosTemporales->sum('sub_total');
        $cantidadTotal = $productosTemporales->sum('cantidad');
        // Crear la compra
        $compra = Compra::create([
            'id_proveedor' => $validated['id_proveedor'],
            'total' => $total,
            'fecha' => now(),
            'estado' => 'Pagado',
        ]);
    
        // Guardar los detalles de la compra
        foreach ($productosTemporales as $productoTemporal) {
            DetalleCompra::create([
                'id_compra' => $compra->id,
                'id_producto' => $productoTemporal->id_producto,
                'cantidad' => $productoTemporal->cantidad,
                'precio' => $productoTemporal->precio,
                'sub_total' => $productoTemporal->sub_total,
            ]);

            // Actualizar la cantidad del producto en la tabla productos
            $producto = Producto::find($productoTemporal->id_producto);

            // Sumar la cantidad comprada a la cantidad existente en la tabla productos
            $producto->cantidad += $productoTemporal->cantidad;

            // Guardar la actualización del producto
            $producto->save();
        }
        
        Movimientos::create([
            'fecha' => now(),
            'cantidad' => $cantidadTotal,
            'total' => $total,
            'tipo' => 'Salida',
            'usuario_id' => auth()->id(),
        ]);

        // Limpiar la tabla temporal
        DB::table('temporal_detalles_compra')->truncate();
        
        // Generar el PDF con los detalles de la compra
        $pdf = PDF::loadView('compras.pdf', compact('compra', 'productosTemporales'));

        // Guardar el PDF en la carpeta 'public/pdf'
        $pdfPath = 'pdf/compra_' . $compra->id . '.pdf';
        $pdf->save(public_path($pdfPath));

        // Redirigir con el mensaje de éxito y la URL del PDF
        return redirect()->route('compras.index')->with([
            'success' => 'Compra registrada exitosamente',
            'pdf_url' => url($pdfPath), // Genera la URL completa del PDF
        ]);
    }

    public function lista() {
        // Obtener todas las compras
        $compras = Compra::all();

        // Retornar la vista con las compras
        return view('compras.lista', compact('compras'));
    }

    public function anularCompra($id) {
        // Buscar la compra por su ID
        $compra = Compra::with('detalles.producto')->findOrFail($id);
    
        // Verificar si la compra ya está anulada
        if ($compra->estado == 'Anulado') {
            return redirect()->route('compras.lista')->with('error', 'La compra ya está anulada.');
        }
    
        // Devolver el stock de los productos comprados
        foreach ($compra->detalles as $detalle) {
            $producto = $detalle->producto;
            $producto->cantidad -= $detalle->cantidad;
            $producto->save();
        }
    
        // Cambiar el estado de la compra a "Anulado"
        $compra->estado = 'Anulado';
        $compra->save();
    
        return redirect()->route('compras.lista')->with('success', 'Compra anulada exitosamente.');
    }
}