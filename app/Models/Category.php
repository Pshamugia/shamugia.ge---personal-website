<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'position', 'is_hidden'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
    

}
