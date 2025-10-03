<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Receita;
use App\Policies\ReceitaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Receita::class => ReceitaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
