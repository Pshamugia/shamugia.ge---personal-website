<?php

namespace App\Models;

use App\Models\Author; // This line is crucial
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    protected $fillable = [
        'title', 'full_text', 'photo', 'author_id', 'subcategory', 'description', 'category_id'];
   
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    
}
