<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_ShouldBeNoBlogPosts_WhenDatabaseIsEmpty()
    {
        $response = $this->get("/posts");

        $response->assertSeeText('No blog posts yet!');
    }

    public function test_ShouldBeOneBlogPost_WhenThereIsOneWithCount()
    {
        $post = $this->createDummyBlogPost();

        $response = $this->get('/posts');

        $response->assertSeeText('New Title');
        $response->assertSeeText('No comments yet');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title'
        ]);
    }

    public function test_seeOneBlogPostWithComments()
    {
        $post = $this->createDummyBlogPost();
//        $comments = Comment::factory()->count(4)->create(['blog_post_id' => $post->id]);
        $user = $this->user();
        Comment::factory()->count(4)->create([
            'commentable_id' => $post->id,
            'commentable_type' => BlogPost::class,
            'user_id' => $user->id,
        ]);

        $response = $this->get('/posts');
        $response->assertSeeText('4 comments');
    }
    public function test_StoreValid()
    {

        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 character'
        ];


        $this->actingAs($this->user())
            ->post('/posts', $params)
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

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0],'[Title] field should contain at least  5 chars');
        $this->assertEquals($messages['content'][0], '[Content] field should contain at least  10 chars');
    }

    public function test_UpdateValid()
    {
        $user = User::factory()->john_doe()->create();
        $post = $this->createDummyBlogPost($user->id);
        $this->assertDatabaseHas('blog_posts', $post->toArray()); // Verifying that created in the database

        $params = [
            'title' => 'A new valid',
            'content' => 'A new valid content'
        ];
        $this->actingAs($user)
            ->patch("posts/{$post->id}", $params )
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), "Blog post was Updated!!!"); // Checking for session

        $this->assertDatabaseMissing('blog_posts', $post->toArray());   // Checking for object that was updated
                                                                             // (shouldn't be in the database)

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new valid',
            'content' => 'A new valid content'
        ]); // checking for updated data in the database
    }

    public function test_DeleteValid()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was Deleted!!!');
//        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertSoftDeleted('blog_posts', $post->toArray());
    }

    private function createDummyBlogPost(int $userId = null): BlogPost
    {
//        $post = new BlogPost();
//        $post->title = 'New Title';
//        $post->content = "New content of the blogpost";
//        $post->save();

        return BlogPost::factory()->new_title()->create(
            [
                'user_id' => $userId ?? $this->user()->id
            ]);

//        return $post;
    }
}
