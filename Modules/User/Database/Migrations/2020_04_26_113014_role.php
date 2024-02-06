<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Role extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang_code')->nullable();
            $table->string('title')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('permissions')->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });


        $input = [
            'admin.users.index',
            'admin.users.create',
            'admin.users.edit',
            'admin.users.status',
            'admin.users.destroy',

            'admin.departments.index',
            'admin.departments.create',
            'admin.departments.edit',
            'admin.departments.status',
            'admin.departments.destroy',

            'admin.positions.index',
            'admin.positions.create',
            'admin.positions.create',
            'admin.positions.create',
            'admin.positions.edit',
            'admin.positions.status',
            'admin.positions.destroy',

            'admin.roles.index',
            'admin.roles.create',
            'admin.roles.edit',
            'admin.roles.status',
            'admin.roles.destroy',

            'admin.medias.index',
            'admin.medias.index',
            'admin.medias.create',
            'admin.medias.edit',
            'admin.medias.status',
            'admin.medias.destroy',

            'admin.categorys.index',
            'admin.categorys.create',
            'admin.categorys.edit',
            'admin.categorys.status',
            'admin.categorys.destroy',

            'admin.groups.index',
            'admin.groups.create',
            'admin.groups.edit',
            'admin.groups.create',
            'admin.groups.edit',
            'admin.groups.status',
            'admin.groups.destroy',

            'admin.group_types.index',
            'admin.group_types.create',
            'admin.group_types.edit',
            'admin.group_types.status',
            'admin.group_types.destroy',

            'admin.units.index',
            'admin.units.create',
            'admin.units.edit',
            'admin.units.status',
            'admin.units.destroy',
        ];

        DB::table('roles')->insert(
            array(
                'id' => 1,
                'title' => 'Admin',
                'user_id' => 1,
                'position_id' => 1,
                'department_id' => 1,
                'permissions' => implode(',', $input)
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
