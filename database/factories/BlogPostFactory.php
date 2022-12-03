<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = BlogPost::class;
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(10),
            "content" => $this->faker->paragraphs(rand(1,5),true)
        ];
    }

    public function new_title()
    {
        return $this->state(function (array $attributes)
        {
           return [
                'title' => 'New Title',
                'content' => "New content of the blogpost"
           ];
        });
    }
}
