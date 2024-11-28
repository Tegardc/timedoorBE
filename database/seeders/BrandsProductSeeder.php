<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brands::factory()->count(3)->create();

        foreach ($brands as $brand) {
            Products::factory()->count(5)->create(['brands_id' => $brand->id,]);
        }
    }
}
