<?php

namespace App\Services\Front;

use App\Repositories\Front\BlogFrontRepository;

class BlogFrontService
{
    protected $blogFrontRepository;

    public function __construct(BlogFrontRepository $blogFrontRepository)
    {
        $this->blogFrontRepository = $blogFrontRepository;
    }

    public function getAllBlogs()
    {
        return $this->blogFrontRepository->getAllBlogs();
    }

    public function getBlogById($slug)
    {
        return $this->blogFrontRepository->getBlogById($slug);
    }

    public function getNextBlog($created_at)
    {
        return $this->blogFrontRepository->getNextBlog($created_at);
    }

    public function getPreviousBlog($created_at)
    {
        return $this->blogFrontRepository->getPreviousBlog($created_at);
    }

}
