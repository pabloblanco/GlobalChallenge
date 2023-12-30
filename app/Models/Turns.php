<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turns extends Model
{
    use HasFactory;

    protected $fillable = ['turn', 'status'];

    public function movies()
    {
        return $this->belongsToMany(Movies::class,'turns_movies');
    }
}
