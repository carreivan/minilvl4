<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Alumno;
use Illuminate\Validation\ValidationException;

class AlumnoController extends Controller
{

    public function index(): JsonResponse
    {
        $alumnos = Alumno::all();
        return response()->json($alumnos);
    }


    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'nombre' => 'required|max:255|min:2',
            'apellido' => 'nullable|max:255|min:2',
            'correo' => 'required|max:255|min:8',
        ]);


        $alumno = new Alumno([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'correo' => $request->input('correo'),
        ]);

        $alumno->save();

        return response()->json($alumno, 201);
    }


    public function show($id): JsonResponse
    {
        $alumno = Alumno::findOrFail($id);
        return response()->json($alumno);
    }


    public function update(Request $request, $id): JsonResponse
    {

        $request->validate([
            'nombre' => 'required|max:255|min:2',
            'apellido' => 'nullable|max:255|min:2',
            'correo' => 'required|max:255|min:8',
        ]);



        $alumno = Alumno::findOrFail($id);
        $alumno->update($request->all());
        return response()->json($alumno);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return response()->json(null, 204);
    }
}
