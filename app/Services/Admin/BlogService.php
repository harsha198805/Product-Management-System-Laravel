<?php

namespace App\Services\Admin;

use App\Repositories\Admin\BlogRepository;
use Illuminate\Support\Facades\Validator;

class BlogService
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function validateBlog($data, $blogId = null)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:blogs,slug' . ($blogId ? ',' . $blogId : ''),
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:1,0',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'focus_keywords' => 'nullable|string',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return null;
    }

    public function getAllblogs($search, $paginate = null)
    {
        return $this->blogRepository->getAllblogs($search, $paginate);
    }

    public function createBlog($data)
    {
        return $this->blogRepository->createBlog($data);
    }

    public function findBlogById($id)
    {
        return $this->blogRepository->findBlogById($id);
    }

    public function updateBlog($id, $data)
    {
        $blog = $this->blogRepository->findBlogById($id);
        return $this->blogRepository->updateBlog($blog, $data);
    }

    public function deleteBlog($id)
    {
        $blog = $this->blogRepository->findBlogById($id);
        return $this->blogRepository->deleteBlog($blog);
    }

    public function updateStatus($attributes, $data)
    {
        return $this->blogRepository->updateStatus($attributes, $data);
    }
}
