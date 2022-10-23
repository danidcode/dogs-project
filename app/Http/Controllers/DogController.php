<?php

namespace App\Http\Controllers;

use App\Http\Requests\DogRequest;
use App\Models\Dog;
use App\Models\DogBreed;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index(Request $request)
    {
        $column = $request->column;
        $order = $request->order;
        $dogs = Dog::when(isset($order) && isset($column), function ($q) use ($column, $order) {
            $q->orderBy($column, $order);
        });
        $dogs = $dogs->paginate(5);
        $breeds = DogBreed::get();
        return response()->json(['dogs' => $dogs, 'breeds' => $breeds]);
    }
    public function show(Dog $dog)
    {
        return response()->json($dog);
    } 
    public function update(Dog $dog, DogRequest $request)
    {
        try {

            $dogValidated = $request->validated();
            $image = $dog->image;
            $request->image == $dog->imagen ?? ($image = imageInStorage($request->image));
            $dogValidated['image'] = $image;
            $dog->update($dogValidated);
            return response()->json([
                'status' => true,
                'message' => 'Perro actualizado correctamente',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    } 
    
    public function store(DogRequest $request)
    {
        try {
            $dog = $request->validated();
            $image = imageInStorage($request->image);
            $dog['image'] = $image;
            Dog::create($dog);
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
    
    public function destroy(Request $request, Dog $dog)
    {
        try {
            $dog->delete();
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
