<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Contracts\Roles;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(Roles::collection)
            ->each(fn (string $role) => Role::create(['name' => $role]));
    }
}
