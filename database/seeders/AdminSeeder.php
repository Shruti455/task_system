<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert test data for Admins
        Admin::create([
            'name' => 'Admin One',
            'email' => 'admin@admin.com',
            'password' => Hash::make('user@123'),
        ]);

        Admin::create([
            'name' => 'Admin Two',
            'email' => 'admin@example.com',
            'password' => Hash::make('password@123'),
        ]);
    }
}
