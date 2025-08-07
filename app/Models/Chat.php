<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /** @use HasFactory<\Database\Factories\ChatFactory> */
    use HasFactory;

    protected $guarded= []; 


    public function texts(){
        return $this->hasMany(Text::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
