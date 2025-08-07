<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    /** @use HasFactory<\Database\Factories\TextFactory> */
    use HasFactory;


    protected $guarded=[]; 



    public function chat(){
        return $this->belongsTo(Chat::class); 
    }
}
