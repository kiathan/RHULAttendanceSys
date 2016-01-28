<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class singinUsernameTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckRoutesWork()
    {
        $this->visit("/login")->see('Sing into Attend system');

        $credentials = array(
            'username' => 'wronguser',
            'password' => 'wrongpass',
            '_token' => csrf_token()
        );

        $this->post("/login", $credentials)->see("Uable to sign in, check username or password");
    }
}