<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            return in_array($user->role, ['manager', 'admin']);
        });

        Gate::define('kasir', function ($user) {
            return $user->role === 'kasir';
        });

        Gate::define('karyawan', function ($user) {
            return $user->role === 'karyawan';
        });

        Gate::define('pelanggan', function ($user) {
            return $user->role === 'pelanggan';
        });
    }
}
