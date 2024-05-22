<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Kids',
                'logo' => 'category/kids.png',
            ],
            [
                'name' => 'Sports',
                'logo' => 'category/sport.png',
            ],
            [
                'name' => 'Women\'s',
                'logo' => 'category/womens.png',
            ],
            [
                'name' => 'Electronics',
                'logo' => 'category/electronic.png',
            ],
            [
                'name' => 'Kitchenware',
                'logo' => 'category/Kitchenware.png',
            ],
            [
                'name' => 'Clothing',
                'logo' => 'category/other.png',
            ],
            [
                'name' => 'Phones',
                'logo' => 'category/phone.png',
            ],
            [
                'name' => 'Laptops',
                'logo' => 'category/laptop.png',
            ],
            [
                'name' => 'Shoes',
                'logo' => 'category/shoes.png',
            ],
            [
                'name' => 'Other_Products',
                'logo' => 'category/Clothing.png',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
