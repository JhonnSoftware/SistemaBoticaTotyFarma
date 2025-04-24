<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Clientes; // Modelo para clientes
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Documentos;
use App\Models\TemporalDetalleVenta;
use App\Models\TipoPago;
use App\Models\Movimientos;
use Barryvdh\DomPDF\Facade\Pdf;

class VentasController extends Controller
{
    // Mostrar la página principal de ventas
    public function index() {
        $productos = Producto::all();
        $clientes = Clientes::all();  
        $tipopago = TipoPago::all();
        $documento = Documentos::all();

        $productosTemporales = TemporalDetalleVenta::with('producto')->get();  // Obtener productos temporales

        $sumar = TemporalDetalleVenta::all();
        $totalVenta = $sumar->sum('sub_total');

        $ultimoCodigo = Venta::latest("id")->first();
        $nuevoCodigo = 'V0000-' . str_pad(($ultimoCodigo ? $ultimoCodigo->id + 1 : 1), 6, '0', STR_PAD_LEFT);

        return view('ventas.index', compact(
            'productos', 
            'clientes', 
            'productosTemporales', 
            'totalVenta',
            'tipopago',
            'documento',
            'nuevoCodigo'
        ));
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
        DB::table('temporal_detalles_ventas')->insert([
            'id_producto' => $producto->id,
            'cantidad' => $validated['cantidad'],
            'precio' => $precio,
            'sub_total' => $sub_total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('ventas.index')->with('success', 'Producto agregado temporalmente');
    }

    public function eliminarProductoTemporal($id) {
        // Eliminar el producto temporal de la venta
        DB::table('temporal_detalles_ventas')->where('id', $id)->delete();

        return redirect()->route('ventas.index')->with('success', 'Producto eliminado temporalmente');
    }

    public function autocompletar(Request $request){
        $termino = $request->get('query');
        $productos = Producto::where('descripcion', 'like', '%' . $termino . '%')
        ->select('id', 'descripcion', 'precio_venta')
        ->get();
        return response()->json($productos);
    }

    public function guardarVenta(Request $request) {
        
        $validated = $request->validate([
            'codigo' => 'required',
            'id_cliente' => 'required|exists:clientes,id',
            'id_pago' => 'required|exists:tipopago,id',
            'id_documento' => 'required|exists:documento,id',
        ]);

        // Calcular el total de la venta
        $productosTemporales = TemporalDetalleVenta::with('producto')->get();
        $total = $productosTemporales->sum('sub_total');

        // Crear la venta
        $venta = Venta::create([
            'codigo' => $validated['codigo'],
            'id_cliente' => $validated['id_cliente'],
            'total' => $total,
            'fecha' => now(),
            'estado' => 'Pagado',
            'id_pago' => $validated['id_pago'],
            'id_documento' => $validated['id_documento'],
        ]);

        // Guardar los detalles de la venta y actualizar las cantidades en el inventario
        foreach ($productosTemporales as $productoTemporal) {
            DetalleVenta::create([
                'id_venta' => $venta->id,
                'id_producto' => $productoTemporal->id_producto,
                'cantidad' => $productoTemporal->cantidad,
                'precio' => $productoTemporal->precio,
                'sub_total' => $productoTemporal->sub_total,
            ]);

            // Actualizar la cantidad del producto en el inventario
            $producto = Producto::find($productoTemporal->id_producto);
            $producto->cantidad -= $productoTemporal->cantidad;  // Restar la cantidad vendida
            $producto->save();
        }

        $cantidadTotal = $productosTemporales->sum('cantidad');

        Movimientos::create([
            'fecha' => now(),
            'cantidad' => $cantidadTotal,
            'total' => $total,
            'tipo' => 'Entrada',
            'usuario_id' => auth()->id(),
        ]);

        // Limpiar la tabla temporal
        DB::table('temporal_detalles_ventas')->truncate();
        
        if($validated['id_documento'] == 1){
            $pdf = PDF::loadView('ventas.boleta', compact('venta', 'productosTemporales'));
        }else if ($validated['id_documento'] == 2){
            $pdf = PDF::loadView('ventas.factura', compact('venta', 'productosTemporales'));
        }else if ($validated['id_documento'] == 3){
            $pdf = PDF::loadView('ventas.voucher', compact('venta', 'productosTemporales'));
        }
        // Guardar el PDF en la carpeta 'public/pdf'
        $pdfPath = 'pdf/venta_' . $venta->id . '.pdf';
        $pdf->save(public_path($pdfPath));

        // Redirigir con el mensaje de éxito y la URL del PDF
        return redirect()->route('ventas.index')->with([
            'success' => 'Venta registrada exitosamente',
            'pdf_url' => url($pdfPath), // Genera la URL completa del PDF
        ]);
        
    }

    public function lista() {
        // Obtener todas las compras
        $ventas = Venta::all();

        // Retornar la vista con las compras
        return view('ventas.lista', compact('ventas'));
    }
 
    public function anularVenta($id) {
        // Buscar la venta por su ID
        $venta = Venta::with('detalles.producto')->findOrFail($id);
    
        // Verificar si la venta ya está anulada
        if ($venta->estado == 'Anulado') {
            return redirect()->route('ventas.lista')->with('error', 'La venta ya está anulada.');
        }
    
        // Devolver el stock de los productos vendidos
        foreach ($venta->detalles as $detalle) {
            $producto = $detalle->producto;
            $producto->cantidad += $detalle->cantidad;  // Devolver la cantidad al stock
            $producto->save();
        }
    
        // Cambiar el estado de la venta a "Anulado"
        $venta->estado = 'Anulado';
        $venta->save();

        return redirect()->route('ventas.lista')->with('success', 'Venta anulada exitosamente.');
    }
    
}
