<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellers = [
            [
                'buyer_id' => 1,
                'commercialRecord' => 'commercialRecord/commercial.pdf',
                'brand_id' => 1,
                'is_owner' => true,
                'status' => true,
            ],
            [
                'buyer_id' => 2,
                'commercialRecord' => 'commercialRecord/commercial.pdf',
                'brand_id' => 2,
                'is_owner' => true,
                'status' => true,
            ],
            [
                'buyer_id' => 3,
                'commercialRecord' => 'commercialRecord/commercial.pdf',
                'brand_id' => 3,
                'is_owner' => true,
                'status' => false,
            ],
            [
                'buyer_id' => 4,
                'commercialRecord' => 'commercialRecord/commercial.pdf',
                'brand_id' => 4,
                'is_owner' => true,
                'status' => false,
            ],
            [
                'buyer_id' => 5,
                'commercialRecord' => 'commercialRecord/commercial.pdf',
                'brand_id' => 5,
                'is_owner' => true,
                'status' => false,
            ],
        ];

        foreach ($sellers as $seller) {
            Seller::create($seller);
        }
    }
}
