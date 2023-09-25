<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class DocenteController extends Controller
{

    public function index(): JsonResponse
    {
        $docentes = Docente::all();
        return response()->json($docentes);
    }


    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'nombre' => 'required|max:255|min:2',
            'correo' => 'required|max:255|min:8',

        ]);


        $docente = new Docente([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),

        ]);
        $docente->save();
        return response()->json($docente, 201);
    }


    public function show($id): JsonResponse
    {
        $docente = Docente::findOrFail($id);
        return response()->json($docente);
    }


    public function update(Request $request, $id): JsonResponse
    {

        $request->validate([
            'nombre' => 'required|max:255|min:2',
            'correo' => 'required|max:255|min:8',

        ]);


        $docente = Docente::findOrFail($id);
        $docente->update($request->all());
        return response()->json($docente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();
        return response()->json(null, 204);
    }
}
