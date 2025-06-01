<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">Tambah Variasi Produk</h2>
                    </div>

                    <form action="{{ route('variasi.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="id_produk" class="block text-sm font-medium text-gray-700">Produk</label>
                            <select name="id_produk" id="id_produk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Produk</option>
                                @foreach($produk as $p)
                                    <option value="{{ $p->id }}" {{ old('id_produk') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_produk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>                        <div>
                            <label for="tipe_variasi" class="block text-sm font-medium text-gray-700">Tipe Variasi</label>
                            <select name="tipe_variasi" id="tipe_variasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Tipe Variasi</option>
                                <option value="pertangkai" {{ old('tipe_variasi') == 'pertangkai' ? 'selected' : '' }}>Pertangkai</option>
                                <option value="perikat(5)" {{ old('tipe_variasi') == 'perikat(5)' ? 'selected' : '' }}>Perikat (5)</option>
                                <option value="perikat(10)" {{ old('tipe_variasi') == 'perikat(10)' ? 'selected' : '' }}>Perikat (10)</option>
                                <option value="perikat(20)" {{ old('tipe_variasi') == 'perikat(20)' ? 'selected' : '' }}>Perikat (20)</option>
                                <option value="normal" {{ old('tipe_variasi') == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="reseller" {{ old('tipe_variasi') == 'reseller' ? 'selected' : '' }}>Reseller</option>
                                <option value="promo" {{ old('tipe_variasi') == 'promo' ? 'selected' : '' }}>Promo</option>
                            </select>
                            @error('tipe_variasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="harga" id="harga" value="{{ old('harga') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('harga')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('stok')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('variasi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
