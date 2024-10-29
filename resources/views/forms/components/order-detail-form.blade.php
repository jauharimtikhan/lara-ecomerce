<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div class="flex flex-col gap-2 bg-gray-50 dark:bg-gray-800 p-4 rounded-lg" x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <span class="dark:text-white">Invoice Id: {{ $getRecord()->transaction_id }}</span>
        <span class="dark:text-white">Nama Penerima: {{ $getRecord()->user->name }}</span>
        <span class="dark:text-white">No Telepon: {{ $getRecord()->userDetail->notelp }}</span>
        <span class="dark:text-white">Alamat Pengiriman: {{ $getRecord()->userDetail->alamat_lengkap }}</span>
        <span class="dark:text-white">Perlu Dikirim Sebelum: {{ $getRecord()->dateToDelivery() }}</span>
    </div>
</x-dynamic-component>
