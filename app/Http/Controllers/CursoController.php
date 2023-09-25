<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CursoController extends Controller
{

    public function index(): JsonResponse
    {
        $cursos = Curso::all();
        return response()->json($cursos);
    }

    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'nombre' => 'required|max:255|min:3',
            'descripcion' => 'nullable|max:255|min:5',

        ]);


        $curso = new Curso([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),

        ]);
        $curso->save();
        return response()->json($curso, 201);
    }


    public function show($id): JsonResponse
    {
        $curso = Curso::findOrFail($id);
        return response()->json($curso);
    }



    public function update(Request $request, $id): JsonResponse
    {

        $request->validate([
            'nombre' => 'required|max:255|min:3',
            'descripcion' => 'nullable|max:255|min:5',

        ]);


        $curso = Curso::findOrFail($id);
        $curso->update($request->all());
        return response()->json($curso);
    }

    public function destroy($id): JsonResponse
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return response()->json(null, 204);
    }
}
