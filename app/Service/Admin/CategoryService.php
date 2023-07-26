<?php

namespace App\Service\Admin;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAll(): Collection
    {
        return Category::where('status', Category::TYPE_CATEGORY_ACTIVE)->get();
    }
}
