<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = ['pakaian', 'fashion', 'celana', 'baju', 'sepatu', 'kacamata'];
        foreach($categories as $category) {
            ProductCategory::factory()->has(Product::factory(5), 'products')->create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }

        // Product::factory()->count(3)->has(ProductCategory::query()->inRandomOrder()->first())->create();
    }
}
