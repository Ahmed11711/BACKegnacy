@extends('layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product: ' . $product->name)
@section('page-description', 'Update product information')

@section('content')
<div class="max-w-4xl">
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Product Name *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $product->name) }}"
                        required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-300 mb-2">SKU</label>
                    <input 
                        type="text" 
                        id="sku" 
                        name="sku" 
                        value="{{ old('sku', $product->sku) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('sku')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="short_description" class="block text-sm font-medium text-gray-300 mb-2">Short Description</label>
                <textarea 
                    id="short_description" 
                    name="short_description" 
                    rows="2"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >{{ old('short_description', $product->short_description) }}</textarea>
                @error('short_description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price *</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ old('price', $product->price) }}"
                        step="0.01"
                        min="0"
                        required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('price')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sale_price" class="block text-sm font-medium text-gray-300 mb-2">Sale Price</label>
                    <input 
                        type="number" 
                        id="sale_price" 
                        name="sale_price" 
                        value="{{ old('sale_price', $product->sale_price) }}"
                        step="0.01"
                        min="0"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('sale_price')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-300 mb-2">Stock Quantity</label>
                    <input 
                        type="number" 
                        id="stock_quantity" 
                        name="stock_quantity" 
                        value="{{ old('stock_quantity', $product->stock_quantity) }}"
                        min="0"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('stock_quantity')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select 
                        id="category_id" 
                        name="category_id" 
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                        <option value="">No Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock_status" class="block text-sm font-medium text-gray-300 mb-2">Stock Status</label>
                    <select 
                        id="stock_status" 
                        name="stock_status" 
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                        <option value="in_stock" {{ old('stock_status', $product->stock_status) === 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="out_of_stock" {{ old('stock_status', $product->stock_status) === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="on_backorder" {{ old('stock_status', $product->stock_status) === 'on_backorder' ? 'selected' : '' }}>On Backorder</option>
                    </select>
                    @error('stock_status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-300 mb-2">Product Images</label>
                <input 
                    type="file" 
                    id="images" 
                    name="images[]" 
                    multiple
                    accept="image/*"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >
                @error('images')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Upload new images to replace existing ones</p>
                @if($product->images && count($product->images) > 0)
                <div class="mt-4 flex gap-4 flex-wrap">
                    @foreach($product->images as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Product image" class="size-20 rounded-lg object-cover">
                    @endforeach
                </div>
                @endif
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="is_featured" 
                        name="is_featured" 
                        value="1"
                        {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                        class="rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                    >
                    <label for="is_featured" class="ml-2 text-sm text-gray-300">Featured Product</label>
                </div>
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="is_active" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                        class="rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                    >
                    <label for="is_active" class="ml-2 text-sm text-gray-300">Active</label>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-white/10">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold px-8 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
                    Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="border border-white/20 hover:border-white text-white font-bold px-8 py-3 rounded-lg transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
