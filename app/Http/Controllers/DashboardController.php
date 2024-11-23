<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clientes;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtén los datos que necesitas
        $totalUsuarios = User::count();
        $totalClientes = Clientes::count();
        $totalProductos = Producto::count();
        $ventasHoy = Venta::whereDate('fecha', Carbon::today())->sum('total');

        // Productos con stock mínimo
        $productosStockMinimo = Producto::where('cantidad', '<=', 10)->get();

        // Productos más vendidos sin usar DB::raw
        $productosMasVendidos = DetalleVenta::with('producto')
            ->select('id_producto')
            ->selectRaw('SUM(cantidad) as total_vendido') // Usamos selectRaw para hacer la suma
            ->groupBy('id_producto')
            ->orderBy('total_vendido', 'desc')
            ->take(5)  // Limitar a los 5 productos más vendidos
            ->get();

        // Pasar los datos a la vista
        return view('dashboard', compact('totalUsuarios', 'totalClientes', 'totalProductos', 'ventasHoy', 'productosStockMinimo', 'productosMasVendidos'));
    }
}
