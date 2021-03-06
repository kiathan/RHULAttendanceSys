<?php

use Illuminate\Database\Seeder;
use \KDuma\Permissions\Models\Role;
use Illuminate\Database\Migrations\Migration;


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
        $user->password = Hash::make(hash("sha256", $user->username ));
        $user->save();
        $role = Role::where('str_id', 'BSc')->firstOrFail();
        $user->roles()->sync([$role->id], false);


        $user = new App\User;

        $user->username = "100801274";
        $user->firstname = "Bartal";
        $user->middlename = "";
        $user->lastname = "Veyhe";
        $user->email = "100801274@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", $user->username ));
        $user->save();
        $role = Role::where('str_id', 'MSc')->firstOrFail();
        $user->roles()->sync([$role->id], false);


        $user = new App\User;

        $user->username = "100795238";
        $user->firstname = "Joao";
        $user->middlename = "";
        $user->lastname = "Linhares Carriho Da";
        $user->email = "100795238@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", $user->username ));
        $user->save();
        $role = Role::where('str_id', 'PhD')->firstOrFail();
        $user->roles()->sync([$role->id], false);


        $user = new App\User;

        $user->username = "100769889";
        $user->firstname = "Jiha";
        $user->middlename = "";
        $user->lastname = "Kim";
        $user->email = "100769889@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", $user->username ));
        $user->save();
        $role = Role::where('str_id', 'admin')->firstOrFail();
        $user->roles()->sync([$role->id], false);


        $user = new App\User;

        $user->username = "87654321";
        $user->firstname = "Johannas";
        $user->middlename = "";
        $user->lastname = "Kinder";
        $user->email = "10790000@rhul.ac.uk";
        $user->password = Hash::make(hash("sha256", $user->username ));
        $user->save();
        $role = Role::where('str_id', 'lecturer')->firstOrFail();
        $user->roles()->sync([$role->id], false);


    }
}
