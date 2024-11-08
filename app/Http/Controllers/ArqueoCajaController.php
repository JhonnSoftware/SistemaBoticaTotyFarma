<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArqueoCaja;

class ArqueoCajaController extends Controller
{
    public function index()
    {
        $arqueos = ArqueoCaja::all(); // Obtener todos los arqueos
        return view('arqueo_caja.index', compact('arqueos'));
    }

    public function create()
    {
        return view('arqueo_caja.create'); // Mostrar el formulario para crear un nuevo arqueo
    }

    public function store(Request $request)
    {
        $request->validate([
            'saldo_inicial' => 'required|numeric',
            'ingresos' => 'required|numeric',
            'egresos' => 'required|numeric',
        ]);

        $saldo_final_esperado = $request->saldo_inicial + $request->ingresos - $request->egresos;

        ArqueoCaja::create([
            'saldo_inicial' => $request->saldo_inicial,
            'ingresos' => $request->ingresos,
            'egresos' => $request->egresos,
            'saldo_final_esperado' => $saldo_final_esperado,
            'estado' => 'Abierto',
        ]);

        return redirect()->route('arqueos.index')->with('success', 'Arqueo de caja registrado correctamente.');
    }

    public function cerrarArqueo(Request $request, $id)
    {
        $arqueo = ArqueoCaja::findOrFail($id);
        
        $request->validate([
            'saldo_real' => 'required|numeric',
        ]);

        $diferencia = $arqueo->saldo_final_esperado - $request->saldo_real;

        $arqueo->update([
            'saldo_real' => $request->saldo_real,
            'diferencia' => $diferencia,
            'estado' => 'Cerrado',
        ]);

        return redirect()->route('arqueos.index')->with('success', 'Arqueo de caja cerrado correctamente.');
    }
}
