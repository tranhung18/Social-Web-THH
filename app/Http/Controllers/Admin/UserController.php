<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\Admin\UserService;
use App\Service\User\PostService;
use App\Http\Controllers\Controller;
use App\Service\Admin\HomeService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected HomeService $homeService;

    protected UserService $userService;

    protected PostService $postService;

    public function __construct(HomeService $homeService, UserService $userService, PostService $postService)
    {
        $this->userService = $userService;
        $this->postService = $postService;
        $this->homeService = $homeService;
    }

    public function viewUser(Request $request)
    {
        $this->authorize('isAdmin', User::class);
        $data = [
            'type' => $request->get('type'),
            'check' => $request->get('check'),
            'dataSearch' => $request->get('dataSearch'),
        ];
        return view('admin.user', [
            'users' => $this->userService->getAllUser($data),
            'dataTotal' => $this->homeService->getTotalRecord(),
        ]);
    }

    public function viewProfileUser(User $user)
    {
        $this->authorize('isAdmin', User::class);

        return view('users.profile', [
            'profile' => $user,
        ]);
    }

    public function updateStatus(User $user)
    {
        $this->authorize('isAdmin', User::class);

        if ($this->userService->updateStatus($user)) {
            return redirect()->route('admin.user.index')->with('success', 'Update Status Success');
        }

        return redirect()->route('admin.user.index')->with('error', 'Update Status Error');
    }

    public function updateRole(User $user)
    {
        $this->authorize('isAdmin', User::class);

        if ($this->userService->updateRole($user)) {
            return redirect()->route('admin.user.index')->with('success', 'Update Role Success');
        }

        return redirect()->route('admin.user.index')->with('error', 'Update Role Error');
    }

    public function deleteUser(User $user)
    {
        $this->authorize('isAdmin', User::class);

        if ($this->userService->delete($user)) {
            return redirect()->route('admin.user.index')->with('success', __('admin.msg_delete_user_success'));
        }

        return redirect()->route('admin.user.index')->with('error', __('admin.msg_delete_user_fail'));
    }
}
