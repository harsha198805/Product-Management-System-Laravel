<?php

namespace App\Repositories\Admin;

use App\Models\Blog;
use Exception;
use Illuminate\Support\Facades\Log;

class BlogRepository
{
    public function getAllBlogs($search = null, $paginate = null)
    {

        try {
            $query = Blog::query();
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
            return $query->orderBy('created_at', 'desc')->paginate($paginate);
        } catch (Exception $e) {
            Log::error('General Exception: ' . $e->getMessage());
            throw new Exception('An error occurred while creating the blog.');
        }
    }

    public function findBlogById($id)
    {
        try {
            return Blog::findOrFail($id);
        } catch (Exception $e) {
            Log::error('General Exception: ' . $e->getMessage());
            throw new Exception("Error finding blog: " . $e->getMessage());
        }
    }

    public function createBlog($data)
    {
        try {
            return Blog::create($data);
        } catch (Exception $e) {
            Log::error('General Exception: ' . $e->getMessage());
            throw new Exception("Error creating blog: " . $e->getMessage());
        }
    }

    public function updateBlog($blog, $data)
    {
        try {
            return $blog->update($data);
        } catch (Exception $e) {
            Log::error('General Exception: ' . $e->getMessage());
            throw new Exception("Error updating blog: " . $e->getMessage());
        }
    }

    public function deleteBlog($blog)
    {
        try {
            return $blog->delete();
        } catch (Exception $e) {
            Log::error("General error deleting blog: " . $e->getMessage());
            throw new Exception("An unexpected error occurred while deleting the blog.");
        }
    }

    public function updateStatus($attributes, $data)
    {
        try {
            return Blog::where($attributes)->update($data);
        } catch (Exception $e) {
            Log::error('Error updating blog status', ['error' => $e->getMessage()]);
            throw new Exception('Error updating blog status.');
        }
    }
}
