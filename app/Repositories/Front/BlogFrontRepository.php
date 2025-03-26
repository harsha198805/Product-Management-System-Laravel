<?php
namespace App\Repositories\Front;

use App\Models\Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;

class BlogFrontRepository
{
    public function getAllBlogs()
    {
        try {
            return Blog::where('status', 1)->orderBy('created_at', 'desc')->get();
        } catch (Exception $e) {
            Log::error('Error fetching blogs: ' . $e->getMessage());
            return null;
        }
    }

    public function getBlogById($slug)
    {
        try {
            $blog = Blog::where('slug', $slug)
            ->first();
            return $blog;
        } catch (ModelNotFoundException $e) {
            Log::error('Blog not found with slug ' . $slug . ': ' . $e->getMessage());
            return null;  
        } catch (Exception $e) {
            Log::error('Error fetching blog by slug ' . $slug . ': ' . $e->getMessage());
            return null;
        }
    }

    public function getNextBlog($created_at)
    {
        try {
        return Blog::where('created_at', '>', $created_at)
            ->orderBy('created_at', 'asc')
            ->first();
        } catch (ModelNotFoundException $e) {
            Log::error('Blog not found with slug ' . $created_at . ': ' . $e->getMessage());
            return null;  
        } catch (Exception $e) {
            Log::error('Error fetching blog by slug ' . $created_at . ': ' . $e->getMessage());
            return null;
        }
    }

    public function getPreviousBlog($created_at)
    {
        try {
        return Blog::where('created_at', '<', $created_at)
            ->orderBy('created_at', 'desc')
            ->first();
        } catch (ModelNotFoundException $e) {
            Log::error('Blog not found with slug ' . $created_at . ': ' . $e->getMessage());
            return null;  
        } catch (Exception $e) {
            Log::error('Error fetching blog by slug ' . $created_at . ': ' . $e->getMessage());
            return null;
        }
    }

}
