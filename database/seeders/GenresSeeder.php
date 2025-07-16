<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action',
            'Adventure',
            'Comedy',
            'Drama',
            'Fantasy',
            'Slice of Life',
            'Horror',
            'Romance',
            'Sci-Fi',
            'Mecha',
            'Supernatural',
            'Mystery',
            'Psychological',
            'Sports',
            'Music',
            'Historical'
        ];

        foreach ($genres as $index => $genre) {
            DB::table('genres')->insert([
                'user_id' => (string)($index + 1), // kamu bisa sesuaikan logika ini
                'genre' => $genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
