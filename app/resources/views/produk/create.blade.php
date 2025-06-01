<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Produk Baru') }}
            </h2>
            <a href="{{ route('admin.produk.index') }}" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">
                <i class="fas fa-arrow-left mr-2"></i>{{ __('Kembali ke Daftar') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    <!-- Kategori -->
                    <div>
                        <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Produk -->
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" 
                               value="{{ old('nama_produk') }}"
                               class="mt-1 block w-full rounded-md border-gray-300" 
                               required>
                        @error('nama_produk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Produk -->
                    <div>
                        <label for="kode_produk" class="block text-sm font-medium text-gray-700">Kode Produk</label>
                        <input type="text" name="kode_produk" id="kode_produk" 
                               value="{{ old('kode_produk') }}"
                               class="mt-1 block w-full rounded-md border-gray-300" 
                               required>
                        @error('kode_produk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Gambar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                        <div class="mt-1 flex items-center">
                            <div id="preview" class="hidden w-32 h-32 rounded-lg overflow-hidden bg-gray-100">
                                <img id="preview-image" class="w-full h-full object-cover">
                            </div>
                            <input type="file" name="gambar" id="gambar" 
                                   accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100">
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status_produk" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status_produk" id="status_produk" class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="aktif" {{ old('status_produk') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status_produk') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_produk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="window.history.back()" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Simpan Produk
                        </button>                    </div>
                </div>
            </form>
        </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
document.getElementById('gambar').onchange = function(evt) {
    const [file] = this.files;
    if (file) {
        const preview = document.getElementById('preview');
        const previewImage = document.getElementById('preview-image');
        preview.classList.remove('hidden');
        previewImage.src = URL.createObjectURL(file);
    }
}
</script>
@endpush
