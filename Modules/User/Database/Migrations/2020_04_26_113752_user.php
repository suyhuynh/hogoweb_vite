<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->nullable();
            $table->string('fullname')->nullable();
            $table->char('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('username')->nullable();
            $table->date('birthday')->nullable();
            $table->string('password')->nullable();
            $table->text('remember_token')->nullable();
            $table->char('gender')->nullable();

            $table->integer('parent_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('avatar')->nullable();
            
            $table->char('passport')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('address')->nullable();
            $table->string('cmnd_back')->nullable();
            $table->string('cmnd_front')->nullable();
            $table->text('note')->nullable();

            $table->string('facebook')->nullable();
            $table->string('google')->nullable();
            $table->text('permissions')->nullable();
            $table->integer('is_receive_mail_from_sys')->default(0);
            $table->char('status')->nullable()->default('active');
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });

        DB::table('users')->insert(
            array(
                'id' => 1,
                'role_id' => 1,
                'position_id' => 1,
                'department_id' => 1,
                'fullname' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('img@123'),
                'status' => 1
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
        
    }
}
