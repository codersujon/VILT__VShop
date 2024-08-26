<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Velit est cillum sunt eiusmod culpa nostrud commodo nisi aliqua in.',
            'quantity' => 3,
            'price' => 19.03,
            'description' => 'Reprehenderit enim aliquip magna consequat qui Lorem cupidatat consectetur minim ullamco. Occaecat nisi non deserunt ipsum duis velit duis mollit id pariatur sint cupidatat consectetur nulla. Nulla non qui veniam do do pariatur. Irure voluptate eu do cupidatat excepteur non ullamco amet.',
            'category_id' => 1,
            'brand_id' => 1,
        ]);
    }
}
