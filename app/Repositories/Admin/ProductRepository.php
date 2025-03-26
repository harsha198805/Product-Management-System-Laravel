<?php
namespace App\Repositories\Admin;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAllProducts($search = null, $paginate = 10)
    {
        try {
            $query = $this->model::query();
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
            $query->orderBy('created_at', 'desc');
            return $query->paginate($paginate);
        } catch (Exception $e) {
            Log::error('Error fetching all products: ' . $e->getMessage());
            throw new Exception('Could not fetch products.');
        }
    }

    public function findById($id)
    {
        try {
            return $this->model::find($id);
        } catch (Exception $e) {
            Log::error('Error fetching product by ID ' . $id . ': ' . $e->getMessage());
            throw new Exception('Could not find product.');
        }
    }

    public function create(array $data)
    {
        try {
            return $this->model::create($data);
        } catch (Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            throw new Exception('Could not create product.');
        }
    }

    public function update(Product $product, array $data)
    {
        try {
            $product->update($data);
            return $product;
        } catch (Exception $e) {
            Log::error('Error updating product ID ' . $product->id . ': ' . $e->getMessage());
            throw new Exception('Could not update product.');
        }
    }

    public function delete(Product $product)
    {
        try {
            return $product->delete();
        } catch (Exception $e) {
            Log::error('Error deleting product ID ' . $product->id . ': ' . $e->getMessage());
            throw new Exception('Could not delete product.');
        }
    }
}
