<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory(10)->create();
        $max = Tag::all()->count();

        foreach (Post::all() as $post) {
            // Randomly assign up to 5 tags for each post.
            $n = random_int(1, 5);
            for ($i = 1; $i < $n; $i++) {
                // Reset unique for faker. Get a random unique post.
                $k = fake()->unique($i == 1)->numberBetween(1, $max);
                $post->tags()->attach($k);
            }
        }
    }
}
