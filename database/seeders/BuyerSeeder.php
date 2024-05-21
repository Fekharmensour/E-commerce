<?php

namespace Database\Seeders;

use App\Models\Buyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $buyers = [
            [
                'username' => 'mensourFekhar',
                'email' => 'mensourFekhar@gmail.com',
                'birthday' => '1990-01-01',
                'password' => Hash::make('123456789'),
                'role' => false,
                'is-admin' => true,
                'phone' => '0665001345',
                'address' => 'Ghardaia',
                'image' => 'profile/buyer1.jpeg',
            ],
            [
                'username' => 'oussamaKhobzi',
                'email' => 'oussamaKhobzi@gmail.com',
                'birthday' => '1991-02-02',
                'password' => Hash::make('123456789'),
                'role' => false,
                'is-admin' => false,
                'phone' => '0654321890',
                'address' => 'Algiers',
                'image' => 'profile/buyer2.jpeg',
            ],
            [
                'username' => 'lokmaneTelay',
                'email' => 'lokmaneTelay@gmail.com',
                'birthday' => '1992-03-03',
                'password' => Hash::make('123456789'),
                'role' => false,
                'is-admin' => false,
                'phone' => '0643218907',
                'address' => 'Oran',
                'image' => 'profile/buyer3.jpeg',
            ],
//            [
//                'username' => 'mohamedAli',
//                'email' => 'mohamedAli@gmail.com',
//                'birthday' => '1993-04-04',
//                'password' => Hash::make('123456789'),
//                'role' => false,
//                'is-admin' => false,
//                'phone' => '0632109876',
//                'address' => 'Constantine',
//                'image' => 'profile/buyer4.jpeg',
//            ],
//            [
//                'username' => 'ilyesFertas',
//                'email' => 'ilyesFertas@gmail.com',
//                'birthday' => '1994-05-05',
//                'password' => Hash::make('123456789'),
//                'role' => false,
//                'is-admin' => false,
//                'phone' => '0621098765',
//                'address' => 'Tlemcen',
//                'image' => 'profile/buyer5.jpeg',
//            ],
//            [
//                'username' => 'rachidBoualem',
//                'email' => 'rachidBoualem@gmail.com',
//                'birthday' => '1995-06-06',
//                'password' => Hash::make('123456789'),
//                'role' => false,
//                'is-admin' => false,
//                'phone' => '0610987654',
//                'address' => 'Annaba',
//                'image' => 'profile/buyer6.jpeg',
//            ],
//            [
//                'username' => 'bakirHadjisaid',
//                'email' => 'bakirHadjisaid@gmail.com',
//                'birthday' => '1996-07-07',
//                'password' => Hash::make('123456789'),
//                'role' => false,
//                'is-admin' => false,
//                'phone' => '0609876543',
//                'address' => 'Batna',
//                'image' => 'profile/buyer7.jpeg',
//            ],
//            [
//                'username' => 'ahmedChikh',
//                'email' => 'ahmedChikh@gmail.com',
//                'birthday' => '1997-08-08',
//                'password' => Hash::make('123456789'),
//                'role' => false,
//                'is-admin' => false,
//                'phone' => '0598765432',
//                'address' => 'Setif',
//                'image' => 'profile/buyer8.jpeg',
//            ],
//            [
//                'username' => 'yassineZitani',
//                'email' => 'yassineZitani@gmail.com',
//                'birthday' => '1998-09-09',
//                'password' => Hash::make('123456789'),
//                'role' => false,
//                'is-admin' => false,
//                'phone' => '0587654321',
//                'address' => 'Blida',
//                'image' => 'profile/buyer9.jpeg',
//            ],
//            [
//                'username' => 'yousfGagi',
//                'email' => 'yousfGagi@gmail.com',
//                'birthday' => '1999-10-10',
//                'password' => Hash::make('123456789'),
//                'role' => false,
//                'is-admin' => false,
//                'phone' => '0576543210',
//                'address' => 'Biskra',
//                'image' => 'profile/buyer10.jpeg',
//            ],
        ];

        foreach ($buyers as $buyer) {
            // Specify the correct path to the image file
            $imagePath = 'profile/' . $buyer['image'];
            // Remove 'public/' from the stored image path
            $storedImagePath = Storage::putFile($imagePath, public_path('profile/' . $buyer['image']));

            // Store the stored image path in the database
            Buyer::create([
                'username' => $buyer['username'],
                'email' => $buyer['email'],
                'birthday' => $buyer['birthday'],
                'password' => $buyer['password'],
                'role' => $buyer['role'],
                'is_admin' => $buyer['is_admin'],
                'phone' => $buyer['phone'],
                'address' => $buyer['address'],
                'image' => $storedImagePath,
            ]);
        }

    }
}
