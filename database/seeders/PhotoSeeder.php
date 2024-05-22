<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = [
            //product 1
            [
                'product_id' => 1,
                'photo' => "product_photos/Electronic/P6-I1.jpg",
            ],
            [
                'product_id' => 1,
                'photo' => "product_photos/Electronic/P6-I2.jpg",
            ],
            [
                'product_id' => 1,
                'photo' => "product_photos/Electronic/P6-I3.jpg",
            ],
            [
                'product_id' => 1,
                'photo' => "product_photos/Electronic/P6-I4.jpg",
            ],
            [
                'product_id' => 1,
                'photo' => "product_photos/Electronic/P6-I5.jpg",
            ],[
                'product_id' => 1,
                'photo' => "product_photos/Electronic/P6-I6.jpg",
            ],
            // product 2
            [
                'product_id' => 2,
                'photo' => "product_photos/Electronic/P7-I1.jpg",
            ],
            [
                'product_id' => 2,
                'photo' => "product_photos/Electronic/P7-I2.jpg",
            ],
            [
                'product_id' => 2,
                'photo' => "product_photos/Electronic/P7-I3.jpg",
            ],
            [
                'product_id' => 2,
                'photo' => "product_photos/Electronic/P7-I4.jpg",
            ],
            [
                'product_id' => 2,
                'photo' => "product_photos/Electronic/P7-I5.jpg",
            ],
            [
                'product_id' => 2,
                'photo' => "product_photos/Electronic/P7-I6.jpg",
            ],
            /// product 3
            [
                'product_id' => 3,
                'photo' => "product_photos/Electronic/P8-I1.jpg",
            ],
            [
                'product_id' => 3,
                'photo' => "product_photos/Electronic/P8-I2.png",
            ],
            [
                'product_id' => 3,
                'photo' => "product_photos/Electronic/P8-I3.png",
            ],
            [
                'product_id' => 3,
                'photo' => "product_photos/Electronic/P8-I4.jpg",
            ],
            [
                'product_id' => 3,
                'photo' => "product_photos/Electronic/P8-I5.jpg",
            ],
            // product 4
            [
                'product_id' => 4,
                'photo' => "product_photos/Phones/P9-I1.jpg",
            ],
            [
                'product_id' => 4,
                'photo' => "product_photos/Phones/P9-I2.png",
            ],
            [
                'product_id' => 4,
                'photo' => "product_photos/Phones/P9-I3.png",
            ],
            [
                'product_id' => 4,
                'photo' => "product_photos/Phones/P9-I4.png",
            ],
            [
                'product_id' => 4,
                'photo' => "product_photos/Phones/P9-I5.png",
            ],
            [
                'product_id' => 4,
                'photo' => "product_photos/Phones/P9-I6.png",
            ],
            // product 5
            [
                'product_id' => 5,
                'photo' => "product_photos/Electronic/P11-I1.jpg",
            ],
            [
                'product_id' => 5,
                'photo' => "product_photos/Electronic/P11-I2.jpg",
            ],
            [
                'product_id' => 5,
                'photo' => "product_photos/Electronic/P11-I3.jpg",
            ],
            [
                'product_id' => 5,
                'photo' => "product_photos/Electronic/P11-I4.jpg",
            ],
            [
                'product_id' => 5,
                'photo' => "product_photos/Electronic/P11-I5.jpg",
            ],
            // product 6
            [
                'product_id' => 6,
                'photo' => "product_photos/Other_Product/P12-I1.png",
            ],
            [
                'product_id' => 6,
                'photo' => "product_photos/Other_Product/P12-I2.png",
            ],
            [
                'product_id' => 6,
                'photo' => "product_photos/Other_Product/P12-I3.png",
            ],
            [
                'product_id' => 6,
                'photo' => "product_photos/Other_Product/P12-I4.png",
            ],
            [
                'product_id' => 6,
                'photo' => "product_photos/Other_Product/P12-I5.png",
            ],
            //product 7
            [
                'product_id' => 7,
                'photo' => "product_photos/Other_Product/P13-I1.jpg",
            ],
            [
                'product_id' => 7,
                'photo' => "product_photos/Other_Product/P13-I2.jpg",
            ],
            [
                'product_id' => 7,
                'photo' => "product_photos/Other_Product/P13-I3.jpg",
            ],
            [
                'product_id' => 7,
                'photo' => "product_photos/Other_Product/P13-I4.jpg",
            ],
            [
                'product_id' => 7,
                'photo' => "product_photos/Other_Product/P13-I5.jpg",
            ],
            // product 8
            [
                'product_id' => 8,
                'photo' => "product_photos/Laptops/P14-I1.jpg",
            ],
            [
                'product_id' => 8,
                'photo' => "product_photos/Laptops/P14-I2.jpg",
            ],
            [
                'product_id' => 8,
                'photo' => "product_photos/Laptops/P14-I3.jpg",
            ],
            [
                'product_id' => 8,
                'photo' => "product_photos/Laptops/P14-I4.jpg",
            ],
            // product 9
            [
                'product_id' => 9,
                'photo' => "product_photos/Electronic/P15-I1.jpg",
            ],
            [
                'product_id' => 9,
                'photo' => "product_photos/Electronic/P15-I2.jpg",
            ],
            [
                'product_id' => 9,
                'photo' => "product_photos/Electronic/P15-I3.jpg",
            ],
            [
                'product_id' => 9,
                'photo' => "product_photos/Electronic/P15-I4.jpg",
            ],
            [
                'product_id' => 9,
                'photo' => "product_photos/Electronic/P15-I5.jpg",
            ],
            // product 10
            [
                'product_id' => 10,
                'photo' => "product_photos/Electronic/P16-I1.jpg",
            ],
            [
                'product_id' => 10,
                'photo' => "product_photos/Electronic/P16-I2.jpg",
            ],
            [
                'product_id' => 10,
                'photo' => "product_photos/Electronic/P16-I3.jpg",
            ],
            [
                'product_id' => 10,
                'photo' => "product_photos/Electronic/P16-I4.jpg",
            ],
            // product 11
            [
                'product_id' => 11,
                'photo' => "product_photos/Electronic/P17-I1.jpg",
            ],
            [
                'product_id' => 11,
                'photo' => "product_photos/Electronic/P17-I2.jpg",
            ],
            [
                'product_id' => 11,
                'photo' => "product_photos/Electronic/P17-I3.jpg",
            ],
            [
                'product_id' => 11,
                'photo' => "product_photos/Electronic/P17-I4.jpg",
            ],
            [
                'product_id' => 11,
                'photo' => "product_photos/Electronic/P17-I5.jpg",
            ],
            // product 12
            [
                'product_id' => 12,
                'photo' => "product_photos/Clothing/P18-I1.jpg",
            ],
            [
                'product_id' => 12,
                'photo' => "product_photos/Clothing/P18-I2.jpg",
            ],
            [
                'product_id' => 12,
                'photo' => "product_photos/Clothing/P18-I3.png",
            ],
            [
                'product_id' => 12,
                'photo' => "product_photos/Clothing/P18-I4.png",
            ],
            [
                'product_id' => 12,
                'photo' => "product_photos/Clothing/P18-I1.jpg",
            ],
            // porduct 13
            [
                'product_id' => 13,
                'photo' => "product_photos/Women's/P19-I1.jpg",
            ],
            [
                'product_id' => 13,
                'photo' => "product_photos/Women's/P19-I2.jpg",
            ],
            [
                'product_id' => 13,
                'photo' => "product_photos/Women's/P19-I3.jpg",
            ],
            [
                'product_id' => 13,
                'photo' => "product_photos/Women's/P19-I4.jpg",
            ],
            // product 14
            [
                'product_id' => 14,
                'photo' => "product_photos/Women's/P20-I1.jpg",
            ],
            [
                'product_id' => 14,
                'photo' => "product_photos/Women's/P20-I2.jpg",
            ],
            [
                'product_id' => 14,
                'photo' => "product_photos/Women's/P20-I3.jpg",
            ],
            [
                'product_id' => 14,
                'photo' => "product_photos/Women's/P20-I4.jpg",
            ],
            [
                'product_id' => 14,
                'photo' => "product_photos/Women's/P20-I5.jpg",
            ],
            // product 15
            [
                'product_id' => 15,
                'photo' => "product_photos/Other_Product/P21-I1.jpg",
            ],
            [
                'product_id' => 15,
                'photo' => "product_photos/Other_Product/P21-I2.jpg",
            ],
            [
                'product_id' => 15,
                'photo' => "product_photos/Other_Product/P21-I3.jpg",
            ],
            [
                'product_id' => 15,
                'photo' => "product_photos/Other_Product/P21-I4.jpg",
            ],
            [
                'product_id' => 15,
                'photo' => "product_photos/Other_Product/P21-I5.jpg",
            ],
            [
                'product_id' => 15,
                'photo' => "product_photos/Other_Product/P21-I6.jpg",
            ],
//            product 16
            [
                'product_id' => 16,
                'photo' => "product_photos/Electronic/P22-I1.jpg",
            ],
            [
                'product_id' => 16,
                'photo' => "product_photos/Electronic/P22-I2.jpg",
            ],
            [
                'product_id' => 16,
                'photo' => "product_photos/Electronic/P22-I3.jpg",
            ],
            [
                'product_id' => 16,
                'photo' => "product_photos/Electronic/P22-I4.jpg",
            ],
            // product 17
            [
                'product_id' => 17,
                'photo' => "product_photos/Other_Product/P23-I1.jpg",
            ],
            [
                'product_id' => 17,
                'photo' => "product_photos/Other_Product/P23-I2.jpg",
            ],
            [
                'product_id' => 17,
                'photo' => "product_photos/Other_Product/P23-I3.jpg",
            ],
            [
                'product_id' => 17,
                'photo' => "product_photos/Other_Product/P23-I4.jpg",
            ],
            // product 18
            [
                'product_id' => 18,
                'photo' => "product_photos/Other_Product/P24-I1.jpg",
            ],
            [
                'product_id' => 18,
                'photo' => "product_photos/Other_Product/P24-I2.jpg",
            ],
            [
                'product_id' => 18,
                'photo' => "product_photos/Other_Product/P24-I3.jpg",
            ],
            [
                'product_id' => 18,
                'photo' => "product_photos/Other_Product/P24-I4.jpg",
            ],
            [
                'product_id' => 18,
                'photo' => "product_photos/Other_Product/P24-I5.jpg",
            ],
            [
                'product_id' => 18,
                'photo' => "product_photos/Other_Product/P24-I6.jpg",
            ],
            // product 19
            [
                'product_id' => 19,
                'photo' => "product_photos/Kids/P25-I1.jpg",
            ],
            [
                'product_id' => 19,
                'photo' => "product_photos/Kids/P25-I2.jpg",
            ],
            [
                'product_id' => 19,
                'photo' => "product_photos/Kids/P25-I3.jpg",
            ],
            [
                'product_id' => 19,
                'photo' => "product_photos/Kids/P25-I4.jpg",
            ],
            [
                'product_id' => 19,
                'photo' => "product_photos/Kids/P25-I5.jpg",
            ],
            [
                'product_id' => 19,
                'photo' => "product_photos/Kids/P25-I6.jpg",
            ],
            // product 20
            [
                'product_id' => 20,
                'photo' => "product_photos/Kids/P26-I1.jpg",
            ],
            [
                'product_id' => 20,
                'photo' => "product_photos/Kids/P26-I2.jpg",
            ],
            [
                'product_id' => 20,
                'photo' => "product_photos/Kids/P26-I3.jpg",
            ],
            [
                'product_id' => 20,
                'photo' => "product_photos/Kids/P26-I4.jpg",
            ],
            [
                'product_id' => 20,
                'photo' => "product_photos/Kids/P26-I5.jpg",
            ],
            // porduct 21
            [
                'product_id' => 21,
                'photo' => "product_photos/Kids/P27-I1.jpg",
            ],
            [
                'product_id' => 21,
                'photo' => "product_photos/Kids/P27-I2.jpg",
            ],
            [
                'product_id' => 21,
                'photo' => "product_photos/Kids/P27-I3.png",
            ],
            [
                'product_id' => 21,
                'photo' => "product_photos/Kids/P27-I4.jpg",
            ],
            [
                'product_id' => 21,
                'photo' => "product_photos/Kids/P27-I5.jpg",
            ],
            //product 22
            [
                'product_id' => 22,
                'photo' => "product_photos/Kids/P28-I1.jpg",
            ],
            [
                'product_id' => 22,
                'photo' => "product_photos/Kids/P28-I2.jpg",
            ],
            [
                'product_id' => 22,
                'photo' => "product_photos/Kids/P28-I3.jpg",
            ],
            [
                'product_id' => 22,
                'photo' => "product_photos/Kids/P28-I4.jpg",
            ],
            // product 23
            [
                'product_id' => 23,
                'photo' => "product_photos/Sport's/P29-I1.jpg",
            ],
            [
                'product_id' => 23,
                'photo' => "product_photos/Sport's/P29-I2.jpg",
            ],
            [
                'product_id' => 23,
                'photo' => "product_photos/Sport's/P29-I1.jpg",
            ],
            // product 24
            [
                'product_id' => 24,
                'photo' => "product_photos/Sport's/P30-I1.jpg",
            ],
            [
                'product_id' => 24,
                'photo' => "product_photos/Sport's/P30-I2.jpg",
            ],
            [
                'product_id' => 24,
                'photo' => "product_photos/Sport's/P30-I3.jpg",
            ],
            [
                'product_id' => 24,
                'photo' => "product_photos/Sport's/P30-I4.jpg",
            ],
            // product 25
            [
                'product_id' => 25,
                'photo' => "product_photos/Sport's/P31-I1.jpg",
            ],
            [
                'product_id' => 25,
                'photo' => "product_photos/Sport's/P31-I2.jpg",
            ],
            [
                'product_id' => 25,
                'photo' => "product_photos/Sport's/P31-I3.jpg",
            ],
            [
                'product_id' => 25,
                'photo' => "product_photos/Sport's/P31-I4.jpg",
            ],
            // product 26
            [
                'product_id' => 26,
                'photo' => "product_photos/Other_Product/P32-I1.jpg",
            ],
            [
                'product_id' => 26,
                'photo' => "product_photos/Other_Product/P32-I2.jpg",
            ],
            [
                'product_id' => 26,
                'photo' => "product_photos/Other_Product/P32-I3.jpg",
            ],
            [
                'product_id' => 26,
                'photo' => "product_photos/Other_Product/P32-I4.jpg",
            ],
            [
                'product_id' => 26,
                'photo' => "product_photos/Other_Product/P32-I5.jpg",
            ],
            // product 27
            [
                'product_id' => 27,
                'photo' => "product_photos/Electronic/P33-I1.jpg",
            ],
            [
                'product_id' => 27,
                'photo' => "product_photos/Electronic/P33-I2.jpg",
            ],
            [
                'product_id' => 27,
                'photo' => "product_photos/Electronic/P33-I3.jpg",
            ],
            [
                'product_id' => 27,
                'photo' => "product_photos/Electronic/P33-I4.jpg",
            ],
            [
                'product_id' => 27,
                'photo' => "product_photos/Electronic/P33-I5.jpg",
            ],
            // product 28
            [
                'product_id' => 28,
                'photo' => "product_photos/Other_Product/P33-I1.jpg",
            ],
            [
                'product_id' => 28,
                'photo' => "product_photos/Other_Product/P33-I2.jpg",
            ],
            [
                'product_id' => 28,
                'photo' => "product_photos/Other_Product/P33-I3.jpg",
            ],
            [
                'product_id' => 28,
                'photo' => "product_photos/Other_Product/P33-I4.jpg",
            ],
            [
                'product_id' => 28,
                'photo' => "product_photos/Other_Product/P33-I5.jpg",
            ],
        ];
        foreach ($photos as $photo) {
            Photo::create($photo);
        }
    }
}
