<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::get();

        return response()->json(['tareas' => $tareas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $tarea = new Tarea();
            $tarea->description = $request->description;
            $tarea->save();
            return response()->json(['tarea' => $tarea], 201);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Ago salió mal', 'Error' => $th], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        return response()->json(['tarea:' => $tarea]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        try {
            $tarea->description = $request->description;
            $tarea->save();
            return response()->json(['tarea' => $tarea]);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Algo salió mal :(', 'Error' => $th], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        try {
            $tarea->delete();   
            return response()->json(['mensaje' => 'Eliminado satisfactoriamente']); 
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Algo salió mal :(', 'Error' => $th], 500);
        }
    }
}
