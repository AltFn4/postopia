<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $no_of_users = User::count();
        return [
            'title' => fake()->text(10),
            'content' => fake()->text(),
            'user_id' => random_int(1, $no_of_users),
        ];
    }
}
