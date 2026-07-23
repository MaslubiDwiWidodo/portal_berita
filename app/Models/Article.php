<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id',
        'category_id',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
