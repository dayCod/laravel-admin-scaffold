<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Contracts\Roles;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);

        $user->assignRole(Roles::ADMIN);
    }
}
