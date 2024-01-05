<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserObserver
{
    public function __construct(private Role $role)
    {
    }

    public function created(User $user): void
    {
        if($this->role->query()->whereName('user')->exists()) {
            $user->assignRole('user');
        }
    }

}
