<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'user_id' => '1',
                'massage' => 'User berhasil login.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'massage' => 'User mengubah profil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'massage' => 'User menambahkan komentar di anime Naruto.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('events')->insert($events);
    }
}
