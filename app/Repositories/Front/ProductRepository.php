<?php

namespace App\Repositories\Front;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    public function getProductBySlug($slug)
    {
        try {
            $product = Product::with(['category'])->where('slug', $slug)
                ->where('status', 1)
                ->first();
            return $product;
        }  catch (Exception $e) {
            Log::error('Error in product front'.  ': ' . $e->getMessage());
            throw new Exception("An error occurred while fetching the product: " . $e->getMessage());
        }
    }

    public function findByCategoryExcludingProduct($categoryId, $excludeProductId, $take = null)
    {
        try {
            $query = Product::with(['category'])->where('category_id', $categoryId)
                ->where('id', '!=', $excludeProductId);

            if (!empty($take)) {
                $query = $query->take($take);
            }

            return $query->get();
        } catch (Exception $e) {
            Log::error('Error in product front'.  ': ' . $e->getMessage());
            return collect();
        }
    }
}
