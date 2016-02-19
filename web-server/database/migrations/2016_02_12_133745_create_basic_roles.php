<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PermissionsManager::createRole('admin', 'Administrator');
        PermissionsManager::createRole('manager', 'App manger');
        PermissionsManager::createRole('lectuer', 'lectuer');
        PermissionsManager::createRole('PhD', 'Postgraduate research');
        PermissionsManager::createRole('MSc', 'Postgraduate taught');
        PermissionsManager::createRole('BSc', 'Undergraduate');

        PermissionsManager::createPermission('login', 'Allow login');
        PermissionsManager::createPermission('create user', 'Allow to create users');
        PermissionsManager::createPermission('assign users ', 'Allow to Assing users to roles');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
