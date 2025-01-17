<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Perfil;

class PerfilController extends Controller
{
    /** 
     * Display a listing of the resource.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(Perfil::all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los perfiles'], 500);
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
            $perfil = Perfil::find($id);
            if ($perfil) {
                return response()->json($perfil);
            } else {
                return response()->json(['message' => 'Perfil no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el perfil'], 500);
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
            $perfil = Perfil::create($request->all());
            return response()->json($perfil, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el perfil'], 500);
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
            $perfil = Perfil::find($id);
            if ($perfil) {
                $perfil->update($request->all());
                return response()->json($perfil, 200);
            } else {
                return response()->json(['message' => 'Perfil no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el perfil'], 500);
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
            $perfil = Perfil::find($id);
            if ($perfil) {
                $perfil->delete();
                return response()->json(['message' => 'Perfil eliminado'], 200);
            } else {
                return response()->json(['message' => 'Perfil no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el perfil'], 500);
        }
    }
}
