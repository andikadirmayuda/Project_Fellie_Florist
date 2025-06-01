<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Daftar Variasi Produk</h2>
                        <a href="{{ route('variasi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Variasi
                        </a>
                    </div>

                    <!-- Filter Form -->
                    <div class="mb-6 bg-white p-4 rounded-lg shadow">
                        <form action="{{ route('variasi.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search by product name -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Cari Nama Produk</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Masukkan nama produk...">
                            </div>

                            <!-- Filter by category -->
                            <div>
                                <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter by variation type -->
                            <div>
                                <label for="tipe_variasi" class="block text-sm font-medium text-gray-700">Tipe Variasi</label>
                                <select name="tipe_variasi" id="tipe_variasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Tipe</option>
                                    @foreach($tipeVariasi as $tipe)
                                        <option value="{{ $tipe }}" {{ request('tipe_variasi') == $tipe ? 'selected' : '' }}>
                                            {{ ucfirst($tipe) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter buttons -->
                            <div class="flex items-end space-x-2">
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Filter
                                </button>
                                <a href="{{ route('variasi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Grouped Products -->
                    <div class="space-y-6">
                        @php
                            $groupedVariasi = $variasiProduk->groupBy('id_produk');
                        @endphp

                        @foreach($groupedVariasi as $productId => $variations)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <!-- Product Header -->
                                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $variations->first()->produk->nama_produk }}
                                        <span class="text-sm text-gray-500 ml-2">({{ $variations->count() }} variasi)</span>
                                    </h3>
                                </div>

                                <!-- Variations Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe Variasi</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($variations->sortBy('tipe_variasi') as $index => $variasi)
                                                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($variasi->tipe_variasi) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($variasi->harga, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $variasi->stok }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('variasi.edit', $variasi->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">
                                                                Edit
                                                            </a>
                                                            <button onclick="confirmDelete({{ $variasi->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                                Hapus
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
            <p class="mb-4">Apakah Anda yakin ingin menghapus variasi produk ini?</p>
            <div class="flex justify-end space-x-2">
                <button onclick="closeDeleteModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/variasi/${id}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
