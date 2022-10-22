<?php

namespace App\Http\Controllers;

use App\Http\Requests\DogBreedRequest;
use App\Models\DogBreed;
use Illuminate\Http\Request;

class DogBreedController extends Controller
{
    public function index(Request $request)
    {
        $dog_breeds = DogBreed::get();
        return response()->json($dog_breeds);
    }
    public function show(DogBreed $breed)
    {
        return response()->json($breed);
    } 
    public function update(DogBreed $breed, DogBreedRequest $request)
    {
        try {

            $breedValidated = $request->validated();
            // $imagen = $breed->imagen;
            // $request->imagen == $breed->imagen ?? ($imagen = imageInStorage($request->imagen));
            // $breedValidated['image'] = $imagen;
            $breed->update($breedValidated);
            return response()->json([
                'status' => true,
                'message' => 'Raza actualizada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    } 
    
    public function store(DogBreedRequest $request)
    {
        try {
            $breed = $request->validated();
            // $imagen = imageInStorage($request->imagen);
            // $breed['imagen'] = $imagen;
            DogBreed::create($breed);
            return response()->json([
                'status' => true,
                'message' => 'Raza creada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }   
    
    public function destroy(Request $request, DogBreed $breed)
    {
        try {
            $breed->delete();
            return response()->json([
                'status' => true,
                'message' => 'Raza borrada correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
