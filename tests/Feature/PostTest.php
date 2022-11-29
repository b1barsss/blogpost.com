<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    public function test_ShouldBeNoBlogPosts_WhenDatabaseIsEmpty()
    {
        $response = $this->get("/posts");

        $response->assertSeeText('No blog posts yet!');
    }

    public function test_ShouldBeOneBlogPost_WhenThereIsOne()
    {
        $post = $this->createDummyBlogPost();

        $response = $this->get('/posts');

        $response->assertSeeText('New Title');

        $this->assertDatabaseHas('blog_posts',[
            'title' => 'New Title',
            'content' => 'New content of the blogpost'
        ]);
    }

    public function test_StoreValidation()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 character'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was created successfully!');
    }

    public function test_StoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0],'The title must be at least  5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least  10 characters.');
    }

    public function test_UpdateValid()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray()); // Verifying that created in the database

        $params = [
            'title' => 'A new valid',
            'content' => 'A new valid content mother fucker'
        ];

        $this->put("posts/{$post->id}" , $params)  // Checking for put request
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), "Blog post was Updated!!!"); // Checking for session

        $this->assertDatabaseMissing('blog_posts', $post->toArray());   // Checking for object that was updated (shouldn't be in the database)

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new valid'
        ]); // checking for updated data in the database
    }

    public function test_DeleteValid()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was Deleted!!!');

        $this->assertDatabaseMissing('blog_posts', $post->toArray());

    }

    private function createDummyBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = "New content of the blogpost";
        $post->save();
        return $post;
    }
}
