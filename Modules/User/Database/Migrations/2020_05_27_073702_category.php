<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('type')->nullable();
            $table->boolean('is_layout')->nullable()->default(0);
            $table->integer('header_id')->nullable()->default(0);
            $table->integer('footer_id')->nullable()->default(0);
            $table->char('group_type_ids')->nullable();
            $table->char('group_ids')->nullable();
            $table->integer('layout_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->unsignedInteger('order')->nullable()->default(0);
            $table->char('status')->nullable()->default('active');
            $table->string('author')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });

        Schema::create('category_translates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->char('lang_code')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('alias')->nullable();
            $table->string('img')->nullable();
            $table->text('galleries')->nullable();
            $table->dateTime('created_at');
            $table->index(['id', 'category_id']);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
