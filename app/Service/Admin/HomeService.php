<?php

namespace App\Service\Admin;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class HomeService
{
    public function getTotalRecord(): array
    {
        $totalUser = User::count();
        $totalBlog = Post::count();
        $totalCategory = Category::count();

        return [
            'totalUser' => $totalUser,
            'totalBlog' => $totalBlog,
            'totalCategory' => $totalCategory,
        ];
    }
}
