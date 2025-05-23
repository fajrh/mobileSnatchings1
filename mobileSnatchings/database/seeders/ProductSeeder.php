<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['id' => 13, 'description' => 'Mobile phone snatched at gunpoint on Jamshed Road. Victim had previously reported a similar incident a month prior.', 'lat' => 24.87, 'long' => 67.04, 'datetime' => '2023-04-20 18:00:00'],
            ['id' => 14, 'description' => "Aunt's mobile phone was snatched; the device was powered off immediately, rendering tracking ineffective.", 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2024-10-26 10:00:00'],
            ['id' => 15, 'description' => 'Victim was heading towards their institute when a man on a bike stopped them, displayed a pistol, and took 100 PKR. Incident occurred despite the presence of nearby schools with guards.', 'lat' => 24.93, 'long' => 67.02, 'datetime' => '2024-09-28 08:00:00'],
            ['id' => 16, 'description' => 'Victim was lured into a car under the pretense of a phone sale near Haroon Shopping Center. Once inside, they were robbed at gunpoint.', 'lat' => 24.95, 'long' => 67.01, 'datetime' => '2024-08-23 22:00:00'],
            ['id' => 17, 'description' => 'Journalists from Times of Karachi and Pakistan Kay Sath were robbed of cash, digital equipment, mobile phones, and cameras at Sagheer Center near Sohrab Goth.', 'lat' => 24.98, 'long' => 67.08, 'datetime' => '2022-09-26 15:00:00'],
            ['id' => 18, 'description' => 'Victim was robbed near Falcon Complex; assailants took phone and bike keys. Police nearby refused to assist.', 'lat' => 24.89, 'long' => 67.07, 'datetime' => '2024-09-20 19:00:00'],
            ['id' => 19, 'description' => 'Blind Muezzin was robbed of an expensive mobile phone inside a mosque in Gulistan-e-Johar. Thief withdrew Rs. 35,000 from the victim\'s online account.', 'lat' => 24.92, 'long' => 67.13, 'datetime' => '2023-05-03 14:00:00'],
            ['id' => 20, 'description' => 'Two gunmen on a motorcycle pointed a gun at the victim and took their phone and some cash. Victim expressed fear of going out after the incident.', 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2022-11-20 20:00:00'],
            ['id' => 22, 'description' => 'Got mugged during a visit to Karachi', 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 23, 'description' => 'Student of NED university was shot for resisting snatchers', 'lat' => 24.93, 'long' => 67.11, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 24, 'description' => "Friend's bag was snatched", 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 25, 'description' => 'User experienced six different snatching incidents', 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 26, 'description' => 'Dacoity occurred in Bahria', 'lat' => 25.01, 'long' => 67.31, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 27, 'description' => 'Hamdard University point was looted', 'lat' => 25.09, 'long' => 67.31, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 28, 'description' => 'Phone snatched outside the university', 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 29, 'description' => 'Phone and wallet snatched in Gulistan e Jauhar', 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 30, 'description' => 'Mugged on a main road in cantonment area', 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2025-01-01 01:00:00'],
            ['id' => 31, 'description' => 'Phone snatched in Karachi', 'lat' => 24.86, 'long' => 67.00, 'datetime' => '2025-01-01 01:00:00'],
        ];

        DB::table('products')->insert($products);
    }
}
