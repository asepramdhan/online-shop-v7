<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::create([
        //     'name' => 'Ramdan',
        //     'email' => 'ramdan@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);
        // User::create([
        //     'name' => 'Doni',
        //     'email' => 'doni@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);
        User::factory(5)->create();
        Category::create([
            'name' => 'Mainan Anak',
            'slug' => 'mainan-anak',
        ]);
        Category::create([
            'name' => 'Peralatan Komputer',
            'slug' => 'peralatan-komputer',
        ]);
        Category::create([
            'name' => 'Peralatan Ruang Keluarga',
            'slug' => 'peralatan-ruang-keluarga',
        ]);
        Product::factory(20)->create();
    }
}
