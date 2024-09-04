<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brands;
use App\Models\AboutUs;
use App\Models\StoreLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'role' => 'A',
            'password' => bcrypt('admin098'),
            'status' => 'A'
        ]);

        DB::table('about_us')->insert([
            'description' => 'We are a company dedicated to providing the best services in our industry.',
            'contact_person' => 'John Doe',
            'phone_number' => '876543219',
            'email' => 'contact@company.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
