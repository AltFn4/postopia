<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $no_of_posts = Post::count();

        // Generate an unique name.
        $name = uniqid() . '.png';

        // Obtain a random image.
        $url = 'https://source.unsplash.com/random';
        $contents = file_get_contents($url);

        // Store them in images directory in public storage.
        Storage::disk('public')->put('images/' . $name, $contents);

        return [
            'name' => $name,
            'post_id' => random_int(1, $no_of_posts),
        ];
    }
}
