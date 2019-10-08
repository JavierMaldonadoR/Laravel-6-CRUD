<?php

namespace App\Http\Controllers;

use App\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{

    public function index()
    {
        $datos['empleados'] = Empleados::paginate(1);
        return view('empleados.index', $datos);
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {

        $campos = [
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje = ["required"=>'El :attribute es requerido.'];
        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->all();

        $datosEmpleado = request()->except('_token');

        if($request->hasFile('Foto')) {
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Empleados::insert($datosEmpleado);

        //return response()->json($datosEmpleado);
        return redirect('empleados')->with('Mensaje','Empleado agregado con éxito');
    }

    public function show(Empleados $empleados)
    {

    }

    public function edit($id)
    {
        $empleado = Empleados::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {

        $campos = [
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
        ];

        if($request->hasFile('Foto')) {
            $campos += ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }

        $mensaje = ["required"=>'El :attribute es requerido.'];
        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except(['_token','_method']);

        if($request->hasFile('Foto')) {
            $empleado = Empleados::findOrFail($id);
            Storage::delete('public/' . $empleado->Foto);
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Empleados::where('id', '=', $id)->update($datosEmpleado);

        /*$empleado = Empleados::findOrFail($id);
        return view('empleados.edit', compact('empleado'));*/

        return redirect('empleados')->with('Mensaje','Empleado modificado con éxito');
    }

    public function destroy($id)
    {
        $empleado = Empleados::findOrFail($id);

        if (Storage::delete('public/' . $empleado->Foto)) {
            Empleados::destroy($id);
        }

        return redirect('empleados')->with('Mensaje','Empleado eliminado con éxito');
    }
}
