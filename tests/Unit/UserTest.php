<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

     public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }
    public function testLoginSubmit()
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email','password');
    }
    public function testUserAuthentification()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(route('all_memes'));
        $this->assertAuthenticatedAs($user);
    }
    public function testUserCreateForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }
    public function testUserCreateRequest()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => "password",
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect(route('all_memes'));
    }
    public function testUserCreateRequestError()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('register'), [
            'name' => $user->name,
            'password' => "password",
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }
    public function testUserAccount()
    {
        $user = factory(User::class)->create();

        $response = $this->get('/account');

        $response->assertStatus(200);
        $response->assertSee('Forbidden access!');
    }
    public function testUserAccountLogged()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->get('/account');

        $response->assertStatus(200);
        $response->assertViewIs('account.account');
    }
    public function testMyMemes()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->get('/memes/my');
        $response->assertStatus(200);
        $response->assertViewIs('memes.all_memes');
    }
    
}
