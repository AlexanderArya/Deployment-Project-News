<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'user_id' => Str::uuid(),
                'comment' => 'This anime is amazing!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid(),
                'comment' => 'Looking forward to the next episode!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid(),
                'comment' => 'I prefer the manga version.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
