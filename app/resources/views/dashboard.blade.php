<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->role === 'manager' || auth()->user()->role === 'admin')
                <!-- Admin/Manager Dashboard -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Overview</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Total Products Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                                        <i class="fas fa-box text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Produk::count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Categories Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-green-500 bg-opacity-10">
                                        <i class="fas fa-tags text-green-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Categories</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Kategori::count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Users Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-purple-500 bg-opacity-10">
                                        <i class="fas fa-users text-purple-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Users</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\User::count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory Items Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-yellow-500 bg-opacity-10">
                                        <i class="fas fa-warehouse text-yellow-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Inventory Items</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Inventaris::count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <a href="{{ route('admin.produk.create') }}" class="flex items-center p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add New Product
                                </a>
                                <a href="{{ route('admin.kategori.create') }}" class="flex items-center p-4 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                    <i class="fas fa-folder-plus mr-2"></i>
                                    Add Category
                                </a>
                                <a href="{{ route('admin.users.create') }}" class="flex items-center p-4 bg-purple-500 text-white rounded-lg hover:bg-purple-600">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Add User
                                </a>
                                <a href="{{ route('admin.inventaris.create') }}" class="flex items-center p-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                    <i class="fas fa-boxes mr-2"></i>
                                    Add Inventory
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(auth()->user()->role === 'kasir')
                <!-- Kasir Dashboard -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Kasir Dashboard</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Products Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                                        <i class="fas fa-box text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Available Products</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Produk::count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-yellow-500 bg-opacity-10">
                                        <i class="fas fa-warehouse text-yellow-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Inventory Items</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Inventaris::count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('kasir.produk.index') }}" class="flex items-center p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i class="fas fa-search mr-2"></i>
                                    View Products
                                </a>
                                <a href="{{ route('kasir.inventaris.index') }}" class="flex items-center p-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                    <i class="fas fa-boxes mr-2"></i>
                                    Check Inventory
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(auth()->user()->role === 'karyawan')
                <!-- Karyawan Dashboard -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Karyawan Dashboard</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Products Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                                        <i class="fas fa-box text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Products to Manage</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Produk::count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-yellow-500 bg-opacity-10">
                                        <i class="fas fa-warehouse text-yellow-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Inventory Items</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Inventaris::count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('karyawan.produk.index') }}" class="flex items-center p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i class="fas fa-list mr-2"></i>
                                    View Product List
                                </a>
                                <a href="{{ route('karyawan.inventaris.index') }}" class="flex items-center p-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                    <i class="fas fa-clipboard-list mr-2"></i>
                                    Check Inventory
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <!-- Pelanggan Dashboard -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Welcome to Fellie Florist</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Products Card -->
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                                        <i class="fas fa-flower text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Available Products</h4>
                                        <p class="text-lg font-semibold">{{ \App\Models\Produk::count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('pelanggan.produk.index') }}" class="flex items-center p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Browse Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
