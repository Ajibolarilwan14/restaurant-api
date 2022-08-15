<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginValidationWorks()
    {
        $this->postJson('/api/user/login')
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function testEnsureUserProvideaValidEmail()
    {
        $this->postJson('/api/user/login', [
            'email' => 'junior@jb.com',
            'password' => '4345434'
        ])->assertUnprocessable()
        ->assertJsonValidationErrors(['message']);
    }

    public function testEnsureUserProvideaValidPassword()
    {
        $user = User::factory()->create();

        $this->postJson('/api/user/login', [
            'email' => $user->email,
            'password' => '949jfjf94'
        ])->assertUnprocessable()
        ->assertJsonValidationErrors(['message']);
    }

    public function testEnsureUserCanLogin()
    {
        $user = User::factory()->create();

        $this->postJson('/api/user/login', [
            'email' => $user->email,
            'password' => '123457654'
        ])->assertOk()
        ->assertJsonStructure(['token']);
    }
}


