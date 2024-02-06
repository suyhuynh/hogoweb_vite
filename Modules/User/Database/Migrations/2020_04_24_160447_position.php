<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Position extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang_code')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('title')->nullable();
            $table->char('status')->nullable()->default('active');
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });


        DB::table('positions')->insert(['id' => 1, 'title' => 'Quản lý', 'status' => 1, 'created_by' => 1]);
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
