<?php

namespace App\Repositories\Front;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryRepository
{
    public function getAllCategories()
    {
        try {
            return Category::where('status', 1)->get();
        } catch (Exception $e) {
            Log::error('Error in category front'.  ': ' . $e->getMessage());
            return response()->json(['error' => 'Unable to retrieve categories at the moment.'], 500);
        }
    }
    public function getAllCategoriesWithImage()
    {
        try {
            return Category::where('status', 1)->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            Log::error('Error in category front'.  ': ' . $e->getMessage());
            return response()->json(['error' => 'Unable to retrieve categories at the moment.'], 500);
        }
    }

    public function getAllWithProducts()
    {
        try {
            $categories = Category::with(['products' => function ($query) {
                $query->where('status', 1);
            }])
                ->whereHas('products', function ($query) {
                    $query->where('status', 1);
                }, '>=', 1)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->get();
            return $categories;
        } catch (Exception $e) {
            Log::error('Error in category front'.  ': ' . $e->getMessage());
            return response()->json(['error' => 'Unable to retrieve categories and products at the moment.'], 500);
        }
    }

    public function findCategoryBySlug($slug)
    {
        try {
            $categories = Category::with(['products' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('slug', $slug)
            ->where('status', 1)
            ->get();
            return $categories;
        } catch (Exception $e) {
            Log::error('Error in category front'.  ': ' . $e->getMessage());
            throw new Exception("An error occurred while fetching the category: " . $e->getMessage());
        }
    }
}
