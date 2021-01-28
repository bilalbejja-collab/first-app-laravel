<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$incidencias = Incidencia::all(); //Eloquent
        //$incidencias = DB::table('incidencias')->get(); //Query Builder
        $incidencias = DB::table('incidencias')->paginate(7); //Query Builder

        $total_incidencias = DB::table('incidencias')->count();

        if (session()->has('visitasIncidencia')) {
            //valor por defecto
            $cont = session('visitasIncidencia', 'default');
            $cont++;
            session(['visitasIncidencia' => $cont]);
        } else {
            session(['visitasIncidencia' => 0]);
        }

        return view('incidencias', [
            'incidencias' => $incidencias,
            'contador' => session('visitasIncidencia'),
            'total' => session('total_incidencias')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidencia.nuevo')->with('mensaje', 'Nueva Incidencia');
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
        if ($request->has(['latitud', 'longitud','estado'])) {
            echo ($request->input('latitud'));
            echo ($request->input('longitud'));
            echo $request->estado;
        }
        */

        $validated = $request->validate([
            'latitud' => 'required|numeric|digits_between:0,360',
            'longitud' => 'required|between:1,3',
            'foto' => 'required|file|image|mimes:png',
            'estado' => 'required'
        ]);

        try {
            /*
            $incidencia = new Incidencia;
            $incidencia->latitud = $request->latitud;
            $incidencia->longitud = $request->longitud;
            $incidencia->ciudad = $request->ciudad;
            $incidencia->direccion = $request->direccion;
            $incidencia->etiqueta = $request->etiqueta;
            $incidencia->descripcion = $request->descripcion;
            $incidencia->estado = $request->estado;
            $incidencia->save(); //Elloquent
            */

            $id = DB::table('incidencias')->insertGetId([
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'ciudad' => $request->ciudad,
                'direccion' => $request->direccion,
                'etiqueta' => $request->etiqueta,
                'descripcion' => $request->descripcion,
                'estado' => $request->estado,
                'nivel' => $request->nivel
            ]);
        } catch (Exception $e) {
            Log::error('Error en BD insertando incidencia ' . $e->getMessage());
            //return view();
            return "ERROR";
        }

        Log::info('Incidencia insertada correctamente!');

        //Subir un archivo y grabarlo en nuestro disco. Carpeta storage
        //$path = $request->foto->storeAs('images', 'incidencia' . $incidencia->id . '.png');
        $path = $request->foto->storeAs('images', 'incidencia' . $id . '.png');

        /*
        return response('Incidencia')->cookie(
            'incidencia',
            'hola mundo',
            3
        );
        */

        return redirect()->action(
            [IncidenciaController::class, 'show'],
            ['incidencia' => $id]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$incidencias = DB::table('incidencias')->where('id', $id)->first();
        $incidencias = DB::table('incidencias')->find($id);
        return view('incidencia.profile', [
            'incidencia' => $incidencias
        ]);
        /*
        return view('incidencia.profile', [
            'incidencia' => Incidencia::findOrFail($id)
        ]);
        */


        /*
        //Devuelve el modelo, o sea, la incidencia en JSON
        $incidencia = Incidencia::findOrFail($id);
        return $incidencia;
        */

        /*
        return response($incidencia)
            ->header('Content-Type', 'application/json');
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incidencia = DB::table('incidencias')->find($id);
        return view('incidencia.editar')->with('mensaje', 'Modificar incidencia')
            ->with('incidencia', $incidencia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Query Builder
        DB::table('incidencias')
            ->where('id', $id)
            ->update([
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'ciudad' => $request->ciudad,
                'direccion' => $request->direccion,
                'etiqueta' => $request->etiqueta,
                'descripcion' => $request->descripcion,
                'estado' => $request->estado,
                'estado' => $request->nivel
            ]);

        return redirect()->action(
            [IncidenciaController::class, 'show'],
            ['incidencia' => $id]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Q. BUILDER
        DB::table('incidencias')->where('id', '=', $id)->delete();
        return redirect()->action(
            [IncidenciaController::class, 'index']
        );
    }
}
