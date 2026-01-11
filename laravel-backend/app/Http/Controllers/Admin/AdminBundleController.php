<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Product;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class AdminBundleController extends Controller
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {}

    /**
     * Display a listing of bundles.
     */
    public function index(Request $request)
    {
        $query = Bundle::with('products');

        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $bundles = $query->latest()->paginate(15);

        return view('admin.bundles.index', compact('bundles'));
    }

    /**
     * Show the form for creating a new bundle.
     */
    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('admin.bundles.create', compact('products'));
    }

    /**
     * Store a newly created bundle.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:5120',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);
        
        // Filter out unchecked products (those without id)
        $validated['products'] = array_filter($validated['products'], function($product) {
            return isset($product['id']) && !empty($product['id']);
        });

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUploadService->uploadImage($request->file('image'), 'bundles');
        }

        $products = $validated['products'];
        unset($validated['products']);

        $bundle = Bundle::create($validated);

        foreach ($products as $product) {
            $bundle->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        return redirect()->route('admin.bundles.index')->with('success', 'Bundle created successfully');
    }

    /**
     * Display the specified bundle.
     */
    public function show(Bundle $bundle)
    {
        $bundle->load('products');
        return view('admin.bundles.show', compact('bundle'));
    }

    /**
     * Show the form for editing the specified bundle.
     */
    public function edit(Bundle $bundle)
    {
        $products = Product::where('is_active', true)->get();
        $bundle->load('products');
        return view('admin.bundles.edit', compact('bundle', 'products'));
    }

    /**
     * Update the specified bundle.
     */
    public function update(Request $request, Bundle $bundle)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:5120',
            'products' => 'sometimes|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($bundle->image) {
                $this->fileUploadService->delete($bundle->image);
            }
            $validated['image'] = $this->fileUploadService->uploadImage($request->file('image'), 'bundles');
        }

        if (isset($validated['products'])) {
            $productsData = [];
            foreach ($validated['products'] as $product) {
                if (isset($product['id']) && !empty($product['id'])) {
                    $productsData[$product['id']] = ['quantity' => $product['quantity']];
                }
            }
            $bundle->products()->sync($productsData);
            unset($validated['products']);
        }

        $bundle->update($validated);

        return redirect()->route('admin.bundles.index')->with('success', 'Bundle updated successfully');
    }

    /**
     * Remove the specified bundle.
     */
    public function destroy(Bundle $bundle)
    {
        $bundle->delete();
        return redirect()->route('admin.bundles.index')->with('success', 'Bundle deleted successfully');
    }
}
