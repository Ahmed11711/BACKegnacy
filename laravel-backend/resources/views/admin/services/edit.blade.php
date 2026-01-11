@extends('layouts.app')

@section('title', 'Edit Service')
@section('page-title', 'Edit Service: ' . $service->name)
@section('page-description', 'Update service information')

@section('content')
<div class="max-w-2xl">
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Service Name *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $service->name) }}"
                    required
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="short_description" class="block text-sm font-medium text-gray-300 mb-2">Short Description</label>
                <input 
                    type="text" 
                    id="short_description" 
                    name="short_description" 
                    value="{{ old('short_description', $service->short_description) }}"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >
                @error('short_description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
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
                        <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ old('price', $service->price) }}"
                        step="0.01"
                        min="0"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('price')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-300 mb-2">Icon</label>
                    <input 
                        type="text" 
                        id="icon" 
                        name="icon" 
                        value="{{ old('icon', $service->icon) }}"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('icon')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-300 mb-2">Order</label>
                    <input 
                        type="number" 
                        id="order" 
                        name="order" 
                        value="{{ old('order', $service->order) }}"
                        min="0"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('order')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-300 mb-2">Service Images</label>
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
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="is_featured" 
                        name="is_featured" 
                        value="1"
                        {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}
                        class="rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                    >
                    <label for="is_featured" class="ml-2 text-sm text-gray-300">Featured</label>
                </div>
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="is_active" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                        class="rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                    >
                    <label for="is_active" class="ml-2 text-sm text-gray-300">Active</label>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-white/10">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold px-8 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
                    Update Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="border border-white/20 hover:border-white text-white font-bold px-8 py-3 rounded-lg transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
