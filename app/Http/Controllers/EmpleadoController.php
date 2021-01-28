<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$empleados = Empleado::all();//Eloquent

        //$empleados = DB::table('empleados')->paginate(7); //Query Builder
        $empleados = Empleado::where('erte', false)->orderBy('nombre')->paginate(7); //Query Builder

        if (session()->has('visitasEmpleado')) {
            //valor por defecto
            $cont = session('visitasEmpleado', 'default');
            $cont++;
            session(['visitasEmpleado' => $cont]);
        } else {
            session(['visitasEmpleado' => 0]);
        }

        //return view('empleados', ['empleados' => Empleado::all(), 'contador' => session('visitasEmpleado')]);
        return view('empleados', [
            'empleados' => $empleados,
            'contador' => session('visitasEmpleado')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.nuevo')->with('mensaje', 'Nuevo Empleado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        echo "<h1>Store</h1>";
        echo $request->path()."<br>";
        echo $request->url()."<br>";
        echo $request->ip()."<br>";
        if ($request->has(['nombre', 'apellidos','dni'])) {
            echo $request->nombre;
            echo $request->apellidos;
            echo $request->dni;
        }
        */

        $validated = $request->validate([
            'nombre' => 'bail|required',
        ]);

        $empleado = new Empleado;
        $empleado->nombre = $request->nombre;
        $empleado->apellidos = $request->apellidos;
        $empleado->dni = $request->dni;
        $empleado->direccion = $request->direccion;
        $empleado->ciudad = $request->ciudad;
        $empleado->cargo = $request->cargo;
        $empleado->erte = $request->erte;
        $empleado->save();

        //Subir un archivo y grabarlo en nuestro disco. Carpeta storage
        $path = $request->foto->storeAs('images', 'empleado' . $empleado->dni . '.png');

        return redirect()->action(
            [EmpleadoController::class, 'show'],
            ['empleado' => $empleado]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        /*
        return view('empleado.profile', [
            'empleado' => $empleado
        ]);
        */

        return view('empleado.profile', [
            'empleado' => $empleado
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        return view('empleado.editar')->with('mensaje', 'Modificar empleado')
            ->with('empleado', $empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //Query Builder
        DB::table('empleados')
            ->where('id', $empleado->id)
            ->update([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'dni' => $request->dni,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'cargo' => $request->cargo,
                'erte' => $request->erte
            ]);

        return redirect()->action(
            [EmpleadoController::class, 'show'],
            ['empleado' => $empleado->id]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->action(
            [EmpleadoController::class, 'index']
        );
    }
}
