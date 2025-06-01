<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Produk') }}
            </h2>
            <div class="space-x-3">
                <a href="{{ route('admin.produk.index') }}" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">
                    <i class="fas fa-arrow-left mr-2"></i>{{ __('Kembali ke Daftar') }}
                </a>
                <a href="{{ route('admin.produk.edit', $produk->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-600 dark:bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 dark:hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-edit mr-2"></i>{{ __('Edit Produk') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="md:flex">
                <!-- Gambar Produk -->
                <div class="md:w-1/3">
                    @if($produk->gambar)
                        <img src="{{ Storage::url($produk->gambar) }}" 
                             alt="{{ $produk->nama_produk }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full min-h-[300px] bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                </div>

                <!-- Informasi Produk -->
                <div class="md:w-2/3 p-6">
                    <div class="space-y-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $produk->nama_produk }}</h2>
                            <p class="text-sm text-gray-500">Kode: {{ $produk->kode_produk }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Kategori</h3>
                            <p class="mt-1">{{ $produk->kategori->nama_kategori }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Status</h3>
                            <span class="inline-block mt-1 px-3 py-1 text-sm {{ $produk->status_produk === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full">
                                {{ ucfirst($produk->status_produk) }}
                            </span>
                        </div>

                        @if($produk->deskripsi)
                            <div>
                                <h3 class="text-sm font-medium text-gray-700">Deskripsi</h3>
                                <p class="mt-1 text-gray-600">{{ $produk->deskripsi }}</p>
                            </div>
                        @endif

                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Informasi Tambahan</h3>
                            <dl class="mt-2 divide-y divide-gray-200">
                                <div class="py-2 flex justify-between">
                                    <dt class="text-sm text-gray-500">Tanggal Dibuat</dt>
                                    <dd class="text-sm text-gray-900">{{ $produk->tanggal_dibuat }}</dd>
                                </div>
                                <div class="py-2 flex justify-between">
                                    <dt class="text-sm text-gray-500">Dibuat Oleh</dt>
                                    <dd class="text-sm text-gray-900">{{ $produk->dibuat_oleh ?? 'System' }}</dd>
                                </div>
                                <div class="py-2 flex justify-between">
                                    <dt class="text-sm text-gray-500">Terakhir Diupdate</dt>
                                    <dd class="text-sm text-gray-900">{{ $produk->updated_at }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Variasi Produk -->
                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-700">Variasi Produk</h3>                            <a href="{{ route('admin.variasi.create', ['produk_id' => $produk->id]) }}" 
                               class="text-sm text-blue-500 hover:text-blue-700">
                                Tambah Variasi
                            </a>
                        </div>
                        @if($produk->variasi->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                            <th class="px-4 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase">Harga</th>
                                            <th class="px-4 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase">Stok</th>
                                            <th class="px-4 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($produk->variasi as $variasi)
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-900">
                                                    {{ $variasi->tipe_variasi }}
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-900 text-right">
                                                    Rp {{ number_format($variasi->harga, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-900 text-right">
                                                    {{ $variasi->stok }}
                                                </td>
                                                <td class="px-4 py-3 text-right">                                                    <a href="{{ route('admin.variasi.edit', $variasi->id) }}" 
                                                       class="text-blue-500 hover:text-blue-700">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Belum ada variasi produk</p>
                        @endif
                    </div>                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
