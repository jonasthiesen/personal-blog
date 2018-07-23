<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_visitor_can_see_the_posts_on_a_page()
    {
        $posts = factory(Post::class, 5)->create();

        $page = $this->get('posts');
        
        foreach ($posts as $post) {
            $page->assertSee($post->title);
        }
    }
}
