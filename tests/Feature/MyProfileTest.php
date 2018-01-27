<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MyProfileTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMyProfile()
    {
        $response = $this->withSession(['user.first_name' => 'admin'])->post('my_profile');
        $response->assertStatus(200);
        $response->assertViewIs('my_profile');
        $response->assertSessionHas('user');
        $response->assertSessionHas('user.first_name');
    }
}
