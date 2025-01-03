<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(Alumno::all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los alumnos'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $alumno = Alumno::find($id);
            if ($alumno) {
                return response()->json($alumno);
            } else {
                return response()->json(['message' => 'Alumno no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el alumno'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $alumno = Alumno::create($request->all());
            return response()->json($alumno, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el alumno'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $alumno = Alumno::find($id);
            if ($alumno) {
                $alumno->update($request->all());
                return response()->json($alumno, 200);
            } else {
                return response()->json(['message' => 'Alumno no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el alumno'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $alumno = Alumno::find($id);
            if ($alumno) {
                $alumno->delete();
                return response()->json(['message' => 'Alumno eliminado'], 200);
            } else {
                return response()->json(['message' => 'Alumno no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el alumno'], 500);
        }
    }
}
