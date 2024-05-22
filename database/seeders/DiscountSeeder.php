<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts = [
            [
                'seller_id' => 1,
                'discount' => 20,
                'max_discount' => 30,
                'dateE' => '2024-05-24',
            ],
            [
                'seller_id' => 1,
                'discount' => 25,
                'max_discount' => 35,
                'dateE' => '2024-05-25',
            ],
            [
                'seller_id' => 2,
                'discount' => 20,
                'max_discount' => 30,
                'dateE' => '2024-05-25',
            ],
            [
                'seller_id' => 2,
                'discount' => 25,
                'max_discount' => 35,
                'dateE' => '2024-05-26',
            ],
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }
}
