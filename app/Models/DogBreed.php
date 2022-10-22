<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DogBreed extends Model
{
    protected $table = 'dogs_breeds';
    use HasFactory;
    protected $fillable = [
        'name', 
        'size', 
        'hair_color',
    ]; 

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
