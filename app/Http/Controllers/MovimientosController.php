<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movimientos;
use Illuminate\Support\Facades\DB;

class MovimientosController extends Controller
{
    public function index(Request $request)
    {
        // Consulta base
        $query = Movimientos::query()->with('usuario');

        // Aplicar filtros si existen en la solicitud
        if ($request->filled('fecha_inicio')) {
            $query->where('fecha', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->where('fecha', '<=', $request->fecha_fin);
        }
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        if ($request->filled('usuario')) {
            $query->join('users', 'movimientos.usuario_id', '=', 'users.id')->where('users.name', 'like', '%' . $request->usuario . '%');
        }

        // Obtener resultados paginados (para evitar cargar demasiados registros)
        $movimientos = $query->orderBy('fecha', 'desc')->get();

        // Retornar la vista con los datos filtrados
        return view('movimientos.index', compact('movimientos'));
    }
}
