<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\FileUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {}

    /**
     * Display a listing of services
     */
    public function index(Request $request): JsonResponse
    {
        $query = Service::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        if ($request->has('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        $perPage = $request->get('per_page', 15);
        $services = $query->with('category')->orderBy('order')->paginate($perPage);

        return response()->json([
            'data' => ServiceResource::collection($services->items()),
            'meta' => [
                'current_page' => $services->currentPage(),
                'last_page' => $services->lastPage(),
                'per_page' => $services->perPage(),
                'total' => $services->total(),
            ],
        ]);
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->validated();

        if ($request->hasFile('images')) {
            $imagePaths = $this->fileUploadService->uploadMultiple($request->file('images'), 'services');
            $data['images'] = $imagePaths;
        }

        $service = Service::create($data);

        return response()->json([
            'message' => 'Service created successfully',
            'data' => new ServiceResource($service),
        ], 201);
    }

    /**
     * Display the specified service
     */
    public function show(Service $service): JsonResponse
    {
        return response()->json([
            'data' => new ServiceResource($service->load('category')),
        ]);
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, Service $service): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->validated();

        if ($request->hasFile('images')) {
            $imagePaths = $this->fileUploadService->uploadMultiple($request->file('images'), 'services');
            $data['images'] = $imagePaths;
        }

        $service->update($data);

        return response()->json([
            'message' => 'Service updated successfully',
            'data' => new ServiceResource($service->fresh()),
        ]);
    }

    /**
     * Remove the specified service
     */
    public function destroy(Service $service): JsonResponse
    {
        $service->delete();

        return response()->json([
            'message' => 'Service deleted successfully',
        ]);
    }
}
