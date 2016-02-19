<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


        $this->visit("/index/loginStudent")->see('Login for Students');

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
        $this->post('/index/loginStudent', $wrongCredentials)->see("Uable to sign in, check username or password");

        $this->post('/index/loginStudent', $passingCredentials)->see("You are alerady sign in");


?>