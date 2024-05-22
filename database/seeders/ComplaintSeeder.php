<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Complaint;
use App\Models\Buyer;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming you have at least 5 buyers in the database
        $buyerIds = Buyer::pluck('id')->toArray();

        $complaints = [
            [
                'buyer_id' => 1,
                'about_id' => 1,
                'about' => 'product',
                'title' => 'Product complaint',
                'body' => 'I received the product damaged.',
            ],
            [
                'buyer_id' => 2,
                'about_id' => 2,
                'about' => 'review',
                'title' => 'Review complaint',
                'body' => 'The review posted contains false information.',
            ],
            [
                'buyer_id' => 3,
                'about_id' => 3,
                'about' => 'seller',
                'title' => 'Seller complaint',
                'body' => 'The seller did not deliver the order on time.',
            ],
            [
                'buyer_id' => 4,
                'about_id' => 4,
                'about' => 'buyer',
                'title' => 'Buyer complaint',
                'body' => 'The buyer is not responding to messages.',
            ],
            [
                'buyer_id' => 3,
                'about_id' => 5,
                'about' => 'product',
                'title' => 'Product complaint',
                'body' => 'The product received is not as described.',
            ],
            [
                'buyer_id' => 5,
                'about_id' => 6,
                'about' => 'review',
                'title' => 'Review complaint',
                'body' => 'The review contains offensive language.',
            ],
            [
                'buyer_id' => 6,
                'about_id' => 2,
                'about' => 'seller',
                'title' => 'Seller complaint',
                'body' => 'The seller did not provide a valid tracking number.',
            ],
            [
                'buyer_id' => 2,
                'about_id' => 5,
                'about' => 'buyer',
                'title' => 'Buyer complaint',
                'body' => 'The buyer canceled the order without reason.',
            ],
            [
                'buyer_id' => 4,
                'about_id' => 9,
                'about' => 'product',
                'title' => 'Product complaint',
                'body' => 'The product received is expired.',
            ],
            [
                'buyer_id' => 4,
                'about_id' => 10,
                'about' => 'review',
                'title' => 'Review complaint',
                'body' => 'The review was posted by a fake account.',
            ],
        ];

        foreach ($complaints as $complaint) {
            Complaint::create($complaint);
        }
    }
}
