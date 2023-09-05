<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Service\Admin\CategoryService;
use App\Service\Admin\HomeService;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    protected HomeService $homeService;

    public function __construct(CategoryService $categoryService, HomeService $homeService)
    {
        $this->categoryService = $categoryService;
        $this->homeService = $homeService;
    }

    public function view()
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.category', [
            'categories' => $this->categoryService->getAll(),
            'dataTotal' => $this->homeService->getTotalRecord(),
        ]);
    }
}
