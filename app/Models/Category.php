<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'category_name'
    ];

    // ==========================
    // RELASI KE ARTIKEL
    // ==========================
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}