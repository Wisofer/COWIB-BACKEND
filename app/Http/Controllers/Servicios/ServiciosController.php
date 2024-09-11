<?php

namespace App\Http\Controllers\Servicios;

use App\Http\Controllers\Controller;
use App\Models\Servicios; // Cambia a tu modelo de servicios correcto
use Illuminate\Http\Request;


class ServiciosController extends Controller
{
    // Extrayendo los datos de la base de datos

    public function index()
    {
        return response()->json(Servicios::all());
    }


    public function store(Request $request)
    {
        // Valida los datos de entrada
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'information' => 'required|string',
            'image' => 'required|image', // Asegúrate de que sea una imagen
        ]);
    
        // Maneja el archivo de imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath; // Guarda la ruta de la imagen
        }
    
        // Crea una nueva instancia del modelo
        $servicio = Servicios::create($validated);
    
        // Devuelve la respuesta JSON
        return response()->json($servicio, 201);
    }
    
}
