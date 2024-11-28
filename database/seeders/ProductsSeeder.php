<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $data = [
            [
                'name' => 'Ropang Keju',
                'price' => 100,
                'quantity' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ropang Coklat',
                'price' => 90,
                'quantity' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ropang Matcha',
                'price' => 95,
                'quantity' => 15,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        foreach ($data as $product) {
            Products::insert($product);
        }
        //
    }
}
