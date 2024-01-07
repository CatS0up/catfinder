<?php

declare(strict_types=1);

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\DataObjects\CatData;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-cat', function (User $user, Cat|CatData $catData) {
            if ($user->hasRole('admin')) {
                return true;
            }

            return (bool) ($user->id === $catData->adding_user_id);
        });

        Gate::define('delete-cat', function (User $user, Cat|CatData $catData) {
            if ($user->hasRole('admin')) {
                return true;
            }

            return (bool) ($user->id === $catData->adding_user_id);
        });

        Gate::define('choose-cat-for-adoption', fn (User $user) => $user->hasRole('user'));

        Gate::define('approve-cat-adoption', fn (User $user) => $user->hasRole('admin'));
    }
}
