<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
use App\Tag;
use App\User;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_post_contains_a_title()
    {
        $title = 'Lorem Ipsum';

        $post = factory(Post::class)->make(['title' => $title]);

        $this->assertEquals($title, $post->title);
    }

    
    /**
     * @test
     */
    public function a_post_contains_a_description()
    {
        $description = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, et!';

        $post = factory(Post::class)->make(['description' => $description]);

        $this->assertEquals($description, $post->description);
    }

    /**
     * @test
     */
    public function a_post_contains_content()
    {
        $content = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat consequatur alias omnis vitae ut rerum facilis nobis tempore soluta, doloribus error id impedit in est aperiam laboriosam unde non nemo.';

        $post = factory(Post::class)->make(['content' => $content]);

        $this->assertEquals($content, $post->content);
    }

    /**
     * @test
     */
    public function a_post_belongs_to_a_user()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create(['user_id' => $user->id]);
        
        $this->assertEquals($user->id, $post->author->id);
    }

    /**
     * @test
     */
    public function a_post_belongs_to_a_tag()
    {
        $tag = factory(Tag::class)->create();

        $post = factory(Post::class)->create();

        $post->tags()->attach($tag);

        $this->assertEquals($tag->name, $post->tags()->first()->name);
    }

    /**
     * @test
     */
    public function a_post_belongs_to_many_tags()
    {
        $tags = factory(Tag::class, 3)->create();

        $post = factory(Post::class)->create();

        $post->tags()->attach($tags);

        $this->assertEquals($tags->count(), $post->tags()->count());
    }
}
