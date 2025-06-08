<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'classification',
        'image',
        'category_id'
    ];

    public function category() {

        return $this->belongsTo(Category::class);
    }
}
