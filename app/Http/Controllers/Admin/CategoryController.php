<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCategoryRequest;
use App\Models\Category;
use App\Service\Admin\CategoryService;
use App\Service\Admin\HomeService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    protected HomeService $homeService;

    public function __construct(CategoryService $categoryService, HomeService $homeService)
    {
        $this->categoryService = $categoryService;
        $this->homeService = $homeService;
    }

    public function view(Request $request)
    {
        $this->authorize('isAdmin', User::class);

        return view('admin.category', [
            'categories' => $this->categoryService->getAll($request->get('data')),
            'dataTotal' => $this->homeService->getTotalRecord(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('isAdmin', User::class);
        if ($this->categoryService->create($request->get('name'))) {
            return redirect()->back()->with('success', "Create Category Success");
        }

        return redirect()->back()->with('error', "Error");
    }

    public function update(Category $category, Request $request)
    {
        $this->authorize('isAdmin', User::class);
        if ($this->categoryService->update($category, $request->get('data'))) {
            return redirect()->back()->with('success', "Update Category Success");
        }

        return redirect()->back()->with('error', "Error");
    }

    public function delete(Category $category)
    {
        $this->authorize('isAdmin', User::class);
        if ($this->categoryService->delete($category)) {
            return redirect()->back()->with('success', "Delete Category Success");
        }

        return redirect()->back()->with('error', "Error");
    }
}
