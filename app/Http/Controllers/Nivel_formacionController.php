<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class Nivel_formacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nivel_formacions = App\Nivel_formacion::orderby('nombre','asc')->get();
        return view('nivel_formacion.index', compact('nivel_formacions')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nivel_formacion.insert'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar que lleguen todos los campos
        $request->validate([
            'nombre' => 'required',
            
               
        ]);
          App\Nivel_formacion::create($request->all());
 
          return redirect()->route('nivel_formacion.index')
                        -> with('exito','se ha creado nivel de formacion con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivel_formacion = App\Nivel_formacion::findorfail($id);

        return view('nivel_formacion.view', compact('nivel_formacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nivel_formacion  $nivel_formacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nivel_formacion = App\Nivel_formacion::findorfail($id);

        return view('nivel_formacion.edit', compact('nivel_formacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nivel_formacion  $nivel_formacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            
              
        ]);
            
        $nivel_formacion = App\Nivel_formacion::findorfail($id);
        $nivel_formacion->update($request->all());

        return redirect()->route('nivel_formacion.index')
                     ->with('exito', 'nivel de formacion modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nivel_formacion  $nivel_formacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivel_formacion = App\Nivel_formacion::findorfail($id);

        $nivel_formacion->delete();

        return redirect()->route('nivel_formacion.index')
                     ->with('exito', 'nivel de formacion eliminado correctamente');
    }
    
    public function darNivel_formacions()
    {
        $nivel_formacions = App\Nivel_formacion::orderBy('nombre', 'asc')->get();

        return response()->json($nivel_formacions);
    }

    public function guardarNivel_formacions(Request $request)
    {
        $nivel_formacions = App\Nivel_formacion::orderBy('nombre', 'asc')->get();

        return App\Nivel_formacion::create($request->all());
    }
}
