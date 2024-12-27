<?php

namespace Database\Seeders;

use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Basmati Supreme 5Kg", "pprice" => 2000, "price" => 2500, 'discount' => 200, 'catID' => 1],
            ['name' => "Saila 10kg", "pprice" => 2800, "price" => 3500, 'discount' => 150, 'catID' => 1],

        ];
        products::insert($data);
    }
}
