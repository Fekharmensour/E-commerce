<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notifications = [
            [
                'title' => 'New Message',
                'body' => 'You have a new message from John Doe.',
                'sender' => 3,
                'receiver' => 1,
                'status' => 'success',
            ],
            [
                'title' => 'Payment Received',
                'body' => 'Your payment of $50 has been received.',
                'sender' => 4,
                'receiver' => 1,
                'status' => 'warning',
            ],
            [
                'title' => 'Order Shipped',
                'body' => 'Your order has been shipped and is on its way.',
                'sender' => 5,
                'receiver' => 1,
                'status' => 'question',
            ],
            [
                'title' => 'Product Out of Stock',
                'body' => 'The product you ordered is currently out of stock.',
                'sender' => 4,
                'receiver' => 1,
                'status' => 'danger',
            ],
            [
                'title' => 'Account Deactivated',
                'body' => 'Your account has been deactivated. Please contact support for more information.',
                'sender' => 5,
                'receiver' => 2,
                'status' => 'error',
            ],
            [
                'title' => 'New Message',
                'body' => 'You have a new message from John Doe.',
                'sender' => 1,
                'receiver' => 2,
                'status' => 'success',
            ],
            [
                'title' => 'Payment Received',
                'body' => 'Your payment of $50 has been received.',
                'sender' => 6,
                'receiver' => 2,
                'status' => 'warning',
            ],
            [
                'title' => 'Order Shipped',
                'body' => 'Your order has been shipped and is on its way.',
                'sender' => 3,
                'receiver' => 2,
                'status' => 'question',
            ],
            [
                'title' => 'Product Out of Stock',
                'body' => 'The product you ordered is currently out of stock.',
                'sender' => 4,
                'receiver' => 2,
                'status' => 'danger',
            ],
            [
                'title' => 'Account Deactivated',
                'body' => 'Your account has been deactivated. Please contact support for more information.',
                'sender' => 5,
                'receiver' => 2,
                'status' => 'error',
            ],

            [
                'title' => 'New Message',
                'body' => 'You have a new message from John Doe.',
                'sender' => 1,
                'receiver' => 3,
                'status' => 'success',
            ],
            [
                'title' => 'Payment Received',
                'body' => 'Your payment of $50 has been received.',
                'sender' => 2,
                'receiver' => 3,
                'status' => 'warning',
            ],
            [
                'title' => 'Order Shipped',
                'body' => 'Your order has been shipped and is on its way.',
                'sender' => 1,
                'receiver' => 3,
                'status' => 'question',
            ],
            [
                'title' => 'Product Out of Stock',
                'body' => 'The product you ordered is currently out of stock.',
                'sender' => 4,
                'receiver' => 3,
                'status' => 'danger',
            ],
            [
                'title' => 'Account Deactivated',
                'body' => 'Your account has been deactivated. Please contact support for more information.',
                'sender' => 5,
                'receiver' => 3,
                'status' => 'error',
            ],
        ];

        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
}
