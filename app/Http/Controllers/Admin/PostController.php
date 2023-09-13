<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Service\User\PostService as PostServiceUser;
use App\Service\Admin\PostService as PostServiceAdmin;
use App\Service\User\CategoryService;
use App\Http\Controllers\Controller;
use App\Service\Admin\HomeService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostServiceAdmin $postServiceAdmin;

    protected HomeService $homeService;

    protected PostServiceUser $postServiceUser;

    protected CategoryService $categoryService;

    public function __construct(
        HomeService $homeService,
        PostServiceAdmin $postServiceAdmin,
        PostServiceUser $postServiceUser,
        CategoryService $categoryService
    ) {
        $this->postServiceAdmin = $postServiceAdmin;
        $this->postServiceUser = $postServiceUser;
        $this->categoryService = $categoryService;
        $this->homeService = $homeService;
    }

    public function viewBlog(Request $request)
    {
        $this->authorize('isAdmin', User::class);

        $data = [
            'status' => $request->get('status'),
            'dataSearch' => $request->get('dataSearch'),
            'categoryId' => $request->get('id'),
        ];

        return view('admin.blog', [
            'blogs' => $this->postServiceAdmin->getAll($data),
            'categories' => $this->categoryService->getAll(),
            'dataTotal' => $this->homeService->getTotalRecord(),
        ]);
    }

    public function approvedBlog(Post $blog)
    {
        $this->authorize('isAdmin', User::class);
        if ($this->postServiceAdmin->approvedBlog($blog)) {
            return redirect()->back()->with('success', __('admin.msg_update_status_blog_success'));
        }

        return redirect()->back()->with('error', __('admin.msg_approved_blog_fail'));
    }

    public function deleteBlog(Post $blog)
    {
        $this->authorize('delete', $blog);

        if ($this->postServiceUser->deleteBlog($blog)) {
            return redirect()->back()->with('success', __('admin.msg_delete_blog_success'));
        }

        return redirect()->back()->with('error', __('admin.msg_delete_blog_fail'));
    }
}
