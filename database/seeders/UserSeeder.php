<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => 'user',
        ])
            ->syncRoles('user');

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ])
            ->syncRoles('admin');
    }
}
