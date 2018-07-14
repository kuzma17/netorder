<?php

namespace App\Providers;

use App\Cartridge;
use App\City;
use App\Client;
use App\Contractor;
use App\Firm;
use App\Order;
use App\Policies\CartridgePolicy;
use App\Policies\CityPolicy;
use App\Policies\ClientPolicy;
use App\Policies\ContractorPolicy;
use App\Policies\FirmPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PrinterPolicy;
use App\Policies\SettingPolisy;
use App\Policies\UserPolicy;
use App\Printer;
use App\Setting;
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
        Printer::class => PrinterPolicy::class,
        Cartridge::class => CartridgePolicy::class,
        City::class => CityPolicy::class,
        Setting::class => SettingPolisy::class
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
