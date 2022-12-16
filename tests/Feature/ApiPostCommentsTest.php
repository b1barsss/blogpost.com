<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
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
        $this->blogPost();

        $response = $this->getJson('api/v1/posts/1/comments');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(0,'data');
    }

    public function test_BlogPostHas10Comments()
    {
        $this->blogPost()->each(function(BlogPost $post){
            $post->comments()->saveMany(
                Comment::factory()->count(10)->make([
                    'user_id' => $this->user()->id,
                ])
            );
        });

        $response = $this->getJson('api/v1/posts/2/comments');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'content',
                        'created_at',
                        'updated_at',
                        'user' => [
                            'id',
                            'name',
                        ]
                    ]
                ],
                'links',
                'meta'
            ])
            ->assertJsonCount(10,'data');


    }

    public function test_AddingCommentsWhenNotAutheticated()
    {
        $this->blogPost();

        $response = $this->postJson('api/v1/posts/3/comments', [
            'content' => 'Hello'
        ]);

//        $response->assertStatus(401);
        $response->assertUnauthorized();
    }

    public function test_AddingCommentsWhenAuthenticated()
    {
        $this->blogPost();

        $response = $this->actingAs($this->user(), 'api')
            ->postJson('api/v1/posts/4/comments', [
                'content' => 'Hello 5 chars'
            ]);

        $response->assertStatus(201);
    }

    public function test_AddingCommentsInvalidData()
    {
        $this->blogPost();

        $response = $this->actingAs($this->user(), 'api')
            ->postJson('api/v1/posts/5/comments', []);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'content' => ["You can't add empty comment!"]
                ]
            ]);
    }
}
