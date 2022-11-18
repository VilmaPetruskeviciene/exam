<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'summary', 'ISBN', 'pages', 'category_id'];

    public function getCategory()
    {
       return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
