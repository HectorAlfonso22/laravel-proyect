<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Validator;

class NoticiaController extends Controller
{
    // Obtener todas las noticias
    public function index()
    {
        return response()->json(Noticia::all(), 200);
    }

    // Crear una nueva noticia
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|string',  // Suponiendo que es una URL o nombre de archivo
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Crear la noticia usando asignación masiva
        $noticia = Noticia::create($request->only(['titulo', 'descripcion', 'imagen']));

        // Devolver la noticia creada en formato JSON con un código 201 (Created)
        return response()->json($noticia, 201);
    }

    // Mostrar una noticia por su ID
    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return response()->json($noticia, 200);
    }

    // Actualizar una noticia existente
    public function update(Request $request, $id)
    {
        // Buscar la noticia por su ID
        $noticia = Noticia::findOrFail($id);

        // Validar los datos actualizados
        $validator = Validator::make($request->all(), [
            'titulo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Actualizar los campos de la noticia usando asignación masiva
        $noticia->update($request->only(['titulo', 'descripcion', 'imagen']));

        // Devolver la noticia actualizada en formato JSON
        return response()->json($noticia, 200);
    }

    // Eliminar una noticia
    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);
        $noticia->delete();

        return response()->json(null, 204);
    }
}
