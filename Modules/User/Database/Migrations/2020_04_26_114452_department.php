<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Department extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('departments', function (Blueprint $table) {
        $table->increments('id');
        $table->string('lang_code')->nullable();
        $table->char('type')->nullable();
        $table->integer('parent_id')->nullable();
        $table->string('title')->nullable();
        $table->tinyInteger('status')->default(1)->nullable();
        $table->integer('created_by')->nullable();
        $table->timestamps();
        $table->index(['id', 'created_at']);
      });

      DB::table('departments')->insert(['id' => 1, 'title' => 'Quản lý', 'status' => 1, 'created_by' => 1]);
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
