<?php

namespace App\Providers;

use App\Client;
use App\Contractor;
use App\Firm;
use App\Order;
use App\Policies\ClientPolicy;
use App\Policies\ContractorPolicy;
use App\Policies\FirmPolicy;
use App\Policies\OrderPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Firm::class => FirmPolicy::class,
        Client::class => ClientPolicy::class,
        Contractor::class => ContractorPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
