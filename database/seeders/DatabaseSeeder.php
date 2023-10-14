<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Post::factory(20)->create();

        Post::factory()->create([
            'title' => 'Test Title',
            'content' => 'This is my very first post!',
            'user_id' => 1
        ]);

        Comment::factory(50)->create();

        Comment::factory()->create([
            'content' => 'This is an interesting post!',
            'user_id' => 1,
            'post_id' => 1,
        ]);
    }
}
