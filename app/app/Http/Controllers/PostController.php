<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(Post::all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los posts'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $post = Post::find($id);
            if ($post) {
                return response()->json($post);
            } else {
                return response()->json(['message' => 'Post no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el post'], 500);
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
            $post = Post::create($request->all());
            return response()->json($post, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el post'], 500);
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
            $post = Post::find($id);
            if ($post) {
                $post->update($request->all());
                return response()->json($post, 200);
            } else {
                return response()->json(['message' => 'Post no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el post'], 500);
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
            $post = Post::find($id);
            if ($post) {
                $post->delete();
                return response()->json(['message' => 'Post eliminado'], 200);
            } else {
                return response()->json(['message' => 'Post no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el post'], 500);
        }
    }

    /**
     * Display a listing of the resource.
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function postsByUser(int $id): JsonResponse
    {
        try {
            return response()->json(Alumno::find($id)->posts);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los posts'], 500);
        }
    }
}
