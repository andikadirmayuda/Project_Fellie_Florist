<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 bg-white dark:bg-gray-800 w-64 border-r border-gray-100 dark:border-gray-700 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-20">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="h-16 flex items-center justify-center border-b border-gray-100 dark:border-gray-700">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 dark:text-white">
                Fellie Florist
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="px-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>                @if(auth()->user()->role === 'manager' || auth()->user()->role === 'admin')
                    <!-- Kategori -->
                    <a href="{{ route('admin.kategori.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.kategori.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-tags w-5 h-5 mr-3"></i>
                        <span>Kategori</span>
                    </a>

                    <!-- Produk -->
                    <a href="{{ route('admin.produk.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.produk.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>Produk</span>
                    </a>

                    <!-- Variasi -->
                    <a href="{{ route('admin.variasi.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.variasi.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-boxes w-5 h-5 mr-3"></i>
                        <span>Variasi</span>
                    </a>

                    <!-- Inventaris -->
                    <a href="{{ route('admin.inventaris.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.inventaris.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-warehouse w-5 h-5 mr-3"></i>
                        <span>Inventaris</span>
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span>Users</span>
                    </a>
                @endif

                @if(auth()->user()->role === 'kasir')
                    <!-- Produk for Kasir -->
                    <a href="{{ route('kasir.produk.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('kasir.produk.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>Produk</span>
                    </a>

                    <!-- Inventaris for Kasir -->
                    <a href="{{ route('kasir.inventaris.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('kasir.inventaris.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-warehouse w-5 h-5 mr-3"></i>
                        <span>Inventaris</span>
                    </a>
                @endif

                @if(auth()->user()->role === 'karyawan')
                    <!-- Produk for Karyawan -->
                    <a href="{{ route('karyawan.produk.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('karyawan.produk.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>Produk</span>
                    </a>

                    <!-- Inventaris for Karyawan -->
                    <a href="{{ route('karyawan.inventaris.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('karyawan.inventaris.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-warehouse w-5 h-5 mr-3"></i>
                        <span>Inventaris</span>
                    </a>
                @endif

                @if(auth()->user()->role === 'pelanggan')
                    <!-- Produk for Pelanggan -->
                    <a href="{{ route('pelanggan.produk.index') }}" 
                       class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg {{ request()->routeIs('pelanggan.produk.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>Produk</span>
                    </a>
                @endif
            </div>
        </nav>

        <!-- User Profile -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" alt="{{ auth()->user()->name }}">
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile sidebar trigger -->
<div class="fixed inset-0 flex items-center justify-center z-10 lg:hidden" x-show="sidebarOpen" style="display: none;">
    <div class="absolute inset-0 bg-gray-600 opacity-75" @click="sidebarOpen = false"></div>
</div>

<!-- Mobile menu button -->
<div class="lg:hidden fixed bottom-4 right-4 z-20">
    <button @click="sidebarOpen = !sidebarOpen" class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-600 text-white focus:outline-none">
        <svg class="w-6 h-6" x-show="!sidebarOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg class="w-6 h-6" x-show="sidebarOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
