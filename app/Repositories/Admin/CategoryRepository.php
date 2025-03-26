<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryRepository
{
    public function getAllCategories($search = null, $paginate = 10)
    {
        try {
            $query = Category::query();
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
            return $query->orderBy('created_at', 'desc')->paginate($paginate);
        } catch (Exception $e) {
            Log::error('General Exception:', ['error' => $e->getMessage()]);
            throw new Exception("Error fetching categories: " . $e->getMessage());
        }
    }

    public function findCategoryById($id)
    {
        try {
            return Category::findOrFail($id);
        } catch (Exception $e) {
            Log::error('General Exception:', ['error' => $e->getMessage()]);
            throw new Exception("Error finding category: " . $e->getMessage());
        }
    }

    public function getCategoryListFilter($where, $orderby, $columns = ['*'])
    {
        try {
            return Category::where($where)
                ->orderBy($orderby['column'], $orderby['sort'])
                ->get();
        } catch (Exception $e) {
            Log::error('General Exception:', ['error' => $e->getMessage()]);
            throw new Exception("Error fetching categories: " . $e->getMessage());
            return false;
        }
    }

    public function createCategory($data)
    {
        try {
            return Category::create($data);
        } catch (Exception $e) {
            Log::error('General Exception:', ['error' => $e->getMessage()]);
            throw new Exception("Error creating category: " . $e->getMessage());
        }
    }

    public function updateCategory($category, $data)
    {
        try {
            return $category->update($data);
        } catch (Exception $e) {
            Log::error('General Exception:', ['error' => $e->getMessage()]);
            throw new Exception("Error updating category: " . $e->getMessage());
        }
    }

    public function deleteCategory($category)
    {
        try {
            return $category->delete();
        } catch (Exception $e) {
            Log::error('General Exception:', ['error' => $e->getMessage()]);
            throw new Exception("Error deleting category: " . $e->getMessage());
        }
    }

    public function updateStatus($attributes, $data)
    {
        try {
            return Category::where($attributes)->update($data);
        } catch (Exception $e) {
            Log::error('Error updating category status', ['error' => $e->getMessage()]);
            throw new Exception("Error updating category: " . $e->getMessage());
            return false;
        }
    }
    public function isCategoryUsedInProducts($categoryId)
    {
        try {
            return Product::where('category_id', $categoryId)
                ->exists();
        } catch (Exception $e) {
            Log::error('General Exception:', ['error' => $e->getMessage()]);
            throw new Exception("General Exception:: " . $e->getMessage());
            return false;
        }
    }
}
