<div class="p-4">
    @foreach ($products($getRecord())[0] as $product)
        {{-- @dd($product) --}}
        <div class="flex items-center justify-between gap-2 flex-wrap">
            <img src="{{ asset('storage/' . $product->gambarThumbnail->path) }}" class="w-8 h-8 rounded-full"
                alt="">
            <span class="dark:text-white mx-2">{{ $product->name }}</span>
        </div>
    @endforeach
</div>
