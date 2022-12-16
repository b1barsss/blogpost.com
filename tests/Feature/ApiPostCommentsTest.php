<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiPostCommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_NewBlogPostDoesNotHaveComments()
    {
        BlogPost::factory()->create([
            'user_id' => $this->user()->id,
        ]);

        $response = $this->getJson('api/v1/posts/1/comments');

        $response->assertStatus(200);
    }
}
