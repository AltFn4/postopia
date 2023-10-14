<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $no_of_users = User::count();
        $no_of_posts = Post::count();
        return [
            'content' => fake()->text(50),
            'user_id' => random_int(1, $no_of_users),
            'post_id' => random_int(1, $no_of_posts),
        ];
    }
}
