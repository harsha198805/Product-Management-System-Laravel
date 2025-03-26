<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;

class UserController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $blogCount = Blog::count();
        return view('user.dashboard', compact('productCount','categoryCount','blogCount'));
    }
}