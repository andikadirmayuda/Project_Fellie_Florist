<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Kategori') }}
            </h2>
            <a href="{{ route('admin.kategori.index') }}" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.kategori.store') }}" method="POST">
                        @csrf                        <!-- Kode Kategori -->
                        <div class="mb-4">
                            <x-input-label for="kode_kategori" :value="__('Kode Kategori')" />
                            <x-text-input id="kode_kategori" 
                                        class="block mt-1 w-full" 
                                        type="text" 
                                        name="kode_kategori" 
                                        :value="old('kode_kategori')" 
                                        required 
                                        autofocus />
                            <x-input-error :messages="$errors->get('kode_kategori')" class="mt-2" />
                        </div>

                        <!-- Nama Kategori -->
                        <div class="mb-4">
                            <x-input-label for="nama_kategori" :value="__('Nama Kategori')" />
                            <x-text-input id="nama_kategori" 
                                        class="block mt-1 w-full" 
                                        type="text" 
                                        name="nama_kategori" 
                                        :value="old('nama_kategori')" 
                                        required />
                            <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
