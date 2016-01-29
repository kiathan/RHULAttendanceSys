<?php

use Illuminate\Database\Seeder;

class fakeUsername extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;

        $user->name = "FakeUserName";
        $user->username = "FakeUserName";
        $user->firstname = "FakeUserName";
        $user->middlename = "FakeUserName";
        $user->lastname = "FakeUserName";
        $user->email = "FakeUserName";
        $user->password = Hash::make("FakeUserName");

        $user->save();


        $user = new App\User;

        $user->name = "FakeUserName";
        $user->username = "testuser";
        $user->firstname = "FakeUserName";
        $user->middlename = "FakeUserName";
        $user->lastname = "FakeUserName";
        $user->email = "testUser";
        $user->password = Hash::make("testpass");

        $user->save();
    }
}
