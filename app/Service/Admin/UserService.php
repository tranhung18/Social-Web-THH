<?php

namespace App\Service\Admin;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $columnName = [
        'user_name',
        'email',
    ];

    public function getAllUser(array $data): LengthAwarePaginator
    {
        $query = User::query();
        ['type' => $type, 'check' => $check, 'dataSearch' => $dataSearch] = $data;

        if (!is_null($data) && $check !== 0) {
            $query->where($type, $check);
        }

        $content = '%' . trim($dataSearch) . '%';
        $query->where(function ($q) use ($content) {
            foreach ($this->columnName as $column) {
                $q->orWhere($column, 'like', $content);
            }
        });

        return $query->where('id', '<>', Auth::id())
            ->paginate(User::LIMIT_USER_PAGE);
    }

    public function updateStatus(object $user)
    {
        try {
            $user->update([
                'status' => !$user->status
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateRole(object $user)
    {
        try {
            $role = ($user->role === User::ROLE_ADMIN)
                ? User::ROLE_USER
                : User::ROLE_ADMIN;
            $user->update(['role' => $role]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete(object $user): bool
    {
        try {
            if (Auth::id() === $user->id) {
                return false;
            }
            DB::beginTransaction();
            $user->likes()->detach();
            $user->comments()->delete();
            $user->blogs()->delete();
            $user->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
