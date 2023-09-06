<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const LIMIT_PAGE = 5;

    const TYPE_CATEGORY_INACTIVE = 0;

    const TYPE_CATEGORY_ACTIVE = 1;


    protected $table = "categories";
}
