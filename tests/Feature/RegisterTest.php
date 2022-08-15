<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registerValidationWorks()
    {
        $this->postJson('/api/user/register')
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    public function test_ensureAllFieldsAreFilled()
    {
        $this->postJson('/api/user/register', [
            'name' => 'Ajibola',
            'email' => 'ajibola@jb.com',
            'password' => '123456',
            'password_confirmation' => '4439393'
        ])->assertUnprocessable(422);
    }

    public function test_ensureUserCanRegister()
    {
        $this->postJson('/api/user/register', [
            'name' => 'Ajibola Junior',
            'email' => 'jb@junior.com',
            'password' => '12345567',
            'password_confirmation' => '12345567'
        ])->assertCreated();
    }
}
