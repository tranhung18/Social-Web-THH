<?php

namespace App\Service\Admin;

use Exception;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{
    public function getAll(array $data): LengthAwarePaginator
    {
        $query = Post::query();
        ['status' => $status, 'dataSearch' => $dataSearch, 'categoryId' => $categoryId] = $data;

        if ($status)
            $query->where('status', $status);

        if ($categoryId)
            $query->where('category_id', $categoryId);

        if ($dataSearch)
            $query->where('title', 'like', '%' . $dataSearch . '%');

        return $query->with(['likes', 'categories'])->paginate(Post::LIMIT_BLOG_PAGE);
    }

    public function approvedBlog(Post $blog): bool
    {
        try {
            $blog->update([
                'status' => !$blog->status
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
