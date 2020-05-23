<?php

namespace App\Http\Controllers;

use App;
use App\Nivel_formacion;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programas = App\Programa::orderby('nombre','asc')->get();
        return view('programa.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nivel_formacions = App\Nivel_formacion::orderby('nombre','asc')->get();
        return view('programa.insert', compact('nivel_formacions')); 
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
            'idNivel_formacion' => 'required',

               
        ]);
          App\Programa::create($request->all());
 
          return redirect()->route('programa.index')
                        -> with('exito','se ha creado programa con exito!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programa = App\Programa::join('nivel_formacions','programas.idNivel_formacion','nivel_formacions.id')
                            ->select('programas.*', 'nivel_formacions.nombre as nivel_formacion')
                            ->where('programas.id', $id)
                            ->first();
    return view('programa.view', compact('programa'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nivel_formacions = App\Nivel_formacion::orderby('nombre', 'asc')->get();
        $programa = App\Programa::findorfail($id);
        return view('programa.edit', compact('programa','nivel_formacions'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'idNivel_formacion' => 'required',

        ]);
            
        $programa = App\Programa::findorfail($id);
        $programa->update($request->all());

        return redirect()->route('programa.index')
                     ->with('exito', 'programa modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programa = App\Programa::findorfail($id);

        $programa->delete();

        return redirect()->route('programa.index')
                     ->with('exito', 'programa eliminado correctamente');

    
    }

    public function darProgramas()
    {
        $programas = App\Programa::orderBy('nombre', 'asc')->get();

        return response()->json($programas);
    }

    public function guardarProgramas(Request $request)
    {
        $programas = App\Programa::orderBy('nombre', 'asc')->get();

        return App\Programa::create($request->all());
    }
}
