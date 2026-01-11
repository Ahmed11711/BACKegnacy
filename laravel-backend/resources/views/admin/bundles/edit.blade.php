@extends('layouts.app')

@section('title', 'Edit Bundle')
@section('page-title', 'Edit Bundle: ' . $bundle->name)
@section('page-description', 'Update bundle information')

@section('content')
<div class="max-w-3xl">
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <form method="POST" action="{{ route('admin.bundles.update', $bundle->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Bundle Name *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $bundle->name) }}"
                    required
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >
                @error('name')
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
                >{{ old('description', $bundle->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price *</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ old('price', $bundle->price) }}"
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
                        value="{{ old('sale_price', $bundle->sale_price) }}"
                        step="0.01"
                        min="0"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    >
                    @error('sale_price')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Bundle Image</label>
                <input 
                    type="file" 
                    id="image" 
                    name="image" 
                    accept="image/*"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                >
                @error('image')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
                @if($bundle->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-400 mb-2">Current Image:</p>
                    <img src="{{ asset('storage/' . $bundle->image) }}" alt="{{ $bundle->name }}" class="size-32 rounded-lg object-cover">
                </div>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-4">Products in Bundle</label>
                <div class="space-y-3 max-h-96 overflow-y-auto bg-white/5 rounded-lg p-4">
                    @php
                        $bundleProductIds = $bundle->products->pluck('id')->toArray();
                        $bundleProductQuantities = [];
                        foreach($bundle->products as $product) {
                            $bundleProductQuantities[$product->id] = $product->pivot->quantity;
                        }
                    @endphp
                    @php
                        $selectedIndex = 0;
                    @endphp
                    @foreach($products as $product)
                    <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg">
                        <div class="flex items-center gap-3">
                            <input 
                                type="checkbox" 
                                name="products[{{ $loop->index }}][id]" 
                                value="{{ $product->id }}"
                                id="product_{{ $product->id }}"
                                {{ in_array($product->id, $bundleProductIds) ? 'checked' : '' }}
                                class="product-checkbox rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                                onchange="toggleProductQuantity(this)"
                            >
                            <label for="product_{{ $product->id }}" class="text-white font-medium cursor-pointer">
                                {{ $product->name }} - ${{ number_format($product->price, 2) }}
                            </label>
                        </div>
                        <input 
                            type="number" 
                            name="products[{{ $loop->index }}][quantity]" 
                            value="{{ in_array($product->id, $bundleProductIds) ? ($bundleProductQuantities[$product->id] ?? 1) : 1 }}"
                            min="1"
                            {{ in_array($product->id, $bundleProductIds) ? '' : 'disabled' }}
                            class="product-quantity w-20 bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-primary"
                        >
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="is_active" 
                    name="is_active" 
                    value="1"
                    {{ old('is_active', $bundle->is_active) ? 'checked' : '' }}
                    class="rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                >
                <label for="is_active" class="ml-2 text-sm text-gray-300">Active</label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-white/10">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold px-8 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
                    Update Bundle
                </button>
                <a href="{{ route('admin.bundles.index') }}" class="border border-white/20 hover:border-white text-white font-bold px-8 py-3 rounded-lg transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function toggleProductQuantity(checkbox) {
    const quantityInput = checkbox.closest('div').querySelector('.product-quantity');
    quantityInput.disabled = !checkbox.checked;
    if (!checkbox.checked) {
        quantityInput.value = 1;
    }
}
</script>
@endpush
@endsection
