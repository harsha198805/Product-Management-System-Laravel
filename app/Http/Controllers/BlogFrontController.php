<?php

namespace App\Http\Controllers;

use App\Services\Front\BlogFrontService;

class BlogFrontController extends Controller
{

    protected $blogFrontService;

    public function __construct(BlogFrontService $blogFrontService)
    {
        $this->blogFrontService = $blogFrontService;
    }

    public function index()
    {
        $blogs = $this->blogFrontService->getAllBlogs();
        return view('front.blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = $this->blogFrontService->getBlogById($slug);
        if (!$blog) {
            return redirect()->route('front_blogs.index')->with('error', 'Blog not found');
        }
        $meta_title =  $blog->meta_title??'';
        $meta_description =  $blog->meta_description??'';
        $focus_keywords =  $blog->focus_keywords??'';

        $nextBlog = $this->blogFrontService->getNextBlog($blog->created_at);
        $previousBlog = $this->blogFrontService->getPreviousBlog($blog->created_at);
        return view('front.blogs.show', compact('blog', 'nextBlog', 'previousBlog','meta_title', 'meta_description','focus_keywords'));
    }
}
