<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Layanan' => 'App\Policies\LayananPolicy',
        'App\Models\Users' => 'App\Policies\StaffPolicy',
        'App\Models\StatusUser' => 'App\Policies\StatusStaffPolicy',
        'App\Models\Pesanan' => 'App\Policies\PesananPolicy',
        'App\Models\Users' => 'App\Policies\PasienAdminPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
