<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Asignatura;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(Asignatura::all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener las asignaturas'], 500);
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
            $asignatura = Asignatura::find($id);
            if ($asignatura) {
                return response()->json($asignatura);
            } else {
                return response()->json(['message' => 'Asignatura no encontrada'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener la asignatura'], 500);
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
            $asignatura = Asignatura::create($request->all());
            return response()->json($asignatura, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear la asignatura'], 500);
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
            $asignatura = Asignatura::find($id);
            if ($asignatura) {
                $asignatura->update($request->all());
                return response()->json($asignatura);
            } else {
                return response()->json(['message' => 'Asignatura no encontrada'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar la asignatura'], 500);
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
            $asignatura = Asignatura::find($id);
            if ($asignatura) {
                $asignatura->delete();
                return response()->json(['message' => 'Asignatura eliminada'], 200);
            } else {
                return response()->json(['message' => 'Asignatura no encontrada'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la asignatura'], 500);
        }
    }
}
