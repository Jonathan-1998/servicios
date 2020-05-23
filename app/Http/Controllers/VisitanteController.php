<?php

namespace App\Http\Controllers;

use App;
use App\Nivel_formacion;
use App\Programa;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitantes = App\Visitante::orderby('nombre','asc')->get();
        return view('visitante.index', compact('visitantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nivel_formacions = App\Hospital::orderby('nombre','asc')->get();
        $programas = App\Programa::orderby('nombre','asc')->get();
        return view('visitante.insert', compact('nivel_formacions','programas'));
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
            'apellidos' => 'required',
            'tipo_documento' => 'required',
            'numero_documento' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'idNivel_formacion' => 'required',
            'idPrograma' => 'required',   
        ]);
          App\Visitante::create($request->all());
 
          return redirect()->route('visitante.index')
                        -> with('exito','se ha creado visitante con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitante = App\Visitante::join('nivel_formacions','visitantes.idNivel_formacion','nivel_formacions.id')
                        ->join('programas','visitantes.idPrograma','programas.id')
                        ->select('visitantes.*', 'nivel_formacions.nombre as nivel_formacion', 'programas.nombre as programa')
                        ->where('visitantes.id', $id)
                        ->first();

        

        return view('visitante.view', compact('visitante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nivel_formacions = App\Nivel_formacion::orderby('nombre', 'asc')->get();
        $programas = App\Programa::orderby('nombre', 'asc')->get();
        $visitante = App\Visitante::findorfail($id);
        return view('visitante.edit', compact('visitante','nivel_formacions','programas'));
    }
        
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'tipo_documento' => 'required',
            'numero_documento' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'idNivel_formacion' => 'required',
            'idPrograma' => 'required',
        ]);
            
        $visitante = App\Visitante::findorfail($id);
        $visitante->update($request->all());

        return redirect()->route('visitante.index')
                     ->with('exito', 'visitante modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $visitante = App\Visitante::findorfail($id);

        $visitante->delete();

        return redirect()->route('visitante.index')
                     ->with('exito', 'visitante eliminada correctamente');
    }

    public function darVisitantes()
    {
        $visitantes = App\Visitante::orderBy('nombre', 'asc')->get();

        return response()->json($visitantes);
    }

    public function guardarVisitantes(Request $request)
    {
        $visitantes = App\Visitante::orderBy('nombre', 'asc')->get();

        return App\Visitante::create($request->all());
    }
}
