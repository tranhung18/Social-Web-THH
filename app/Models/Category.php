<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    const LIMIT_PAGE = 5;

    protected $table = "categories";

    protected $fillable = [
        'name',
    ];

    public function blogs(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
