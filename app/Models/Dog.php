<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    protected $table = 'dogs';
    use HasFactory;
    protected $fillable = [
        'name', 
        'hair_color',
        'size',
        'breed_id',
        'image'
    ]; 

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function breed(){
        return $this->belongsTo(DogBreed::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    
}
