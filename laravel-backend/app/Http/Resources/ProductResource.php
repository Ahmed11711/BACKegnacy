<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'sku' => $this->sku,
            'price' => (float) $this->price,
            'sale_price' => $this->sale_price ? (float) $this->sale_price : null,
            'final_price' => (float) $this->final_price,
            'stock_quantity' => $this->stock_quantity,
            'stock_status' => $this->stock_status,
            'in_stock' => $this->inStock(),
            'is_on_sale' => $this->isOnSale(),
            'images' => $this->images ? array_map(fn($img) => asset('storage/' . $img), $this->images) : [],
            'category' => $this->whenLoaded('category', fn() => new CategoryResource($this->category)),
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
