<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@relevant.ru',
            'password' => '$2y$10$btiAcYJzwWkWKOdIDLT3k.lGMDbrDbqEXmW07GlF9jKgQf6YxDs/O', //relevant
        ]);
        $roles = Role::create([
            'name' => 'Админ',
            'slug' => 'admin'
        ]);
        $user->roles()->sync($roles);
    }
}
