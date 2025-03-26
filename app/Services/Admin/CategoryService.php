<?php

namespace App\Services\Admin;

use App\Repositories\Admin\CategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function validateCategory($data, $categoryId = null)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug' . ($categoryId ? ',' . $categoryId : ''),
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:1,0',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return null;
    }

    public function getAllCategories($search, $paginate = null)
    {
        return $this->categoryRepository->getAllCategories($search, $paginate);
    }
    public function getCategoryListFilter($where, $orderby,$columns=['*'])
    {
        return $this->categoryRepository->getCategoryListFilter($where, $orderby, $columns);
    }

    public function createCategory($data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function findCategoryById($id)
    {
        return $this->categoryRepository->findCategoryById($id);
    }
    public function isCategoryUsedInProducts($categoryId)
    {
        return $this->categoryRepository->isCategoryUsedInProducts($categoryId);
    }
    public function updateCategory($id, $data)
    {
        $category = $this->categoryRepository->findCategoryById($id);
        return $this->categoryRepository->updateCategory($category, $data);
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryRepository->findCategoryById($id);
        return $this->categoryRepository->deleteCategory($category);
    }

    public function updateStatus($attributes, $data)
    {
        return $this->categoryRepository->updateStatus($attributes, $data);
    }
}
