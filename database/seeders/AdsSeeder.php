<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ads;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            [
                'text' => 'Special Offer! Get 20% off on all products. Hurry, limited time only!',
                'image' => 'ads/ad1.jpg',
            ],
            [
                'text' => 'New Arrivals! Check out our latest collection.',
                'image' => 'ads/ad2.jpg',
            ],
            [
                'text' => 'Sale Alert! Enjoy huge discounts on selected items.',
                'image' => 'ads/ad3.png',
            ],
            [
                'text' => 'Big Savings! Shop now and save big on your favorite brands.',
                'image' => 'ads/ad4.jpeg',
            ],
            [
                'text' => 'Flash Sale! Grab your favorites before they sell out.',
                'image' => 'ads/ad5.png',
            ],
        ];

        foreach ($ads as $ad) {
            Ads::create($ad);
        }
    }
}
