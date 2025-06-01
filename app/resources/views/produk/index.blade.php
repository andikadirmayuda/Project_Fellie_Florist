<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Produk') }}
            </h2>
            <a href="{{ route('admin.produk.create') }}" class="px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-plus mr-2"></i>{{ __('Tambah Produk') }}
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <form action="{{ route('admin.produk.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Filter Kategori</label>
                <select name="kategori" id="kategori" class="w-full rounded-md border-gray-300" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       class="w-full rounded-md border-gray-300" 
                       placeholder="Cari nama produk...">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Produk -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                @if($product->gambar)
                    <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama_produk }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No Image</span>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->nama_produk }}</h3>
                    <p class="text-sm text-gray-600">{{ $product->kode_produk }}</p>
                    <p class="text-sm text-gray-500 mt-2">Kategori: {{ $product->kategori->nama_kategori }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm px-2 py-1 {{ $product->status_produk === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded">
                            {{ ucfirst($product->status_produk) }}
                        </span>
                        <div class="space-x-2">                            <a href="{{ route('admin.produk.show', $product->id) }}" 
                               class="text-blue-500 hover:text-blue-700">
                                Detail
                            </a>
                            <a href="{{ route('admin.produk.edit', $product->id) }}" 
                               class="text-yellow-500 hover:text-yellow-700">
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $product->id }})" 
                                    class="text-red-500 hover:text-red-700">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8 bg-white rounded-lg">
                <p class="text-gray-500">Tidak ada produk yang ditemukan</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
        <p>Apakah Anda yakin ingin menghapus produk ini?</p>
        <div class="mt-4 flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Batal
            </button>            <form id="deleteForm" method="POST" action="" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Hapus
                </button>            </form>
        </div>
    </div>
</div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
function confirmDelete(productId) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    form.action = `/admin/produk/${productId}`;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}
</script>
@endpush
