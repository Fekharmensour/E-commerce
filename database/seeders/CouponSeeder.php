<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [
            [
                'brand_id' => 1,
                'coupon' => 'HAIL40',
                'percentage' => 40,
                'dateE' => '2024-05-24',
            ],
            [
                'brand_id' => 2,
                'coupon' => 'DARI47',
                'percentage' => 47,
                'dateE' => '2024-05-24',
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
