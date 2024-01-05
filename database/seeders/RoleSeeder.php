<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public static function dataTable(): array
    {
        return [
            ['name' => 'user'],
            ['name' => 'admin'],
        ];
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = self::dataTable();

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
