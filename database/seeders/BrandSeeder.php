<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name' => 'ebay',
                'background_image' => 'brand_backgrounds/ebay.jpg',
                'status' => true,
                'logo' => 'brand_logos/ebay.png',
            ],
            [
                'name' => 'Lenovo',
                'background_image' => 'brand_backgrounds/lenovo.jpg',
                'status' => true,
                'logo' => 'brand_logos/lenovo.png',
            ],
            [
                'name' => 'Samsung',
                'background_image' => 'brand_backgrounds/samsung.jpg',
                'status' => true,
                'logo' => 'brand_logos/samsung.png',
            ],
            [
                'name' => 'amazon',
                'background_image' => 'brand_backgrounds/amazon.jpg',
                'status' => true,
                'logo' => 'brand_logos/amazon.png',
            ],
            [
                'name' => 'CR7',
                'background_image' => 'brand_backgrounds/cr7.jpg',
                'status' => false,
                'logo' => 'brand_logos/cr7.jpg',
            ],
            // Add other brands here
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
