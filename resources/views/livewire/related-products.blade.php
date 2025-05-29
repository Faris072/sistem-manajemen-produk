<div class="p-4 shadow rounded-lg">
    <h3 class="text-xl font-semibold mb-4">Other Products in Same Category</h3>

    <input type="search" wire:model.live="search" placeholder="Search products..." class="form-input w-full mb-4 rounded-md text-black shadow-sm">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse ($relatedProducts as $productItem)
            <div class="border rounded-lg overflow-hidden shadow-sm flex flex-col">
                @if ($productItem->image)
                    <img src="{{ Storage::url($productItem->image) }}" alt="{{ $productItem->name }}" class="w-full h-32 object-cover"> @else
                    <div class="w-full h-32 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                @endif
                <div class="p-3 flex-grow">
                    <h4 class="text-lg font-medium">{{ $productItem->name }}</h4> <p class="text-gray-700">Rp {{ number_format($productItem->price, 0, ',', '.') }}</p> </div>
                {{-- <div class="p-3 border-t">
                    <a href="{{ route('filament.admin.resources.products.view', $productItem->id) }}" class="text-blue-600 hover:underline">View Details</a>
                </div> --}}
            </div>
        @empty
            <p>No other products found in this category.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $relatedProducts->links() }} </div>
</div>
