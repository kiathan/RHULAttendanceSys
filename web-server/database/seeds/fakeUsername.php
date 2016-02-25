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

        $user->username = "100793773";
        $user->firstname = "Kiat Han";
        $user->middlename = "";
        $user->lastname = "Kok";
        $user->email = "100793773@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", "100712345"));
        $role = Role::where('str_id', 'BSc')->firstOrFail();
        $user->role()->sync([$role->id], false);

        $user->save();

        $user = new App\User;

        $user->username = "100801274";
        $user->firstname = "Bartal";
        $user->middlename = "";
        $user->lastname = "Veyhe";
        $user->email = "100801274@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", "100801274"));
        $role = Role::where('str_id', 'MSc')->firstOrFail();
        $user->role()->sync([$role->id], false);

        $user->save();

        $user = new App\User;

        $user->username = "100795238";
        $user->firstname = "Joao";
        $user->middlename = "";
        $user->lastname = "Linhares Carriho Da";
        $user->email = "100795238@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", "100795238"));
        $role = Role::where('str_id', 'PhD')->firstOrFail();
        $user->role()->sync([$role->id], false);

        $user->save();

        $user = new App\User;

        $user->username = "100769889";
        $user->firstname = "Jiha";
        $user->middlename = "";
        $user->lastname = "Kim";
        $user->email = "100769889@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", "100769889"));
        $role = Role::where('str_id', 'admin')->firstOrFail();
        $user->role()->sync([$role->id], false);

        $user->save();

        $user = new App\User;

        $user->username = "107900000";
        $user->firstname = "Johannas";
        $user->middlename = "";
        $user->lastname = "Kinder";
        $user->email = "107900000@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", "107900000"));
        $role = Role::where('str_id', 'lecturer')->firstOrFail();
        $user->role()->sync([$role->id], false);

        $user->save();

    }
}
