<?php

namespace App\Services\Front;

use App\Repositories\Front\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findProductBySlug($slug)
    {
        return $this->productRepository->getProductBySlug($slug);
    }

    public function findSimilarProducts($categoryId, $excludeProductId, $take = null)
    {
        return $this->productRepository->findByCategoryExcludingProduct($categoryId, $excludeProductId, $take);
    }
}
