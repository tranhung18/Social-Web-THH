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
        $totalUserInActive = User::where('status', User::STATUS_INACTIVE)->count();
        $totalBlog = Post::count();
        $totalCategory = Category::count();

        return [
            'totalUser' => $totalUser,
            'totalUserInActive' => $totalUserInActive,
            'totalBlog' => $totalBlog,
            'totalCategory' => $totalCategory,
        ];
    }
}
