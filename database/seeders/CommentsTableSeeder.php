<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();

        if ($posts->count() === 0)
        {
            $this->command->info('==========[THERE ARE NO BLOGPOSTS, SO NO COMMENTS WILL BE ADDED!]==========');
            return;
        }
        $commentCount = (int)$this->command->ask("How many [Comments] would you like?",120);

        Comment::factory()->count($commentCount)->make()->each(
            function ($comment) use ($posts)
            {
                $comment->blog_post_id = $posts->random()->id;
                $comment->save();
//                Comment::factory()->count(rand(0,3))->for($posts->random())->create();
            });
    }
}
