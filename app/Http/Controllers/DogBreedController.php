<?php

namespace App\Http\Controllers;

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
}
