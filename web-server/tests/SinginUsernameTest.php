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
        $this->visit("/login")->see('Sign into Attend system');

        $wrongCredentials = array(
            'username' => 'FakeUserName',
            'password' => 'wrongPassword',
            '_token' => csrf_token()
        );

        $passingCredentials = array(
            'username' => 'FakeUserName',
            'password' => 'FakeUserName',
            '_token' => csrf_token()
        );
        $this->post('/login', $wrongCredentials)->see("Uable to sign in, check username or password");

        $this->post('/login', $passingCredentials)->see("You are alerady sign in");


    }
}