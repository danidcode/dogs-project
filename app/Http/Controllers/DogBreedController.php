<?php

namespace App\Http\Controllers;

use App\Http\Requests\DogBreedRequest;
use App\Models\DogBreed;
use Illuminate\Http\Request;

class DogBreedController extends Controller
{
    public function index(Request $request)
    {
        $column = $request->column;
        $order = $request->order;
        $dog_breeds = DogBreed::when(isset($order) && isset($column), function ($q) use ($column, $order) {
            $q->orderBy($column, $order);
        });
        $dog_breeds = $dog_breeds->paginate(5);
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
            $image = $breed->image;
            $request->image == $breed->imagen ?? ($image = imageInStorage($request->image));
            $breedValidated['image'] = $image;
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
            $image = imageInStorage($request->image);
            $breed['image'] = $image;
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
