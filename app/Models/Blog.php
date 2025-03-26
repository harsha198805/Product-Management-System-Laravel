<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model

{
    protected $table = 'blogs';
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'status', 'meta_title', 'meta_description', 'focus_keywords'
    ];

}
