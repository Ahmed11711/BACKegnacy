<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    use LogsActivity;

    /**
     * Get all products with pagination
     */
    public function getAll(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Product::query();

        // Search
        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category filter
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Status filter
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        // Featured filter
        if (isset($filters['is_featured'])) {
            $query->where('is_featured', $filters['is_featured']);
        }

        // Price range
        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }
        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        // Sort
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->with('category')->paginate($perPage);
    }

    /**
     * Get product by ID
     */
    public function getById(int $id): ?Product
    {
        return Product::with('category', 'bundles')->find($id);
    }

    /**
     * Get product by slug
     */
    public function getBySlug(string $slug): ?Product
    {
        return Product::where('slug', $slug)->with('category', 'bundles')->first();
    }

    /**
     * Create product
     */
    public function create(array $data): Product
    {
        $product = Product::create($data);
        $this->logActivity('created', $product, null, $product->toArray(), "Product {$product->name} created");
        return $product;
    }

    /**
     * Update product
     */
    public function update(Product $product, array $data): Product
    {
        $oldValues = $product->toArray();
        $product->update($data);
        $this->logActivity('updated', $product, $oldValues, $product->toArray(), "Product {$product->name} updated");
        return $product->fresh();
    }

    /**
     * Delete product
     */
    public function delete(Product $product): bool
    {
        $oldValues = $product->toArray();
        $result = $product->delete();
        $this->logActivity('deleted', $product, $oldValues, null, "Product {$product->name} deleted");
        return $result;
    }
}
