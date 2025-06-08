<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 
    protected $fillable = [
        'title',
        'icon',
        'user_id'
    ];

    public function elements(){

        return $this->hasMany(Element::class);
    }

    public function user() { 

        return $this->belongsTo(User::class);
    }
}
