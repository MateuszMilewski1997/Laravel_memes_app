<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Meme;
use App\Models\Comment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $meme = factory(Meme::class)->create();
        $comment = factory(Comment::class)->create();
        
        $response = $this->post('/meme/comment/add/'.$meme->id, [
            'content' => "test content",
        ]);
 
        $response->assertStatus(200);
        $this->assertTrue(true);
    }
    public function testCreateBad()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $meme = factory(Meme::class)->create();
        $comment = factory(Comment::class)->create();
        
        $response = $this->post('/meme/comment/add/'.$meme->id, [ ]);
 
        $response->assertSessionHasErrors('content');
    }
    public function testDelete()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $meme = factory(Meme::class)->create();
        $comment = factory(Comment::class)->create();
        
        $response = $this->get('/meme/comments/delete/'.$comment->id, [ ]);
        
        $this->assertTrue(true);
    }
    public function testDeleteForbiddenAccess()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $meme = factory(Meme::class)->create();
        $comment = factory(Comment::class)->create();
        $id = $user->id + 1;
        $comment->user_id = $id;

        $response = $this->get('/meme/comments/delete/'.$comment->id, [ ]);
        
        $response->assertSee('Forbidden access!');
    }
}
