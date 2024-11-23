<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\User;
use App\Models\Clientes;
use App\Models\Compra;
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
        $comprasMes = Compra::whereMonth('fecha', Carbon::now()->month)->whereYear('fecha', Carbon::now()->year)->sum('total');
        $totalCategorias = Categorias::count();
        $totalVentasAnuladas = Venta::where('estado', 'Anulado')->whereMonth('fecha', Carbon::now()->month) // Filtra por el mes actual
        ->whereYear('fecha', Carbon::now()->year)   // Filtra por el año actual
        ->sum('total');
        $totalComprasAnuladas = Compra::where('estado', 'Anulado')->whereMonth('fecha', Carbon::now()->month) // Filtra por el mes actual
        ->whereYear('fecha', Carbon::now()->year)   // Filtra por el año actual
        ->sum('total');

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
        return view('dashboard', compact(
            'totalUsuarios', 
            'totalClientes', 
            'totalProductos', 
            'ventasHoy',
            'comprasMes', 
            'productosStockMinimo', 
            'productosMasVendidos',
            'totalCategorias',
            'totalVentasAnuladas',
            'totalComprasAnuladas'
        ));
    }
}
