<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AsistenciaController extends Controller
{

    public function index()
    {
        $asistencias = Asistencia::with('alumno', 'curso')->get();
        return response()->json($asistencias);
    }

    public function registrarAsistencia(Request $request): JsonResponse
    {

        $request->validate([
            'alumno_id' => 'required|integer',
            'curso_id' => 'required|integer',
            'tipo_asistencia' => 'required|in:A,T,F',
        ]);


        $asistencia = new Asistencia([
            'alumno_id' => $request->input('alumno_id'),
            'curso_id' => $request->input('curso_id'),
            'fecha_asistencia' => now(),
            'tipo_asistencia' => $request->input('tipo_asistencia'),
        ]);
        $asistencia->save();
        return response()->json($asistencia, 201);
    }
}
