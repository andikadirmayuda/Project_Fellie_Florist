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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Filter Section -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('admin.produk.index') }}" class="flex flex-wrap gap-4 items-end">
                            <div class="flex-1 min-w-[200px]">
                                <x-input-label for="kategori" :value="__('Filter Kategori')" />
                                <select id="kategori" name="kategori" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1 min-w-[200px]">
                                <x-input-label for="search" :value="__('Cari Produk')" />
                                <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" 
                                    :value="request('search')" placeholder="Cari nama atau kode produk..." />
                            </div>
                            <div class="flex gap-2">
                                <x-primary-button>
                                    <i class="fas fa-search mr-2"></i>
                                    {{ __('Filter') }}
                                </x-primary-button>
                                @if(request('kategori') || request('search'))
                                    <a href="{{ route('admin.produk.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Reset') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($products as $product)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm overflow-hidden">
                                <div class="aspect-w-16 aspect-h-9">
                                    @if($product->gambar)
                                        <img src="{{ asset('storage/' . $product->gambar) }}" 
                                             alt="{{ $product->nama_produk }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                            <i class="fas fa-image text-4xl text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2 dark:text-white">{{ $product->nama_produk }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ $product->kode_produk }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ $product->kategori->nama_kategori }}
                                    </p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium {{ $product->status_produk ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            <i class="fas fa-circle text-xs mr-1"></i>
                                            {{ $product->status_produk ? 'Aktif' : 'Non-aktif' }}
                                        </span>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.produk.show', $product) }}" 
                                               class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.produk.edit', $product) }}"
                                               class="px-2 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.produk.destroy', $product) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                                    <i class="fas fa-box text-3xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                    {{ __('Tidak ada produk') }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ request('search') || request('kategori') 
                                        ? __('Tidak ada produk yang sesuai dengan filter yang dipilih.') 
                                        : __('Belum ada produk yang ditambahkan.') }}
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
