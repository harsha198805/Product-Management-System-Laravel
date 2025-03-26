<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $blogCount = Blog::count();
        $userCount = User::count();
        return view('admin.dashboard', compact('productCount','categoryCount','blogCount','userCount'));
    }
}
