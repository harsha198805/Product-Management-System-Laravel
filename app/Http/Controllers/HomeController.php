<?php

namespace App\Http\Controllers;

use App\Services\Front\CategoryService;
use App\Services\Front\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    protected $categoryService;
    protected $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index()
    {
        $categories_with_products = $this->categoryService->getCategoriesWithProducts();
        return view('front.home', compact('categories_with_products'));
    }

    public function freshCatch()
    {
        $categories_with_products = $this->categoryService->getCategoriesWithProducts();
        return view('front.fresh_catch', compact('categories_with_products'));
    }

    public function productShow($slug)
    {
        $product = $this->productService->findProductBySlug($slug);
        if (!$product) {
            throw new ModelNotFoundException("Product not found");
        }

        $meta_title =  $product->meta_title??'';
        $meta_description =  $product->meta_description??'';
        $focus_keywords =  $product->focus_keywords??'';
        $similarProducts = $this->productService->findSimilarProducts($product->category_id, $product->id, $take = 20);

        return view('front.products.show', compact('product', 'similarProducts','meta_title', 'meta_description','focus_keywords'));
    }
    public function categoryPage($slug)
    {
        $categories = $this->categoryService->findCategoryBySlug($slug);
        if (!$categories) {
            throw new ModelNotFoundException("Category not found");
        }
        return view('front.categories.show', compact('categories'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function quality_traceability()
    {
        return view('front.quality_traceability');
    }

    public function contact()
    {
        return view('front.contact');
    }
    public function gallery()
    {
        return view('front.gallery');
    }
}
