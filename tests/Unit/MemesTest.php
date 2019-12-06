<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Meme;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testUploadForm()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->get('/meme/add/form');
    
        $response->assertStatus(200);
        $response->assertViewIs('memes.add_meme');
    }
    public function testCreateMeme()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $meme = factory(Meme::class)->create();
        Storage::fake('photos');

        $response = $this->post(route('create_meme'), [
            'title' => $meme->title,
            'cover_image' => UploadedFile::Fake()->image('photo1.jpg')
        ]);

        $response->assertRedirect(route('all_memes'));
    }
    public function testCreateMemeBad()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $meme = factory(Meme::class)->create();
        Storage::fake('photos');

        $response = $this->post(route('create_meme'), [
            'cover_image' => UploadedFile::Fake()->image('photo1.jpg')
        ]);

        $response->assertSessionHasErrors('title');
    }
}
