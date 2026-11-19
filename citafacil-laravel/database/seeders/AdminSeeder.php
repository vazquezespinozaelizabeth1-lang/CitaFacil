<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => config('citafacil.admin_email')]);
        $admin->name = 'Administrador';
        $admin->password = config('citafacil.admin_password');
        $admin->role = User::ROL_ADMIN;
        $admin->save();
    }
}
