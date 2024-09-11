<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{

    public function index()
    {
        return response()->json(Proyectos::all());
    }

    public function store(Request $request)
    {
        // Valida los datos de entrada
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'information' => 'required|string',
            'technologies' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Asegúrate de que sea una imagen y limita el tamaño
        ]);
        
    
        // Maneja el archivo de imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath; // Guarda la ruta de la imagen
        }
    
        // Crea una nueva instancia del modelo
        $proyectos = Proyectos::create($validated);
    
        // Devuelve la respuesta JSON
        return response()->json($proyectos, 201);
    }

}
