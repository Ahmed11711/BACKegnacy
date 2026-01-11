<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\FileUploadService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private FileUploadService $fileUploadService
    ) {}

    /**
     * Display a listing of products
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['search', 'category_id', 'is_active', 'is_featured', 'min_price', 'max_price', 'sort_by', 'sort_order']);
        $perPage = $request->get('per_page', 15);
        
        $products = $this->productService->getAll($filters, $perPage);

        return response()->json([
            'data' => ProductResource::collection($products->items()),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
        ]);
    }

    /**
     * Store a newly created product
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Handle image uploads
        if ($request->hasFile('images')) {
            $imagePaths = $this->fileUploadService->uploadMultiple($request->file('images'), 'products');
            $data['images'] = $imagePaths;
        }

        $product = $this->productService->create($data);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => new ProductResource($product->load('category')),
        ], 201);
    }

    /**
     * Display the specified product
     */
    public function show(Product $product): JsonResponse
    {
        $product = $this->productService->getById($product->id);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json([
            'data' => new ProductResource($product),
        ]);
    }

    /**
     * Update the specified product
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();

        // Handle image uploads
        if ($request->hasFile('images')) {
            $imagePaths = $this->fileUploadService->uploadMultiple($request->file('images'), 'products');
            $data['images'] = $imagePaths;
        }

        $product = $this->productService->update($product, $data);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => new ProductResource($product),
        ]);
    }

    /**
     * Remove the specified product
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->productService->delete($product);

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
