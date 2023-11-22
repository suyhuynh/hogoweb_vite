<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->nullable();
            $table->string('img')->nullable();
            $table->string('fullname')->nullable();
            $table->char('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->tinyInteger('sex')->nullable();
            $table->char('passport')->nullable();
            $table->date('dateRange')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('address')->nullable();
            $table->char('nation')->nullable();
            $table->char('religion')->nullable();
            $table->char('positionsIds')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->text('remember_token')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });

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
