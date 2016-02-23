<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testSignInApi extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAPI()
    {
        $wrongCredentials = array(
            'username' => 'FakeUserName',
            'password' => 'wrongPassword',
        );

        $passingCredentials = array(
            'username' => 'FakeUserName',
            'password' => 'FakeUserName',
        );

        $this->post('/api/auth/login', $passingCredentials)->seeJson("{\"state\":\"success\",\"token\":\"FakeUserName\"}");

        $this->post('/api/auth/login', $wrongCredentials)->seeJson("{\"state\":\"failure\"}");

    }
}
