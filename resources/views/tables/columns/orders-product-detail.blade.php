<div class="p-4">
    @foreach ($getRecord()->products as $product)
        <div class="flex items-center justify-between gap-2 flex-wrap">
            <img src="{{ $getRecord()->product($product['id'])->gambarThumbnail->url }}" class="w-8 h-8 rounded-full"
                alt="">
            <span class="dark:text-white mx-2">{{ $product['name'] }}</span>
        </div>
    @endforeach
</div>
