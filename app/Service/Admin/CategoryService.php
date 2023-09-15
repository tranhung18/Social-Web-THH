<?php

namespace App\Service\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function getAll(string $data = null): LengthAwarePaginator
    {
        $query = Category::query();

        if ($data) {
            $query->where('name', 'like', '%' . $data . '%');
        }
        return $query->with('blogs')->paginate(Category::LIMIT_PAGE);
    }

    public function create(string $name): bool
    {
        try {
            Category::create(['name' => $name]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update(object $category, $data): bool
    {
        try {
            $category->update(['name' => $data]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete(object $category): bool
    {
        try {
            DB::beginTransaction();
            $blogIds = Post::where('category_id', $category->id)->pluck('id');
            foreach ($blogIds as $id) {
                $blog = Post::find($id);
                $blog->likes()->detach();
                Comment::where('post_id', $blog->id)->delete();
                $blog->delete();
            }
            $category->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
