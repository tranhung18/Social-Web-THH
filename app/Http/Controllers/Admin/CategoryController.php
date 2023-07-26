<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\Admin\UserService;
use App\Service\User\PostService;
use App\Http\Controllers\Controller;
use App\Service\Admin\CategoryService;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function view()
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.category', [
            'categories' => $this->categoryService->getAll(),
        ]);
    }
}
