<?php

namespace App\Http\Controllers;
use App\Models\Proveedores; // Importa el modelo
use Illuminate\Http\Request;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;

class ProveedoresController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $proveedores = Proveedores::all();

        // Pasar los clientes a la vista
        return view('proveedores.index', compact('proveedores'));
    }

    public function registrarProveedores(){
        return view('proveedores.registrarProveedores');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'ruc' => 'required|digits:11|numeric',
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        // Crear un nuevo proveedor en la base de datos
        Proveedores::create([
            'ruc' => $request->ruc,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        // Redirigir a una página con un mensaje de éxito
        return redirect()->route('proveedores.registrar')->with('success', 'Proveedor ingresado correctamente');
    }

    public function eliminarProveedor($id)
    {
        // Cambiar el estado a "Inactivo" en lugar de eliminar
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update(['estado' => 'Inactivo']);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor marcado como inactivo');
    }

    public function reingresarProveedor($id)
    {
        // Cambiar el estado a "Activo"
        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update(['estado' => 'Activo']);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor reingresado correctamente');
    }

    public function editarProveedor($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        return view('proveedores.editarProveedores', compact('proveedor'));
    }

    public function actualizarProveedor(Request $request, $id)
    {
        $request->validate([
            'ruc' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'estado' => 'required',
        ]);

        $proveedor = Proveedores::findOrFail($id);
        $proveedor->update([
            'ruc' => $request->ruc,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    public function enviarMensajeProveedor(){
        return view('proveedores.enviarMensajeProveedor');
    }

    public function storeContactanos(Request $request){
        Mail::to('jharb50024@gmail.com')->send(new ContactanosMailable($request->all()));
        
        return redirect()->route('proveedores.enviarMensajeProveedor')->with('info', 'Mensaje Enviado');
    }

    public function seleccionarProveedorParaMensaje()
    {
        $proveedores = Proveedores::where('estado', 'Activo')->get(); // Solo proveedores activos
        return view('proveedores.enviarMensaje', compact('proveedores'));
    }

    public function enviarMensajeProveedorSeleccionado(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'mensaje' => 'required|string',
        ]);

        $proveedor = Proveedores::findOrFail($request->proveedor_id);
        $mensaje = $request->mensaje;

        Mail::to($proveedor->correo)->send(new ContactanosMailable(['mensaje' => $mensaje]));

        return redirect()->route('proveedores.index')->with('success', 'Mensaje enviado correctamente al proveedor.');
    }
}
