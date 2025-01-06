<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Nota;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(Nota::all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener las notas'], 500);
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
            $nota = Nota::find($id);
            if ($nota) {
                return response()->json($nota);
            } else {
                return response()->json(['message' => 'Nota no encontrada'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener la nota'], 500);
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
            $nota = Nota::create($request->all());
            return response()->json($nota, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear la nota'], 500);
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
            $nota = Nota::find($id);
            if ($nota) {
                $nota->update($request->all());
                return response()->json($nota);
            } else {
                return response()->json(['message' => 'Nota no encontrada'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar la nota'], 500);
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
            $nota = Nota::find($id);
            if ($nota) {
                $nota->delete();
                return response()->json(['message' => 'Nota eliminada'], 200);
            } else {
                return response()->json(['message' => 'Nota no encontrada'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la nota'], 500);
        }
    }
}
