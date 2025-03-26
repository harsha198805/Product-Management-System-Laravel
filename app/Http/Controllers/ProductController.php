<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Admin\ProductService;
use App\Services\Admin\CategoryService;
use App\Traits\LogsActivity;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $paginationLimit = 10;
    use LogsActivity;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = $this->productService->getAllProducts($search, $this->paginationLimit);
        return view('admin.products.index', compact('products'));
    }

    public function getdata(Request $request)
    {
        $search = $request->input('search');
        $products = $this->productService->getAllProducts($search, $this->paginationLimit);
        return response()->json(['products' => $products]);
    }

    public function getCategoryList()
    {
        $where = ["status" => 1];
        $orderby['column'] = 'name';
        $orderby['sort'] = 'asc';
        $categories = $this->categoryService->getCategoryListFilter($where, $orderby, $columns = ['*']);
        return response()->json($categories);
    }

    public function addNewCategory(Request $request)
    {
        $validationErrors = $this->categoryService->validateCategory($request->all());

        if ($validationErrors) {
            return response()->json(['errors' => $validationErrors]);
        }

        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ];
        $category = $this->categoryService->createCategory($data);
        $this->LogActivity('create_category', 'Created new category in product page category_name : ' . $category->name ??'');

        return response()->json(['success' => 'Category created successfully', 'new_category_id' => $category->id]);
    }

    public function store(Request $request)
    {
        $validationErrors = $this->productService->validateproduct($request->all());

        if ($validationErrors) {
            return response()->json(['errors' => $validationErrors]);
        }
        $imagedata = $this->productService->prepareProductData($request);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'product_price' => $request->product_price,
            'sale_price' => $request->sale_price,
            'tags' => $request->tags,
            'product_weight' => $request->product_weight,
            'new_arrivals' =>  $request->has('new_arrivals') ? 1 : 0,
            'featured' => $request->has('featured') ? 1 : 0,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_1' => $imagedata['image_1'],
            'image_2' => $imagedata['image_2'],
            'image_3' => $imagedata['image_3'],
            'image_4' => $imagedata['image_4'],
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'focus_keywords' => $request->focus_keywords,
        ];
        $this->productService->createProduct($data);
        $this->LogActivity('create_product', 'Created new product name : ' . $request->name ??'');
        return response()->json(['success' => 'Product created successfully!']);
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        if ($product) {
            return response()->json(['product' => $product]);
        }
        return response()->json(['error' => 'Product not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $validationErrors = $this->productService->validateproduct($request->all(), $id);
        if ($validationErrors) {
            return response()->json(['errors' => $validationErrors]);
        }
        $products = $this->productService->getProductById($id);
        if (!$products) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $imagedata = $this->productService->prepareProductData($request, $products);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'product_price' => $request->product_price,
            'sale_price' => $request->sale_price,
            'tags' => $request->tags,
            'product_weight' => $request->product_weight,
            'new_arrivals' =>  $request->has('new_arrivals') ? 1 : 0,
            'featured' => $request->has('featured') ? 1 : 0,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_1' => $imagedata['image_1'] ?? $products['image_1'],
            'image_2' => $imagedata['image_2'] ?? $products['image_2'],
            'image_3' => $imagedata['image_3'] ?? $products['image_3'],
            'image_4' => $imagedata['image_4'] ?? $products['image_4'],
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'focus_keywords' => $request->focus_keywords,
        ];
        $product = $this->productService->updateProduct($data, $id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $this->LogActivity('update_product', 'Update product id:'.$id??'');
        return response()->json(['success' => 'Product updated successfully!']);
    }

    public function destroy($id)
    {
        $deleted = $this->productService->deleteProduct($id);
        if (!$deleted) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $this->LogActivity('delete_product', 'Delete product  id:'.$id??'');
        return response()->json(['success' => 'Product deleted successfully']);
    }

    public function updateStatus(Request $request)
    {
        $product = $this->productService->getProductById($request->id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->status = $request->status;
        $product->save();
        $this->LogActivity('update_product_status', 'Update product id:'.$request->id??'');
        return response()->json(['success' => 'Status updated successfully.']);
    }
}
