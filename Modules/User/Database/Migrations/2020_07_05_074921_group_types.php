<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('type')->nullable();
            $table->boolean('is_layout');
            $table->integer('header_id')->nullable()->default(0);
            $table->integer('footer_id')->nullable()->default(0);
            $table->char('author')->nullable();
            $table->unsignedInteger('order')->nullable()->default(1);
            $table->char('status')->nullable()->default('active');
            $table->integer('created_by')->nullable();
            $table->datetime('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('group_type_translates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_type_id');
            $table->char('lang_code')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('alias')->nullable();
            $table->string('img')->nullable();
            $table->text('galleries')->nullable();
            $table->dateTime('created_at');
            $table->index(['id', 'group_type_id']);
            $table->foreign('group_type_id')->references('id')->on('group_types')->onDelete('cascade');
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
