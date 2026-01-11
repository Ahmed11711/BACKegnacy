<?php

namespace App\Http\Controllers;

use App\Http\Resources\BundleResource;
use App\Models\Bundle;
use App\Services\FileUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {}

    /**
     * Display a listing of bundles
     */
    public function index(Request $request): JsonResponse
    {
        $query = Bundle::query();

        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $perPage = $request->get('per_page', 15);
        $bundles = $query->with('products')->paginate($perPage);

        return response()->json([
            'data' => BundleResource::collection($bundles->items()),
            'meta' => [
                'current_page' => $bundles->currentPage(),
                'last_page' => $bundles->lastPage(),
                'per_page' => $bundles->perPage(),
                'total' => $bundles->total(),
            ],
        ]);
    }

    /**
     * Store a newly created bundle
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->fileUploadService->uploadImage($request->file('image'), 'bundles');
        }

        $products = $data['products'];
        unset($data['products']);

        $bundle = Bundle::create($data);

        // Attach products
        foreach ($products as $product) {
            $bundle->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        return response()->json([
            'message' => 'Bundle created successfully',
            'data' => new BundleResource($bundle->load('products')),
        ], 201);
    }

    /**
     * Display the specified bundle
     */
    public function show(Bundle $bundle): JsonResponse
    {
        return response()->json([
            'data' => new BundleResource($bundle->load('products')),
        ]);
    }

    /**
     * Update the specified bundle
     */
    public function update(Request $request, Bundle $bundle): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'products' => 'sometimes|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($bundle->image) {
                $this->fileUploadService->delete($bundle->image);
            }
            $data['image'] = $this->fileUploadService->uploadImage($request->file('image'), 'bundles');
        }

        if (isset($data['products'])) {
            $bundle->products()->sync([]);
            foreach ($data['products'] as $product) {
                $bundle->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }
            unset($data['products']);
        }

        $bundle->update($data);

        return response()->json([
            'message' => 'Bundle updated successfully',
            'data' => new BundleResource($bundle->fresh(['products'])),
        ]);
    }

    /**
     * Remove the specified bundle
     */
    public function destroy(Bundle $bundle): JsonResponse
    {
        $bundle->delete();

        return response()->json([
            'message' => 'Bundle deleted successfully',
        ]);
    }
}
